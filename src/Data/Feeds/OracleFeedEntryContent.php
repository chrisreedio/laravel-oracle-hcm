<?php

namespace ChrisReedIO\OracleHCM\Data\Feeds;

use Carbon\Carbon;
use ChrisReedIO\OracleHCM\Data\OracleData;
use ChrisReedIO\OracleHCM\Data\OracleLink;
use ChrisReedIO\OracleHCM\Enums\LinkType;
use Illuminate\Support\Collection;

readonly class OracleFeedEntryContent extends OracleData
{
    public function __construct(
        public Collection $context,
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
