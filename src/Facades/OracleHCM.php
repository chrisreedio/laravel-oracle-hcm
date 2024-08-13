<?php

namespace ChrisReedIO\OracleHCM\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \ChrisReedIO\OracleHCM\OracleHCM
 */
class OracleHCM extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \ChrisReedIO\OracleHCM\OracleHCM::class;
    }
}
