<?php

namespace ChrisReedIO\OracleHCM\Requests\Feeds;

use ChrisReedIO\OracleHCM\Data\Feeds\OracleFeed;
use ChrisReedIO\OracleHCM\Enums\WorkspaceType;
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
        protected WorkspaceType $workspace,
        protected string $collection
    ) {
        //
    }

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return "/atomservlet/{$this->workspace->value}/{$this->collection}";
        // return '/workers/'.$this->workerId;
    }

    public function createDtoFromResponse(Response $response): OracleFeed
    {
        // dump('DTO Conversion!', $response->json('feed'));

        return OracleFeed::fromArray($response->json('feed'));
    }
}
