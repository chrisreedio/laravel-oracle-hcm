<?php

namespace ChrisReedIO\OracleHCM\Resources\HCM;

use ChrisReedIO\OracleHCM\Requests\ListDepartments;
use Illuminate\Support\LazyCollection;

class HCMLookups extends BaseHCMResource
{
    public function departments(): LazyCollection
    {
        return $this->connector->paginate(new ListDepartments)->collect();
    }
}
