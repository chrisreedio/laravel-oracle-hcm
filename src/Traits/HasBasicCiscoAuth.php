<?php

namespace ChrisReedIO\OracleHCM\Traits;

use Exception;
use Saloon\Http\Auth\BasicAuthenticator;

use function config;

trait HasBasicCiscoAuth
{
    /**
     * @throws Exception
     */
    protected function defaultAuth(): BasicAuthenticator
    {
        $username = config('oracle-hcm.username');
        $password = config('oracle-hcm.password');

        if (empty($username) || empty($password)) {
            throw new \Exception('Oracle HCM username and password must be set in the config');
        }

        return new BasicAuthenticator($username, $password);
    }
}
