<?php

namespace ChrisReedIO\OracleHCM\Resources;

use ChrisReedIO\OracleHCM\OracleHCMConnector;
use Saloon\Http\BaseResource;

class Resource
{
    public function __construct(
        readonly protected OracleHCMConnector $connector,
    ) {}
}
