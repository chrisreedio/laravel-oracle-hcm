<?php

namespace ChrisReedIO\OracleHCM\Data\Traits;

use ChrisReedIO\OracleHCM\Data\OracleLink;
use ChrisReedIO\OracleHCM\Enums\LinkType;

use function array_map;

trait HasLinks
{
    /** @var array<OracleLink> */
    protected readonly array $links;

    /** Direct Link to Oracle for this item */
    public readonly string $oracle_url;

    public function setLinks(array $links): self
    {
        $this->links = self::mapLinks($links);

        // Look for a link that is a canonical link
        $this->oracle_url = collect($this->links)
            ->first(fn (OracleLink $link) => $link->rel === LinkType::Canonical)?->href;

        // $this->oracle_url = $canonicalUrl?->href;

        return $this;
    }

    public static function mapLinks(array $links): array
    {
        return array_map(fn ($link) => OracleLink::fromArray($link), $links);
    }

    public function getLinks(): array
    {
        return $this->links;
    }
}
