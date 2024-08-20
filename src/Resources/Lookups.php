<?php

namespace ChrisReedIO\OracleHCM\Resources;

use ChrisReedIO\OracleHCM\Enums\LookupType;
use ChrisReedIO\OracleHCM\Requests\ListCommonLookups;
use Illuminate\Support\LazyCollection;

class Lookups extends Resource
{
    public function common(LookupType $type): LazyCollection
    {
        $results = $this->connector->paginate(new ListCommonLookups($type));
        return $results->collect();
    }

    public function phoneTypes(): LazyCollection
    {
        return $this->connector
            ->paginate(new ListCommonLookups(LookupType::PHONE_TYPE))
            ->collect();
    }
}
