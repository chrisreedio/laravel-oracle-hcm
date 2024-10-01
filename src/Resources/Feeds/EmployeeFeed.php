<?php

namespace ChrisReedIO\OracleHCM\Resources\Feeds;

use ChrisReedIO\OracleHCM\Enums\EmployeeFeedType;
use ChrisReedIO\OracleHCM\Enums\WorkspaceType;
use ChrisReedIO\OracleHCM\OracleFeeds;
use Saloon\PaginationPlugin\PagedPaginator;

readonly class EmployeeFeed extends BaseFeedResource
{
    public function __construct(OracleFeeds $connector)
    {
        parent::__construct($connector, WorkspaceType::Employee);
    }

    public function updates(): PagedPaginator
    {
        return $this->sendRequest(EmployeeFeedType::Updates->value);
    }

    public function hires(): PagedPaginator
    {
        return $this->sendRequest(EmployeeFeedType::Hires->value);
    }
}
