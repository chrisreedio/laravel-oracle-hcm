<?php

namespace ChrisReedIO\OracleHCM\Resources\FSCM;

use ChrisReedIO\OracleHCM\OracleFSCMConnector;

abstract class BaseFSCMResource
{
    public function __construct(
        readonly protected OracleFSCMConnector $connector,
    ) {}
}
