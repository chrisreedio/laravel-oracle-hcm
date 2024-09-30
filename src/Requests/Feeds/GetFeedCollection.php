<?php

namespace ChrisReedIO\OracleHCM\Requests\Feeds;

use ChrisReedIO\OracleHCM\Data\Feeds\OracleFeed;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class GetFeedCollection extends Request implements Paginatable
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    public function __construct(
        protected string $workspace,
        protected string $collection
    ) {
        //
    }

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return "/atomservlet/{$this->workspace}/{$this->collection}";
        // return '/workers/'.$this->workerId;
    }

    protected function defaultQuery(): array
    {
        return [
            //
        ];
    }

    public function createDtoFromResponse(Response $response): OracleFeed
    {
        // dd($response->json());
        return OracleFeed::fromArray($response->json('feed'));
    }
}
