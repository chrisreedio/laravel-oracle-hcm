<?php

namespace ChrisReedIO\OracleHCM\Resources\Feeds;

use ChrisReedIO\OracleHCM\Enums\WorkspaceType;
use ChrisReedIO\OracleHCM\OracleFeeds;
use ChrisReedIO\OracleHCM\Requests\Feeds\GetFeedCollection;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\PagedPaginator;

abstract readonly class BaseFeedResource
{
    // protected WorkspaceType $workspace;

    public function __construct(protected OracleFeeds $connector, protected WorkspaceType $workspace)
    {
        // $this->workspace = WorkspaceType::Employee;
        // $this->workspace
    }

    /**
     * Generic method to get a feed collection
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function get(string $collection): Response
    {
        return $this->connector->send($this->makeRequest($collection));
    }

    protected function makeRequest(string $collection): GetFeedCollection
    {
        return new GetFeedCollection($this->workspace, $collection);
    }
}
