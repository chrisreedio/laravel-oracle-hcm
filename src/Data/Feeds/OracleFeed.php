<?php

namespace ChrisReedIO\OracleHCM\Data\Feeds;

use ChrisReedIO\OracleHCM\Data\OracleData;
use ChrisReedIO\OracleHCM\Data\OracleLink;
use ChrisReedIO\OracleHCM\Enums\LinkType;
use Illuminate\Support\Collection;

readonly class OracleFeed extends OracleData
{
    public function __construct(
        public string $id,
        public string $title,
        public string $subtitle,
        public string $updated,
        public array $authors,
        /** @var Collection<OracleFeedEntry> $entries */
        public Collection $entries,
        /** @var array<OracleLink> $links */
        public array $links,
    ) {}

    public static function fromArray(array $data): self
    {
        try {
            return new self(
                id: $data['id'],
                title: $data['title'],
                subtitle: $data['subtitle'],
                updated: $data['updated'],
                authors: $data['authors'],
                entries: collect($data['entries'])->map(fn (array $entry) => OracleFeedEntry::fromArray($entry)),
                // entries: $data['entries'],
                links: array_map(fn (array $link) => OracleLink::fromArray($link), $data['links']),
            );
        } catch (\Exception $e) {
            dd('dead:', $e);
        }
    }
}
