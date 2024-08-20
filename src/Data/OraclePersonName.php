<?php

namespace ChrisReedIO\OracleHCM\Data;

use ChrisReedIO\OracleHCM\Data\Traits\HasOracleID;

readonly class OraclePersonName extends OracleData
{
    use HasOracleID;

    public function __construct(
        public ?int $oracle_id,
        public string $first_name,
        public ?string $middle_name,
        public string $last_name,
        public string $start_date,
        public ?string $end_date,
        public bool $is_active,
    ) {
    }

    public static function fromArray(array $data): self
    {
        $endDate = $data['EffectiveEndDate'] !== null ? $data['EffectiveEndDate'] : null;
        if ($endDate === '4712-12-31') {
            $endDate = null;
        }
        return new OraclePersonName(
            oracle_id: $data['PersonNameId'] ?? null,
            first_name: $data['FirstName'],
            middle_name: $data['MiddleNames'] ?? null,
            last_name: $data['LastName'],
            start_date: $data['EffectiveStartDate'],
            end_date: $endDate,
            is_active: $endDate === null,
        );
    }
}
