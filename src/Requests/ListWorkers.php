<?php

namespace ChrisReedIO\OracleHCM\Requests;

use ChrisReedIO\OracleHCM\Data\OraclePerson;
use Illuminate\Support\Facades\Log;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

use function array_map;
use function report;

class ListWorkers extends Request implements Paginatable
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    public function __construct(
        protected ?string $workerId = null,
    )
    {
        //
    }

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        $path = '/workers';
        if ($this->workerId) {
            $path .= '/'.$this->workerId;
        }

        return $path;
    }

    protected function defaultQuery(): array
    {
        return [
            'onlyData' => 'true',
            'totalResults' => 'true',
            // 'expand' => 'all',
            // 'limit' => 200,
            // 'expand' => 'addresses,emails,legislativeInfo,names,phones,workRelationships.assignments.managers',
            'expand' => 'addresses,emails,legislativeInfo,names,phones,workRelationships.assignments.managers,workRelationships.assignments.allReports',
            // 'expand' => 'addresses,emails,legislativeInfo,names,phones,workRelationships.assignments.allReports',
            // 'expand' => 'addresses,emails,legislativeInfo,names,phones,workRelationships.assignments,photos',
        ];
    }

    public function createDtoFromResponse(Response $response): array
    {
        try {
            $workerItems = $response->json('items');

            return array_map(fn ($item) => OraclePerson::fromArray($item), $workerItems);
        } catch (\Exception $e) {
            Log::critical('Failed to create DTO from response.', [
                'exception' => $e->getMessage(),
                'response' => $response->body(),
                // 'trace' => $e->getTraceAsString(),
            ]);
            report($e);

            // throw new \Exception('Failed to create DTO from response.', 0, $e);
            return [];
        }
    }
}
