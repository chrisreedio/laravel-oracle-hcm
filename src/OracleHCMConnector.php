<?php

namespace ChrisReedIO\OracleHCM;

use ChrisReedIO\OracleHCM\Enums\OracleAPI;
use ChrisReedIO\OracleHCM\Resources\HCM\HCMLookups;
use Saloon\Traits\Plugins\AcceptsJson;

class OracleHCMConnector extends BaseOracleConnector
{
    use AcceptsJson;

    public function __construct(protected OracleAPI $api = OracleAPI::HCM)
    {
        parent::__construct($api);
    }

    public function lookups(): HCMLookups
    {
        return new HCMLookups($this);
    }
}
