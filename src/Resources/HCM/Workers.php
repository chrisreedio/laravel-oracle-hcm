<?php

namespace ChrisReedIO\OracleHCM\Resources\HCM;

use ChrisReedIO\OracleHCM\Requests\GetWorker;
use ChrisReedIO\OracleHCM\Requests\ListWorkers;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\OffsetPaginator;

class Workers extends BaseHCMResource
{
    public function list(): OffsetPaginator
    {
        return $this->connector->paginate(new ListWorkers);
    }

    public function get(?string $workerId = null): Response
    {
        return $this->connector->send(new GetWorker($workerId));
    }
}
