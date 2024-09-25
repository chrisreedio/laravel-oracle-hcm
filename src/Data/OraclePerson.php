<?php

namespace ChrisReedIO\OracleHCM\Data;

use ChrisReedIO\OracleHCM\Data\Traits\HasOracleID;

use function array_key_exists;

readonly class OraclePerson extends OracleData
{
    use HasOracleID;

    public function __construct(
        public ?int $oracle_id,
        public string $person_number,
        public ?string $birth_date,
        public string $created_at,
        public ?string $death_date,
        public ?string $updated_by,
        public ?string $updated_at,

        /** public array<OracleEmail> $emails **/
        public array $emails,

        /** public array<OraclePersonName> $names */
        public array $names,

        /** public array<OracleWorkRelationship> $workRelationships */
        public array $workRelationships,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new OraclePerson(
            oracle_id: $data['PersonId'] ?? null,
            person_number: $data['PersonNumber'],
            birth_date: $data['DateOfBirth'] ?? null,
            created_at: $data['CreationDate'],
            death_date: $data['DateOfDeath'] ?? null,
            updated_by: $data['LastUpdatedBy'] ?? null,
            updated_at: $data['LastUpdateDate'] ?? null,
            emails: array_key_exists('emails', $data) ? array_map(fn ($item) => OracleEmail::fromArray($item),
                $data['emails']) : [],
            names: array_key_exists('names', $data) ? array_map(fn ($item) => OraclePersonName::fromArray($item),
                $data['names']) : [],
            workRelationships: array_key_exists('workRelationships', $data) ? array_map(fn ($item
            ) => OracleWorkRelationship::fromArray($item), $data['workRelationships']) : [],
        );
    }
}
