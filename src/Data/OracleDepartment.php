<?php

namespace ChrisReedIO\OracleHCM\Data;

use ChrisReedIO\OracleHCM\Data\Traits\HasOracleID;

readonly class OracleDepartment extends OracleData
{
    use HasOracleID;

    public function __construct(
        public ?int $oracle_id,
        public string $name,
        public bool $is_active,
        public string $start_date,
        public string $end_date,
    ) {}

    public static function fromArray(array $data): \ChrisReedIO\OracleHCM\Data\OracleData
    {
        return new OracleDepartment(
            oracle_id: $data['OrganizationId'] ?? null,
            name: $data['Name'],
            is_active: $data['Status'] === 'A',
            start_date: $data['EffectiveStartDate'],
            end_date: $data['EffectiveEndDate'],
        );
    }
}
