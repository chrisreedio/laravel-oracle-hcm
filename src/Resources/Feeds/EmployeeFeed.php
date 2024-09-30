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

    /**
     * Generic method to get a feed collection
     * @param string $collection
     * @return Response
     * @throws \Saloon\Exceptions\Request\FatalRequestException
     * @throws \Saloon\Exceptions\Request\RequestException
     */
    public function get(string $collection): Response
    {
        $request = new GetFeedCollection('employee', $collection);

        return $this->connector->send($request);
    }

    public function updates(): Response
    {
        $request = new GetFeedCollection('employee', 'empupdate');

        return $this->connector->send($request);
    }


}
