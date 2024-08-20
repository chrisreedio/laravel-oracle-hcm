<?php

namespace ChrisReedIO\OracleHCM\Resources;

use ChrisReedIO\OracleHCM\Requests\ListDepartments;
use Illuminate\Support\LazyCollection;

class HCMLookups extends Resource
{
    public function departments(): LazyCollection
    {
        return $this->connector->paginate(new ListDepartments)->collect();
    }
}
