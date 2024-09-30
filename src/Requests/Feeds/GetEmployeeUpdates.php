<?php

namespace ChrisReedIO\OracleHCM\Requests\Feeds;

use ChrisReedIO\OracleHCM\Data\OraclePerson;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class GetEmployeeUpdates extends Request implements Paginatable
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    public function __construct(
        //
    ) {
        //
    }

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/atomservlet/employee';
        // return '/workers/'.$this->workerId;
    }

    protected function defaultQuery(): array
    {
        return [
            'onlyData' => 'true',
            'totalResults' => 'true',
            // 'expand' => 'all',
            // 'limit' => 200,
            'expand' => 'addresses,emails,legislativeInfo,names,phones,workRelationships.assignments',
            // 'expand' => 'addresses,emails,legislativeInfo,names,phones,workRelationships.assignments,photos',
            'q' => 'PersonId='.$this->workerId,
        ];
    }

    public function createDtoFromResponse(Response $response): OraclePerson
    {
        return OraclePerson::fromArray($response->json('items')[0]);
    }
}
