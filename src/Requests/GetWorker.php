<?php

namespace ChrisReedIO\OracleHCM\Requests;

use ChrisReedIO\OracleHCM\Data\OraclePerson;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class GetWorker extends Request implements Paginatable
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    public function __construct(
        protected string $workerId,
    )
    {
        //
    }

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/workers';
        // return '/workers/'.$this->workerId;
    }

    protected function defaultQuery(): array
    {
        return [
            'onlyData' => 'true',
            'totalResults' => 'true',
            // 'expand' => 'all',
            // 'limit' => 200,
            // 'expand' => 'addresses,emails,legislativeInfo,names,phones,workRelationships.assignments.managers',
            'expand' => 'addresses,emails,legislativeInfo,names,phones,workRelationships.assignments.managers,workRelationships.assignments.allReports',
            // 'expand' => 'addresses,emails,legislativeInfo,names,phones,workRelationships.assignments,photos',
            'q' => 'PersonId='.$this->workerId,
        ];
    }

    public function createDtoFromResponse(Response $response): ?OraclePerson
    {
        // dd($response->json('items')[0]);
        if (empty($response->json('items'))) {
            return null;
        }

        return OraclePerson::fromArray($response->json('items')[0]);
    }
}
