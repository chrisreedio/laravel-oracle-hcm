<?php

namespace ChrisReedIO\OracleHCM;

use ChrisReedIO\OracleHCM\Enums\OracleAPI;
use ChrisReedIO\OracleHCM\Resources\Feeds\EmployeeFeed;
use Saloon\Traits\Plugins\AcceptsJson;

use function config;
use function implode;

class OracleFeeds extends BaseOracleConnector
{
    use AcceptsJson;

    public function __construct(protected OracleAPI $api = OracleAPI::HCM)
    {
        parent::__construct($api);
    }

    public function resolveBaseUrl(): string
    {
        $baseUrl = config('oracle-hcm.base_uri');

        if (empty($baseUrl)) {
            throw new \Exception('Oracle HCM base URI must be set in the config');
        }

        return implode('/', [
            'https://'.$baseUrl,
            // 'hcmRestApi',
            $this->api->value,
        ]);
    }

    public function employees(): EmployeeFeed
    {
        return new EmployeeFeed($this);
    }
}
