<?php

namespace ChrisReedIO\OracleHCM\Resources\Feeds;

use ChrisReedIO\OracleHCM\Enums\WorkspaceType;
use ChrisReedIO\OracleHCM\OracleFeeds;
use ChrisReedIO\OracleHCM\Requests\Feeds\GetFeedCollection;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\PagedPaginator;

readonly class EmployeeFeed
{
    protected WorkspaceType $workspace;

    public function __construct(protected OracleFeeds $connector)
    {
        $this->workspace = WorkspaceType::Employee;
    }

    /**
     * Generic method to get a feed collection
     *
     * @throws \Saloon\Exceptions\Request\FatalRequestException
     * @throws \Saloon\Exceptions\Request\RequestException
     */
    public function get(string $collection): Response
    {
        $request = new GetFeedCollection($this->workspace, $collection);

        return $this->connector->send($request);
    }

    public function updates(): PagedPaginator
    {
        $request = new GetFeedCollection($this->workspace, 'empupdate');

        return $this->connector->paginate($request);
    }
}
