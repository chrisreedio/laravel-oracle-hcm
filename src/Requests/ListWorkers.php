<?php

namespace ChrisReedIO\OracleHCM\Requests;

use ChrisReedIO\OracleHCM\Data\OraclePerson;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListWorkers extends Request implements Paginatable
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/workers';
    }

    protected function defaultQuery(): array
    {
        return [
            'onlyData' => 'true',
            'totalResults' => 'true',
            // 'expand' => 'all',
            'limit' => 200,
            'expand' => 'addresses,emails,legislativeInfo,names,phones,workRelationships.assignments',
            // 'expand' => 'addresses,emails,legislativeInfo,names,phones,workRelationships.assignments,photos',
        ];
    }

    public function createDtoFromResponse(Response $response): array
    {
        return array_map(fn ($item) => OraclePerson::fromArray($item), $response->json('items'));
    }
}
