<?php

namespace ChrisReedIO\OracleHCM;

use ChrisReedIO\OracleHCM\Enums\OracleAPI;
use ChrisReedIO\OracleHCM\Resources\FSCM\FSCMLookups;

class OracleFSCMConnector extends BaseOracleConnector
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
