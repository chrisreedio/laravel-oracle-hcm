<?php

namespace ChrisReedIO\OracleHCM\Data;

use ChrisReedIO\OracleHCM\Data\Traits\HasOracleID;

readonly class OracleEmail extends OracleData
{
    use HasOracleID;

    public function __construct(
        public string $type,
        public string $address,
        public string $from_date,
        public ?int $oracle_id = null,
        public ?string $to_date = null,
        public bool $primary = false,
        public ?string $created_at = null,
        public ?string $updated_by = null,
        public ?string $updated_at = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new OracleEmail(
            type: $data['EmailType'],
            address: $data['EmailAddress'],
            from_date: $data['FromDate'],
            oracle_id: $data['EmailAddressId'] ?? null,
            to_date: $data['ToDate'],
            primary: $data['PrimaryFlag'],
            created_at: $data['CreationDate'],
            updated_by: $data['LastUpdatedBy'],
            updated_at: $data['LastUpdateDate'],
        );
    }
}
