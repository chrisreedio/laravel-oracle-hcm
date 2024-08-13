<?php

namespace ChrisReedIO\OracleHCM\Data;

use ChrisReedIO\OracleHCM\Data\Traits\HasLinks;

use function tap;

readonly class OracleJobFamily extends OracleData
{
    use HasLinks;

    public function __construct(
        public int $oracle_id,
        public string $name,
        public bool $is_active,
    ) {}

    public static function fromArray(array $data): self
    {
        return tap(new self(
            oracle_id: $data['JobFamilyId'],
            name: $data['JobFamilyName'],
            is_active: $data['ActiveStatus'] === 'A',
        ), fn (self $instance) => $instance->setLinks($data['links']));
    }
}
