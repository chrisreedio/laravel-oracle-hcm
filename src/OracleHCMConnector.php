<?php

namespace ChrisReedIO\OracleHCM;

use Exception;
use Saloon\Http\Auth\BasicAuthenticator;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use Saloon\PaginationPlugin\OffsetPaginator;
use Saloon\Traits\Plugins\AcceptsJson;

use function implode;

class OracleHCMConnector extends Connector implements HasPagination
{
    use AcceptsJson;

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

    protected function defaultQuery(): array
    {
        return [
            'totalResults' => true,
        ];
    }

    public function paginate(Request $request): OffsetPaginator
    {
        return new class(connector: $this, request: $request) extends OffsetPaginator
        {
            protected ?int $perPageLimit = 25;

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
        };
    }
}
