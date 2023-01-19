<?php

namespace Teamtnt\SalesManagement\Commands;

use Illuminate\Console\Command;

class SalesManagementCommand extends Command
{
    public $signature = 'sales-management';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
