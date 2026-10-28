# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Hard rules — NEVER do these

**Never destroy data.** No exceptions, not even "just to get the tests green" or "to reset local state":

- Never run `migrate:fresh`, `migrate:reset`, `migrate:rollback`, `db:wipe`, `schema:dump --prune`, or any `artisan` command that drops or truncates tables.
- Never issue `DROP DATABASE`, `DROP TABLE`, `TRUNCATE`, or an unfiltered `DELETE`/`UPDATE` (no `WHERE`) against any database — local, staging or production.
- Never run seeders that clear tables first, and never `php artisan tinker` your way into a mass delete.
- Never point a command at a `.env` / connection you did not verify first: this package runs inside a host app, so the "local" connection may well be a shared or tenant database.
- Never delete or overwrite `.env`, dumps, or anything in `storage/`.

If a task seems to require any of the above, **stop and ask the user first**, explain exactly what would be dropped, and let them run it themselves. Prefer additive, reversible alternatives: a new migration instead of editing an old one, a scoped `DELETE ... WHERE id = ?` instead of a bulk one, a scratch database instead of the real one.

The test suite is the usual trap — `beforeEach` calls `artisan('migrate')`, and the sqlite fulltext failure below tempts a "just wipe and re-migrate" fix. It is not one.

## What this is

A Laravel **package** (`teamtnt/sales-management`, namespace `Teamtnt\SalesManagement\` → `src/`), not an application. It ships a full CRM UI — contacts, campaigns, pipelines, leads, and a visual campaign-automation builder — into a host Laravel app. `SalesManagementServiceProvider` is auto-discovered; `src/helpers.php` is loaded globally via composer's `files` autoload.

`README.md` is still mostly the spatie package-skeleton template and is unreliable (placeholder description, fake usage example, CI badges for workflows that don't exist, and two `vendor:publish` tags that are never registered). The one genuinely useful section is **Local Development Setup** — composer path-repository symlinking plus symlinking `public/sales-management` into the host app. Use that; ignore the rest.

## Commands

```bash
vendor/bin/pest                       # full suite  (composer test wraps this)
vendor/bin/pest --filter=ExampleTest  # single test / file
vendor/bin/pest --coverage
vendor/bin/pint                       # code style (no pint.json; default preset)
npm install && npm run build          # Vite -> public/sales-management
```

Three of these are booby-trapped — know before you burn time:

- **`tests/Feature/LeadActivitiesFilterTest.php` always fails (6 tests).** `database/migrations/0000020_fulltext_indexes_to_contacts.php` calls `$table->fulltext(...)`, which sqlite cannot compile, so its `beforeEach` (`artisan('migrate', ['--database' => 'testing'])`) dies with `This database driver does not support fulltext index creation.` Past that it would still fail: it needs `\App\Models\User` and Lead/LeadActivity factories that don't exist.
- **`tests/Feature/HttpSmokeTest.php` is skipped unless pointed at MySQL.** Set `SM_TEST_DB_DATABASE` (plus `SM_TEST_DB_HOST`/`PORT`/`USERNAME`/`PASSWORD`) to a scratch database you created for it. It only runs the additive `migrate` and rolls each test back in a transaction — never point it at a shared database. `tests/Feature/WorkflowStateMachineTest.php` needs no database.
- **`composer analyse` is broken.** `vendor/bin/phpstan analyse` exits with *"At least one path must be specified to analyse."* — no `phpstan.neon` is committed (it's gitignored), and phpstan isn't in `require-dev`; the binary only exists transitively via `rector/rector` ← `spatie/laravel-ray`.

Built assets in `public/sales-management/` (including `manifest.json`) **are committed to git** — after `npm run build`, commit the output. `node_modules/` is *not* tracked, but both `package-lock.json` and `yarn.lock` are.

There is no CI (`.github/` does not exist).

## Releases and versioning

No version lives in `composer.json` — the git tag *is* the version. Host apps install this package by tag (83 annotated `vX.Y.Z` tags so far, currently `v1.1.59`), so **a commit only reaches a host app once a new tag is pushed.**

The rule:

- **Tag** whenever the commit changes something a host app consumes: anything in `src/`, `config/`, `database/`, `src/resources/`, or the built assets in `public/sales-management/` (including `manifest.json`), or `composer.json` dependencies.
- **Don't tag** for repo-only changes — `CLAUDE.md`, `README.md`, `.gitignore`, test-only edits, editor config. Push to `main` and stop there; a tag would only create a release that changes nothing downstream.
- Tag only commits already pushed to `origin/main`, and push the tag explicitly — `git push origin main && git tag -a v1.1.60 -m "..." && git push origin v1.1.60`. A tag that exists only locally releases nothing.
- Never move or delete an existing tag to "re-release" — host apps cache by tag name. Cut a new patch instead.
- If the change touches the frontend, run `npm run build` and commit `public/sales-management/` **before** tagging, otherwise the tag ships stale assets.

### Which number to bump — semver

Follow [semver](https://semver.org/) from `v1.1.59` onward. The history before that does **not** — 60 of 83 tags sit on `v1.1.x`, features included — so don't copy it: a feature now bumps the minor, not the patch.

The package's public API is what a host app can depend on, which for a package that ships UI is wider than PHP classes:

- config keys in `config/sales-management.php` (`tablePrefix`, `middleware`, `policy`, `permission_prefix`, mail/sender settings)
- route names under `teamtnt.sales-management.`, the webhook routes in `src/routes/webhook.php`, and gate names built from `permission_prefix`
- `SalesManagementPolicyContract`, the facade, public methods on models, and the globally-autoloaded functions in `src/helpers.php`
- Blade view names (host apps override them) and the published asset path `public/sales-management`
- the database schema the migrations produce

Then:

- **MAJOR** (`v2.0.0`) — removing or renaming anything in that list; a migration that drops or renames an existing column; changing a config default that silently changes behaviour (e.g. `tablePrefix`, or the shipped policy no longer returning `true`); dropping a PHP or Laravel version. Any Laravel 11+ / `laravelcollective/html` work lands here.
- **MINOR** (`v1.2.0`) — a new feature, a new workflow node type, a new route, a new config key that has a default, an additive-only migration. Anything a host app gets for free without changing its code.
- **PATCH** (`v1.1.60`) — bugfix, copy or style tweak, an asset rebuild with no behaviour change.

Two practical caveats, because host apps pin with `^1.1`: a minor reaches them on the next `composer update` without review, and **every tag that touches `database/migrations/` is a deploy step, not just a version bump** — say so in the tag message. When in doubt between patch and minor, take the minor; it costs nothing.

Commit messages are conventional-commit style only in recent history (19 of 498), but the recent ones are consistent — keep `feat:` / `fix:` / `refactor:` up, and use `feat!:` or a `BREAKING CHANGE:` footer so the major is visible in the log.

Tag format is `vX.Y.Z`, annotated, no exceptions — `v.1.1.18` and `v.1.1.54` are typos composer cannot parse. Leave them (rewriting tags breaks host caches), just never repeat the shape.

## Architecture

### Table naming — read this first

No model declares a static `$table`. Every one resolves it at runtime in its constructor:

```php
$this->table = config('sales-management.tablePrefix').'leads';   // src/Models/Lead.php:25
```

Pivot table names are assembled the same way (`Campaign::assignees()`), and the raw SQL in `src/Models/Campaign.php` and `src/helpers.php` interpolates prefixed names by hand. Never hardcode a table name, and remember migrations do the same (`Schema::table(config('sales-management.tablePrefix').'contacts', ...)`).

### Domain chain

`Contact` → `ContactList` → `Campaign` (owns a `Pipeline` of `PipelineStage`s) → `Lead` (a contact positioned on a stage) → `LeadActivity` / `LeadNotes` / `Tag` / `Deal`. `Company` and `Message` hang off campaigns; `PostmarkEvent` records email delivery/open/click events.

### Campaign automation engine

The most involved subsystem — a Vue Flow graph compiled into a Symfony Workflow state machine and driven by chained queued jobs:

1. **Editor** — `src/resources/js/components/Workflow/WorkFlow.vue` + `Nodes/*.vue` (Start, SendMessage, Wait, AddTag, ChangeStage, MoveToList, ABSplit, MessageOpened, LinkClicked, …). Available node actions are injected server-side by `WorkflowController::getWorkflowView`, each as `{action: <Job class>, argument: <id>, type: action|condition}`.
2. **Compile** — `WorkflowController::store/update` stores the raw graph in `workflows.elements` and hands it to `src/FSM/StateMachineBuilder.php`, which emits **Symfony Workflow YAML** into `workflows.state_machine_definition`. The node's `action`/`argument`/`type` travel as *transition metadata*.
3. **Rehydrate** — `Workflow::getStateMachineDefinition()` parses that YAML back through a `DefinitionBuilder` + `InMemoryMetadataStore`; `Workflow::fsm()` wraps it in `Symfony\Component\Workflow\Workflow` with `MethodMarkingStore(true, 'currentPlace')`.
4. **Marking subject** — `src/Models/LeadJourney.php` (`getCurrentPlace`/`setCurrentPlace`, column `current_place`, seeded to `"start"`). One row per lead per workflow.
5. **Driver** — `src/Jobs/NextTransitionJob.php`. It inspects enabled transitions and: returns early if the next node is a `condition` (those advance only when an external event fires); delegates to a decision job if more than one transition is enabled (A/B split); otherwise applies the transition, saves, and dispatches the metadata `action` job. Every action job (`SendMailJob`, `WaitJob`, `AddTagJob`, `ChangeStageJob`, `MoveToListJob`, …) dispatches `NextTransitionJob` again to keep walking. `ApplyTransitionByNameJob` is the external entry point and lazily creates the `LeadJourney`.

Two consequences: **workflow progress requires a running queue worker**, and re-saving a workflow rewrites the YAML while in-flight `LeadJourney` rows still point at the old place names.

### Email + tracking

`SendMailJob` sends `Mail\CampaignEmail`, writes a synthetic `PostmarkEvent` (`event_type = "Sent"`), and schedules `MessageNotOpenedJob` 24h out. Inbound Postmark callbacks hit `PostmarkWebhookController`. `Message::extractLinks()` regex-parses markdown links from the body — that's what populates link-click condition nodes.

### Routes and authorization

`SalesManagementServiceProvider::registerRoutes()` registers two groups:

- `src/routes/web.php` — prefix + name prefix `teamtnt.sales-management.` + `config('sales-management.middleware')` (default `['web','auth']`).
- `src/routes/webhook.php` — **prefix only, no auth middleware.** Anything added here is publicly reachable.

Gates are defined in `defineAbilities()` as `config('sales-management.permission_prefix').'.<ability>'`, each delegating to a method on `config('sales-management.policy')`. The shipped `src/Policies/SalesManagementPolicy.php` returns `true` for everything — host apps override it via the `policy` config key and the `SalesManagementPolicyContract` interface. Routes enforce with `can:` middleware or `->can(...)`.

Known gap: `src/DataTables/LeadActivityDataTable.php:32` and several Blade `@can` checks reference `sales_management.view-all-activities`, which `defineAbilities()` never registers — so it's always denied.

### Tables (yajra)

12 classes in `src/DataTables/` extend `Yajra\DataTables\Services\DataTable`: `query()` returns an Eloquent builder, `dataTable()` adds an `action` column rendered from a Blade partial, `html()` configures the `Html\Builder`. Front end is jQuery + DataTables 1.x with a hardcoded `de-DE` i18n CDN URL.

### Frontend build

`vite.config.js` builds `src/resources/js/app.js` and `src/resources/scss/light.scss` into `public/sales-management`, with `buildDirectory: "sales-management"` and `hotFile: "public/sales-management/hot"`. Blades match that with an explicit Vite facade chain rather than `@vite`:

```blade
Illuminate\Support\Facades\Vite::useHotFile(public_path('sales-management/hot'))
    ->useBuildDirectory('sales-management')
    ->withEntryPoints(['src/resources/scss/light.scss'])
```

SCSS follows a numbered-layer convention (`1-variables` … `5-vendor`) with `light.scss`/`dark.scss` entry points — only `light.scss` is wired into Vite. `@` aliases to `/src/resources/js`.

## Gotchas

- **Supported range is Laravel 9–13** (Carbon 2/3, Symfony Workflow/Yaml 6–8, yajra 9–13). Every change must keep behaving the same on Laravel 10 + Carbon 2 + Symfony 6, because host apps on `^1.1` pick up new tags automatically. `composer.lock` is gitignored (correct for a library); to test another Laravel, pin it in a scratch copy (`composer require --dev laravel/framework:^11.0 --no-update && composer update -W`). On PHP 8.5 that needs `--ignore-platform-req=php`, because `maatwebsite/excel` 3.1 pins `phpoffice/phpspreadsheet` 1.30, which declares `php <8.5`.
- **`Form::` comes from `laravelcollective/html`**, which is abandoned and has no Laravel 11+ release. `composer.json` requires `laravelcollective/html ^6.2`, which host apps satisfy with `rdx/laravelcollective-html` (it `replace`s the original; ^6.7 covers Laravel 10–13). yajra html dropped the transitive collective dependency in 10.4, so the explicit requirement is what keeps 20+ Blade views working. `rdx/laravelcollective-html` sits in `require-dev` only so the package itself installs on Laravel 11+.
- **`phpunit.xml.dist` targets PHPUnit 10+** (PHPUnit 9 / Pest 1 on Laravel 9 still run with it). It sets `failOnWarning`, `failOnRisky` and `beStrictAboutOutputDuringTests`, so stray `dump()`/`info()` output fails tests.
- **The permission tests are stubs.** `tests/Feature/LeadActivitiesFilterTest.php:149-166` — `createUser()` needs `\App\Models\User` (absent under testbench) and `grantPermission()` silently no-ops without a Spatie-style `givePermissionTo`. They don't actually assert authorization.
- **Tenant-specific values are hardcoded.** `config/sales-management.php` defaults to `primeros.de` sender addresses and PRIMEROS mail branding; `Campaign::getInitialLeadsOnStage()` special-cases a campaign literally named `Bestandskunden` with a `STR_TO_DATE(..., '%d.%m.%Y')` tag-ordering subquery. Much of the UI copy is German.
- **`src/helpers.php` hand-builds `INSERT ... SELECT` statements** (`importTempContactsIntoContacts`, `createLeadsFromContact`, `createListFromPipelineStage`, …). The `WHERE` bindings *are* passed through (`->getBindings()`), but IDs are interpolated into `DB::raw("{$id} as col")` at `src/helpers.php:29,53,67,85` — safe only as long as those stay integers.
- `vite.config.js` uses `splitVendorChunkPlugin`, deprecated in Vite 5 and removed in Vite 6.
