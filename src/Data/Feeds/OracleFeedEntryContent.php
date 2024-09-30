<?php

namespace ChrisReedIO\OracleHCM\Data\Feeds;

use ChrisReedIO\OracleHCM\Data\OracleData;
use Illuminate\Support\Collection;

readonly class OracleFeedEntryContent extends OracleData
{
    public function __construct(
        /** @var Collection<Collection> $context */
        public Collection $context,
        /** @var Collection<Collection> $changed */
        public Collection $changed,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            context: collect($data['Context'])->map(fn (array $item) => collect($item)),
            changed: collect($data['Changed Attributes'])->map(fn (array $item) => collect($item)),
        );
    }
}
