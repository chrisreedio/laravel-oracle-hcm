<?php

namespace ChrisReedIO\OracleHCM\Data;

abstract readonly class OracleData
{
    abstract public static function fromArray(array $data): self;
}
