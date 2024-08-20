<?php

namespace ChrisReedIO\OracleHCM\Resources\HCM;

use ChrisReedIO\OracleHCM\Requests\ListDepartments;
use ChrisReedIO\OracleHCM\Requests\ListWorkers;
use Illuminate\Support\LazyCollection;
use Saloon\PaginationPlugin\OffsetPaginator;
use Saloon\PaginationPlugin\Paginator;

class Workers extends BaseHCMResource
{
    public function list(): OffsetPaginator
    {
        return $this->connector->paginate(new ListWorkers());
    }
}
