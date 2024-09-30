<?php

namespace ChrisReedIO\OracleHCM\Data\Feeds;

use ChrisReedIO\OracleHCM\Data\OracleData;
use Illuminate\Support\Collection;

use function array_key_exists;

readonly class OracleFeedFlexField extends OracleData
{
    public function __construct(
        public string $code,
        public Collection $changed,
        public ?string $context = null,

    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            code: $data['FlexFieldCode'],
            changed: array_key_exists('Changed Attributes', $data)
                ? collect($data['Changed Attributes'])->map(fn (array $item) => collect($item))
                : collect(),
            context: $data['ContextCode'] ?? null,
        );
    }
}
