<?php

namespace ChrisReedIO\OracleHCM\Requests;

use ChrisReedIO\OracleHCM\Data\OracleJob;
use ChrisReedIO\OracleHCM\Data\OracleJobFamily;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListJobs extends Request implements Paginatable
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
        return '/jobs';
    }

    protected function defaultQuery(): array
    {
        return [
            'onlyData' => 'true',
            'totalResults' => 'true',
            // 'expand' => 'all',
            // 'limit' => 200,
            // 'expand' => 'addresses,emails,legislativeInfo,names,phones,workRelationships.assignments.managers',
            // 'expand' => 'addresses,emails,legislativeInfo,names,phones,workRelationships.assignments,photos',
            // 'q' => 'PersonId='.$this->workerId,
        ];
    }

    public function createDtoFromResponse(Response $response): array
    {
        // dd($response->json('items'));
        return array_map(fn ($item) => OracleJob::fromArray($item), $response->json('items'));
    }
}
