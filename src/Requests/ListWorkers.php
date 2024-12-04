<?php

namespace ChrisReedIO\OracleHCM\Requests;

use ChrisReedIO\OracleHCM\Data\OraclePerson;
use Illuminate\Support\Facades\Log;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

use function array_map;
use function implode;
use function json_validate;
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
            // 'expand' => 'addresses,emails,legislativeInfo,names,phones,workRelationships.assignments.allReports',
            // 'expand' => 'addresses,emails,legislativeInfo,names,phones,workRelationships.assignments,photos',
            // 'expand' => 'addresses,emails,legislativeInfo,names,phones,workRelationships.assignments.managers,workRelationships.assignments.allReports',
            'expand' => implode(',', [
                'addresses',
                'emails',
                'legislativeInfo',
                'names',
                'phones',
                'workRelationships.assignments.managers',
                // 'workRelationships.assignments.allReports',
            ]),
        ];
    }

    public function createDtoFromResponse(Response $response): array
    {
        try {
            $isValid = json_validate($response->body());
            if (! $isValid) {
                // If the response body contains "Too many objects match the primary key oracle.jbo.Key" then log that specifically
                if (str_contains($response->body(), 'Too many objects match the primary key oracle.jbo.Key')) {
                    $uriQuery = $response->getPsrRequest()->getUri()->getQuery();
                    // Parse the query string for the offset param
                    parse_str($uriQuery, $query);
                    Log::critical('Invalid Worker JSON! - Too Many objects Error', [
                        // 'url' => ,
                        'offset' => $query['offset'] ?? null,
                        // 'body_end' => substr($response->body(), -150),
                        // 'response' => $response->body(),
                    ]);

                    return [];
                }

                Log::critical('Invalid Worker JSON!.', [
                    'url' => $response->getPsrRequest()->getUri(),
                    // 'response' => $response->body(),
                ]);

                return [];
            }
            $workerItems = $response->json('items');

            return array_map(fn ($item) => OraclePerson::fromArray($item), $workerItems);
        } catch (\Exception $e) {
            Log::critical('Failed to create DTO from response.', [
                'exception' => $e->getMessage(),
                // 'response' => $response->body(),
                'url' => $response->getPsrRequest()->getUri(),
                // 'trace' => $e->getTraceAsString(),
            ]);
            report($e);

            // throw new \Exception('Failed to create DTO from response.', 0, $e);
            return [];
        }
    }
}
