<?php

namespace ChrisReedIO\OracleHCM;

use ChrisReedIO\OracleHCM\Data\Feeds\OracleFeed;
use ChrisReedIO\OracleHCM\Enums\OracleAPI;
use ChrisReedIO\OracleHCM\Resources\Feeds\EmployeeFeed;
use ChrisReedIO\OracleHCM\Traits\HasBasicCiscoAuth;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use Saloon\PaginationPlugin\PagedPaginator;
use Saloon\Traits\Plugins\AcceptsJson;

use function config;

class OracleFeeds extends Connector implements HasPagination
{
    use AcceptsJson, HasBasicCiscoAuth;

    public function __construct(protected OracleAPI $api = OracleAPI::HCM)
    {
        //
    }

    public function resolveBaseUrl(): string
    {
        $baseUrl = config('oracle-hcm.base_uri');

        if (empty($baseUrl)) {
            throw new \Exception('Oracle HCM base URI must be set in the config');
        }

        return 'https://'.$baseUrl.'/hcmRestApi';
    }

    public function employees(): EmployeeFeed
    {
        return new EmployeeFeed($this);
    }

    protected function defaultQuery(): array
    {
        return [
            'totalResults' => 'true',
        ];
    }

    public function paginate(Request $request): PagedPaginator
    {
        return new class(connector: $this, request: $request) extends PagedPaginator
        {
            protected ?int $perPageLimit = 5;

            protected function isLastPage(Response $response): bool
            {
                return $response->json('feed.entries') === null;
            }

            protected function getPageItems(Response $response, Request $request): array
            {
                // return $response->json('items');
                /* @var OracleFeed $responseDto */
                $responseDto = $response->dto();

                return $responseDto->entries->all();
            }

            protected function applyPagination(Request $request): Request
            {
                $request->query()->add('page', $this->currentPage + 1);

                if (isset($this->perPageLimit)) {
                    $request->query()->add('page-size', $this->perPageLimit);
                }

                return $request;
            }
        };
    }
}
