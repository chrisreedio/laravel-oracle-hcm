<?php

namespace ChrisReedIO\OracleHCM\Resources\Feeds;

use ChrisReedIO\OracleHCM\Enums\WorkspaceType;
use ChrisReedIO\OracleHCM\OracleFeeds;
use Saloon\PaginationPlugin\PagedPaginator;

readonly class EmployeeFeed extends BaseFeedResource
{
    public function __construct(protected OracleFeeds $connector)
    {
        parent::__construct($connector, WorkspaceType::Employee);
    }

    public function updates(): PagedPaginator
    {
        return $this->connector->paginate($this->makeRequest('empupdate'));
    }
}
