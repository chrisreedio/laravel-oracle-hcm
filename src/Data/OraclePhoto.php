<?php

namespace ChrisReedIO\OracleHCM\Data;

readonly class OraclePhoto extends OracleData
{
    public function __construct(
        public string $id,
        public bool $primary,
        public string $type,
        public string $name,
        public string $data,
    ) {}

    public static function fromArray(array $data): OracleData
    {
        return new self(
            id: $data['PhotoId'],
            primary: $data['PrimaryFlag'],
            type: $data['PhotoType'],
            name: $data['PhotoName'],
            data: $data['Photo'],
        );
    }
}
