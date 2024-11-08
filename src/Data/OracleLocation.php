<?php

namespace ChrisReedIO\OracleHCM\Data;

use ChrisReedIO\OracleHCM\Data\Traits\HasOracleID;

readonly class OracleLocation extends OracleData
{
    use HasOracleID;

    public function __construct(
        public ?int $oracle_id,
        public string $oracle_code,
        public string $name,
        public bool $is_active,
        public ?string $street,
        public ?string $suite,
        public ?string $city,
        public ?string $county,
        public ?string $state,
        public ?string $zip,
        public ?string $start_date,
        public ?string $end_date,
        public ?string $full_address,
        public ?string $phone = null,
        public ?string $description = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new OracleLocation(
            oracle_id: $data['LocationId'] ?? null,
            oracle_code: $data['LocationCode'],
            name: $data['LocationName'],
            is_active: $data['ActiveStatus'] === 'A',
            street: $data['AddressLine1'] ?? null,
            suite: $data['AddressLine2'] ?? null,
            city: $data['TownOrCity'] ?? null,
            county: $data['Region1'] ?? null,
            state: $data['Region2'] ?? null,
            zip: $data['PostalCode'] ?? null,
            start_date: $data['EffectiveStartDate'] ?? null,
            end_date: $data['EffectiveEndDate'] ?? null,
            full_address: $data['SingleLineAddress'] ?? null,
            phone: $data['TelephoneNumber1'] ?? null,
            description: $data['Description'] ?? null,
        );
    }
}
