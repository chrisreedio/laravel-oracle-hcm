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

    public function hires(): PagedPaginator
    {
        return $this->sendRequest(EmployeeFeedType::Hires->value);
    }

    public function assignments(): PagedPaginator
    {
        return $this->sendRequest(EmployeeFeedType::Assignment->value);
    }

    public function updates(): PagedPaginator
    {
        return $this->sendRequest(EmployeeFeedType::Updates->value);
    }

    public function terminations(): PagedPaginator
    {
        return $this->sendRequest(EmployeeFeedType::Termination->value);
    }

    public function workrelationshipCancellations(): PagedPaginator
    {
        return $this->sendRequest(EmployeeFeedType::CancelWorkRelationship->value);
    }

    public function workrelationshipUpdates(): PagedPaginator
    {
        return $this->sendRequest(EmployeeFeedType::UpdateWorkRelationship->value);
    }
}
