<?php

namespace ChrisReedIO\OracleHCM\Resources\HCM;

use ChrisReedIO\OracleHCM\Requests\ListWorkers;
use Saloon\PaginationPlugin\OffsetPaginator;

class Workers extends BaseHCMResource
{
    public function list(): OffsetPaginator
    {
        return $this->connector->paginate(new ListWorkers);
    }
}
