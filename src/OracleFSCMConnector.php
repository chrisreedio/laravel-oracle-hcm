<?php

namespace ChrisReedIO\OracleHCM;

use ChrisReedIO\OracleHCM\Enums\OracleAPI;
use ChrisReedIO\OracleHCM\OracleHCMConnector;
use ChrisReedIO\OracleHCM\Resources\Lookups;

class OracleFSCMConnector extends OracleHCMConnector
{
    public function __construct(protected OracleAPI $api = OracleAPI::FSCM)
    {
        parent::__construct($api);
    }

    public function lookups(): Lookups
    {
        return new Lookups($this);
    }
}
