<?php

namespace ChrisReedIO\OracleHCM\Resources\Feeds;

use ChrisReedIO\OracleHCM\OracleFeeds;
use ChrisReedIO\OracleHCM\Requests\Feeds\GetFeedCollection;
use Saloon\Http\Response;

readonly class EmployeeFeed
{
    public function __construct(protected OracleFeeds $connector)
    {
        //
    }

    public function get(string $collection): Response
    {
        $request = new GetFeedCollection('employee', $collection);

        return $this->connector->send($request);
    }
}
