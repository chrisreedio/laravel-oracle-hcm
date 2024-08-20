<?php

namespace ChrisReedIO\OracleHCM\Data;

use ChrisReedIO\OracleHCM\Enums\LookupType;

readonly class OracleLookupValue extends OracleData
{
    public function __construct(
        public ?LookupType $type = null,
        public ?string $code = null,
        public ?string $meaning = null,
        public ?string $description = null,
        // TODO: Tag, LegislationCode
    ) {}

    public static function fromArray(array $data): OracleData
    {
        return new OracleLookupValue(
            type: $data['LookupType'] !== null ? LookupType::from($data['LookupType']) : null,
            code: $data['LookupCode'] ?? null,
            meaning: $data['Meaning'] ?? null,
            description: $data['Description'] ?? null,
        );
    }
}
