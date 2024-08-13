<?php

namespace ChrisReedIO\OracleHCM\Commands;

use Illuminate\Console\Command;

class OracleHCMCommand extends Command
{
    public $signature = 'laravel-oracle-hcm';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
