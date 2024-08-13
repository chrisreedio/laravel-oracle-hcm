<?php

namespace ChrisReedIO\OracleHCM\Data;

abstract readonly class OracleData
{
    public int $oracle_id;

    abstract public static function fromArray(array $data): self;
}
