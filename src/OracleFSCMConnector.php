<?php

namespace ChrisReedIO\OracleHCM;

use ChrisReedIO\OracleHCM\Enums\OracleAPI;
use ChrisReedIO\OracleHCM\Resources\FSCMLookups;

class OracleFSCMConnector extends OracleHCMConnector
{
    public function __construct(protected OracleAPI $api = OracleAPI::FSCM)
    {
        parent::__construct($api);
    }

    public function lookups(): FSCMLookups
    {
        return new FSCMLookups($this);
    }
}
