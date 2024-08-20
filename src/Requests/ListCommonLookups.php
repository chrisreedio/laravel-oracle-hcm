<?php

namespace ChrisReedIO\OracleHCM\Requests;

use ChrisReedIO\OracleHCM\Data\OracleLookupValue;
use ChrisReedIO\OracleHCM\Enums\LookupType;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListCommonLookups extends Request implements Paginatable
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    public function __construct(protected LookupType $type) {}

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/commonLookupsLOV';
    }

    protected function defaultQuery(): array
    {
        return [
            'q' => 'LookupType='.$this->type->value,
            'onlyData' => 'true',
        ];
    }

    public function createDtoFromResponse(Response $response): array
    {
        return array_map(fn ($item) => OracleLookupValue::fromArray($item), $response->json('items'));
    }
}
