<?php

namespace ChrisReedIO\OracleHCM;

use Exception;
use Saloon\Http\Auth\BasicAuthenticator;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;
use function implode;

class OracleHCMConnector extends Connector
{
    use AcceptsJson;

    /**
     * The Base URL of the API
     * @throws Exception
     */
    public function resolveBaseUrl(): string
    {
        $baseUrl = config('oracle-hcm.base_uri');
        $version = config('oracle-hcm.version');

        if (empty($baseUrl) || empty($version)) {
            throw new \Exception('Oracle HCM base URI and version must be set in the config');
        }

        return implode('/', [
            'https://'.$baseUrl,
            'hcmRestApi',
            'resources',
            $version,
        ]);
    }

    /**
     * Default headers for every request
     */
    protected function defaultHeaders(): array
    {
        return [];
    }

    /**
     * Default HTTP client options
     */
    protected function defaultConfig(): array
    {
        return [];
    }

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
