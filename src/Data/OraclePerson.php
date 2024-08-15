<?php

namespace ChrisReedIO\OracleHCM\Data;

readonly class OraclePerson extends OracleData
{
    public function __construct(
        public int $oracle_id,
        public string $person_number,
        public string $birth_date,
        public string $created_at,
        public ?string $death_date = null,
        public ?string $updated_by = null,
        public ?string $updated_at = null,

        /** public array<OracleEmail> $emails **/
        public array $emails,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new OraclePerson(
            oracle_id: $data['PersonId'],
            person_number: $data['PersonNumber'],
            birth_date: $data['DateOfBirth'],
            created_at: $data['CreationDate'],
            death_date: $data['DateOfDeath'] ?? null,
            updated_by: $data['LastUpdatedBy'] ?? null,
            updated_at: $data['LastUpdateDate'] ?? null,
            emails: array_map(fn ($item) => OracleEmail::fromArray($item), $data['Emails']),
        );
    }
}
