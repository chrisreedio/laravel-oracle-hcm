<?php

namespace ChrisReedIO\OracleHCM\Data;

use ChrisReedIO\OracleHCM\Data\Traits\HasOracleID;

readonly class OracleJobFamily extends OracleData
{
    use HasOracleID;

    public function __construct(
        public ?int $oracle_id,
        public string $name,
        public bool $is_active,
    ) {}

    public static function fromArray(array $data): self
    {
        return new OracleJobFamily(
            oracle_id: $data['JobFamilyId'] ?? null,
            name: $data['JobFamilyName'],
            is_active: $data['ActiveStatus'] === 'A'
        );
    }
}
