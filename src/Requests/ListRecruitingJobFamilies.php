<?php

namespace ChrisReedIO\OracleHCM\Requests;

use ChrisReedIO\OracleHCM\Data\OracleJobFamily;
use Illuminate\Support\Collection;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListRecruitingJobFamilies extends Request implements Paginatable
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/recruitingJobFamilies';
    }

    public function createDtoFromResponse(Response $response): array
    {
        return array_map(fn ($item) => OracleJobFamily::fromArray($item), $response->json('items'));
        // return collect($response->json('items'))->map(fn($item) => OracleJobFamily::fromArray($item));
        // return $response->json();
    }
}
