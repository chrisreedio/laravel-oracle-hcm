<?php

namespace ChrisReedIO\OracleHCM\Resources;

use ChrisReedIO\OracleHCM\Enums\LookupType;
use ChrisReedIO\OracleHCM\Requests\ListCommonLookups;
use Illuminate\Support\LazyCollection;

class Lookups extends Resource
{
    public function common(LookupType $type): LazyCollection
    {
        return $this->connector->paginate(new ListCommonLookups($type))->collect();
    }

    public function phoneTypes(): LazyCollection
    {
        return $this->common(LookupType::PHONE_TYPE);
    }

    public function emailTypes(): LazyCollection
    {
        return $this->common(LookupType::EMAIL_TYPE);
    }

    public function addressTypes(): LazyCollection
    {
        return $this->common(LookupType::ADDRESS_TYPE);
    }
}