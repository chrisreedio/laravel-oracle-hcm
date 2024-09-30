<?php

namespace ChrisReedIO\OracleHCM\Data\Feeds;

use Carbon\Carbon;
use ChrisReedIO\OracleHCM\Data\OracleData;
use ChrisReedIO\OracleHCM\Data\OracleLink;

readonly class OracleFeedEntry extends OracleData
{
    public function __construct(
        public string $id,
        public string $title,
        public string $summary,
        // public string $content,
        public OracleFeedEntryContent $content,

        // Timestamps
        public Carbon $updated,
        public Carbon $published,
        // public string $updated,
        // public string $published,

        // // Metadata
        /** @var array<OracleLink> $links */
        public array $links,
        public array $authors,
    ) {}

    public static function fromArray(array $data): self
    {
        // $links = $data['links'];
        // dd('links: ', $links);
        return new self(
            id: $data['id'],
            title: $data['title'],
            summary: $data['summary'],
            // content: $data['content'],
            content: OracleFeedEntryContent::fromArray(json_decode($data['content'], true)),

            // Timestamps
            updated: Carbon::parse($data['updated']),
            published: Carbon::parse($data['published']),
            // updated: $data['updated'],
            // published: $data['published'],

            // // Metadata
            links: array_map(fn ($link) => OracleLink::fromArray($link), $data['links']),
            authors: $data['authors'],
        );
    }
}
