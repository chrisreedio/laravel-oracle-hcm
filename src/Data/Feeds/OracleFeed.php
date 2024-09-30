<?php

namespace ChrisReedIO\OracleHCM\Data\Feeds;

use ChrisReedIO\OracleHCM\Data\OracleData;
use ChrisReedIO\OracleHCM\Data\OracleLink;
use Illuminate\Support\Collection;

use function array_key_exists;
use function collect;

readonly class OracleFeed extends OracleData
{
    public function __construct(
        public string $id,
        public string $title,
        public string $subtitle,
        public string $updated,
        public array $authors,
        /** @var array<OracleLink> $links */
        public array $links,
        /** @var Collection<OracleFeedEntry> $entries */
        public Collection $entries,
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
                links: array_map(fn (array $link) => OracleLink::fromArray($link), $data['links']),
                entries: array_key_exists('entries', $data)
                    ? collect($data['entries'])->map(fn (array $entry) => OracleFeedEntry::fromArray($entry))
                    : collect(),
            );
        } catch (\Exception $e) {
            dump('Fatal DTO Parse Error');
            dump('data:', $data);
            dd('dead:', $e);
        }
    }
}
