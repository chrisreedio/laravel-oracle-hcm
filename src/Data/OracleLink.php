<?php

namespace ChrisReedIO\OracleHCM\Data;

use ChrisReedIO\OracleHCM\Enums\LinkType;

readonly class OracleLink extends OracleData
{
    public function __construct(
        public LinkType $rel,
        public string $href,
        public string $name,
        public string $kind,
    ) {
    }

    public static function fromArray(array $data): OracleData
    {
        return new self(
            rel: LinkType::from($data['rel']),
            href: $data['href'],
            name: $data['name'],
            kind: $data['kind'],
        );
    }
}
