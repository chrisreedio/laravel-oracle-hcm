<?php

namespace ChrisReedIO\OracleHCM\Data;

readonly class OracleLocation extends OracleData
{
    public function __construct(
        public int $oracle_id,
        public string $oracle_code,
        public string $name,
        public bool $is_active,
        public string $city,
        public string $state,
        public string $zip,
        public string $full_address,
        public string $start_date,
        public string $end_date,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new OracleLocation(
            oracle_id: $data['LocationId'],
            oracle_code: $data['LocationCode'],
            name: $data['LocationName'],
            is_active: $data['ActiveStatus'] === 'A',
            city: $data['TownOrCity'],
            state: $data['Region2'],
            zip: $data['PostalCode'],
            full_address: $data['SingleLineAddress'],
            start_date: $data['EffectiveStartDate'],
            end_date: $data['EffectiveEndDate'],
        );
    }
}
