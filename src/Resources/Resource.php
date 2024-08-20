<?php

namespace ChrisReedIO\OracleHCM\Resources;

use ChrisReedIO\OracleHCM\OracleHCMConnector;

class Resource
{
    public function __construct(
        readonly protected OracleHCMConnector $connector,
    ) {}
}
