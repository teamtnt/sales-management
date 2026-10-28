<?php

use Teamtnt\SalesManagement\FSM\StateMachineBuilder;
use Teamtnt\SalesManagement\Jobs\SendMailJob;
use Teamtnt\SalesManagement\Models\LeadJourney;
use Teamtnt\SalesManagement\Models\Workflow;

function workflowElements(): array
{
    $sendMessage = [
        'id' => '2',
        'type' => 'sendMessage',
        'data' => ['action' => SendMailJob::class, 'argument' => 5, 'title' => 'Hallo: "Willkommen" & mehr', 'type' => 'action'],
        'handleBounds' => ['source' => [['id' => 'state.message.sent.2']]],
    ];
    $messageOpened = [
        'id' => '3',
        'type' => 'messageOpened',
        'data' => ['action' => 'condition', 'argument' => 5, 'title' => 'Hallo', 'type' => 'condition', 'links' => ['https://example.com/a?b=1#c']],
        'handleBounds' => ['source' => [['id' => 'state.message.opened.3'], ['id' => 'state.message.not_opened.3']]],
    ];

    return [
        ['id' => '1', 'type' => 'start', 'data' => [], 'handleBounds' => ['source' => [['id' => 'start']]]],
        $sendMessage,
        $messageOpened,
        ['id' => 'e1-2', 'source' => '1', 'target' => '2', 'sourceHandle' => 'start', 'targetNode' => $sendMessage],
        ['id' => 'e2-3', 'source' => '2', 'target' => '3', 'sourceHandle' => 'state.message.sent.2', 'targetNode' => $messageOpened],
    ];
}

function assertWalksWorkflow(string $stateMachineDefinition): void
{
    $workflow = new Workflow(['name' => 'workflow_7']);
    $workflow->state_machine_definition = $stateMachineDefinition;

    $definition = $workflow->getStateMachineDefinition();
    expect($definition->getPlaces())->toBe([
        'start' => 'start',
        'state.message.sent.2' => 'state.message.sent.2',
        'state.message.opened.3' => 'state.message.opened.3',
        'state.message.not_opened.3' => 'state.message.not_opened.3',
    ]);

    $fsm = $workflow->fsm();
    $journey = new LeadJourney;
    $journey->current_place = 'start';

    $enabled = $fsm->getEnabledTransitions($journey);
    expect($enabled)->toHaveCount(1)
        ->and($enabled[0]->getName())->toBe('transition.message.sent.5');

    $metadata = $fsm->getMetadataStore()->getTransitionMetadata($fsm->getEnabledTransition($journey, 'transition.message.sent.5'));
    expect($metadata)->toMatchArray([
        'action' => SendMailJob::class,
        'argument' => 5,
        'title' => 'Hallo: "Willkommen" & mehr',
        'type' => 'sendMessage',
    ]);

    $fsm->apply($journey, 'transition.message.sent.5');
    expect($journey->getCurrentPlace())->toBe('state.message.sent.2');

    $names = array_map(fn ($transition) => $transition->getName(), $fsm->getEnabledTransitions($journey));
    expect($names)->toBe(['transition.message.opened.5', 'transition.message.not_opened.5']);

    $openedMetadata = $fsm->getMetadataStore()->getTransitionMetadata($fsm->getEnabledTransition($journey, 'transition.message.opened.5'));
    expect($openedMetadata['links'])->toBe(['https://example.com/a?b=1#c']);

    $fsm->apply($journey, 'transition.message.opened.5');
    expect($journey->getCurrentPlace())->toBe('state.message.opened.3')
        ->and($fsm->getEnabledTransitions($journey))->toBe([]);
}

it('builds a state machine definition that rehydrates into a working workflow', function () {
    $yaml = (new StateMachineBuilder)->buildFromElements(workflowElements(), 'workflow_7');

    assertWalksWorkflow($yaml);
});

it('rehydrates a definition stored by symfony/yaml 6', function () {
    // Emitted by StateMachineBuilder with symfony/yaml 6.4 for workflowElements().
    $storedYaml = <<<'YAML'
workflow_7:
    type: state_machine
    supports: [Teamtnt\SalesManagement\Models\LeadJourney]
    initial_place: start
    places: { start: null, state.message.sent.2: null, state.message.opened.3: null, state.message.not_opened.3: null }
    transitions: [{ from: start, to: state.message.sent.2, metadata: { action: Teamtnt\SalesManagement\Jobs\SendMailJob, argument: 5, title: 'Hallo: "Willkommen" & mehr', type: sendMessage }, name: transition.message.sent.5 }, { from: state.message.sent.2, to: state.message.opened.3, metadata: { action: condition, argument: 5, title: Hallo, type: messageOpened, links: ['https://example.com/a?b=1#c'] }, name: transition.message.opened.5 }, { from: state.message.sent.2, to: state.message.not_opened.3, metadata: { action: condition, argument: 5, title: Hallo, type: messageOpened, links: ['https://example.com/a?b=1#c'] }, name: transition.message.not_opened.5 }]

YAML;

    expect((new StateMachineBuilder)->buildFromElements(workflowElements(), 'workflow_7'))->toBe($storedYaml);

    assertWalksWorkflow($storedYaml);
});
