<?php

namespace ChrisReedIO\OracleHCM\Data;

use Illuminate\Support\Collection;

abstract readonly class OracleData
{
    public int $oracle_id;

    abstract public static function fromArray(array $data): self;
}
