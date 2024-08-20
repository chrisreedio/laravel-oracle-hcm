<?php

namespace ChrisReedIO\OracleHCM\Resources\HCM;

use ChrisReedIO\OracleHCM\OracleHCMConnector;

abstract class BaseHCMResource
{
    public function __construct(
        readonly protected OracleHCMConnector $connector,
    ) {}
}
