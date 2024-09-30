<?php

namespace ChrisReedIO\OracleHCM;

use ChrisReedIO\OracleHCM\Enums\OracleAPI;
use ChrisReedIO\OracleHCM\Traits\HasBasicCiscoAuth;
use Exception;
use Saloon\Http\Auth\BasicAuthenticator;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use Saloon\PaginationPlugin\OffsetPaginator;
use Saloon\Traits\Plugins\AcceptsJson;

use function ceil;
use function config;
use function implode;

class BaseOracleConnector extends Connector implements HasPagination
{
    use AcceptsJson, HasBasicCiscoAuth;

    public function __construct(protected OracleAPI $api = OracleAPI::HCM) {}

    /**
     * The Base URL of the API
     *
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
            // 'hcmRestApi',
            $this->api->value,
            'resources',
            $version,
        ]);
    }

    public function paginate(Request $request): OffsetPaginator
    {
        return new class(connector: $this, request: $request) extends OffsetPaginator
        {
            protected ?int $perPageLimit = 50;

            protected function isLastPage(Response $response): bool
            {
                // return $this->getOffset() >= (int) $response->json('total');
                return $response->json('hasMore') === false;
            }

            protected function getPageItems(Response $response, Request $request): array
            {
                // return $response->json('items');
                return $response->dto();
            }

            protected function getTotalPages(Response $response): int
            {
                return ceil($response->json('totalResults') / $this->perPageLimit);
            }
        };
    }
}
