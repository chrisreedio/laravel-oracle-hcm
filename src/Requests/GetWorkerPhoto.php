<?php

namespace ChrisReedIO\OracleHCM\Requests;

use ChrisReedIO\OracleHCM\Data\OraclePhoto;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class GetWorkerPhoto extends Request implements Paginatable
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
        return '/publicWorkers/'.$this->workerId.'/child/photos';
    }

    public function __construct(
        protected string $workerId,
    ) {}

    protected function defaultQuery(): array
    {
        return [
            'onlyData' => 'true',
            'totalResults' => 'true',
            // 'expand' => 'all',
            // 'limit' => 200,
            // 'expand' => 'addresses,emails,legislativeInfo,names,phones,workRelationships.assignments',
            // 'expand' => 'addresses,emails,legislativeInfo,names,phones,workRelationships.assignments,photos',
        ];
    }

    public function createDtoFromResponse(Response $response): array
    {
        if (empty($response->json('items'))) {
            return [];
        }
        return array_map(fn ($item) => OraclePhoto::fromArray($item), $response->json('items'));
    }
}
