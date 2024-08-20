<?php

namespace ChrisReedIO\OracleHCM\Requests;

use ChrisReedIO\OracleHCM\Data\OracleDepartment;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class ListDepartments extends Request implements Paginatable
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
        return '/departmentsLov';
    }

    protected function defaultQuery(): array
    {
        return [
            // 'q' => '',
            'onlyData' => 'true',
            'fields' => 'OrganizationId,Name,Status,EffectiveStartDate,EffectiveEndDate',
        ];
    }

    public function createDtoFromResponse(Response $response): array
    {
        return array_map(fn ($item) => OracleDepartment::fromArray($item), $response->json('items'));
    }
}
