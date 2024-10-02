<?php

namespace ChrisReedIO\OracleHCM\Data\Feeds;

use ChrisReedIO\OracleHCM\Data\OracleData;
use Illuminate\Support\Collection;

use function array_key_exists;

readonly class OracleFeedEntryContent extends OracleData
{
    public function __construct(
        /** @var Collection<string, string> $context */
        public Collection $context,
        /** @var Collection<Collection> $changed */
        public Collection $changed,
        /** @var Collection<OracleFeedFlexField> $changed */
        public Collection $flex,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            context: collect($data['Context'][0]),
            changed: array_key_exists('Changed Attributes', $data)
                ? collect($data['Changed Attributes'])->map(fn (array $item) => collect($item))
                : collect(),
            flex: array_key_exists('FlexFields', $data)
                ? collect($data['FlexFields'])->map(fn (array $item) => OracleFeedFlexField::fromArray($item))
                : collect(),
        );
    }
}
