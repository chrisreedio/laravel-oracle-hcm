<?php

namespace ChrisReedIO\OracleHCM\Requests\Feeds;

use ChrisReedIO\OracleHCM\Data\Feeds\OracleFeed;
use ChrisReedIO\OracleHCM\Enums\WorkspaceType;
use Saloon\Enums\Method;
use Saloon\Http\PendingRequest;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\PaginationPlugin\Contracts\Paginatable;

use function cache;

class GetFeedCollection extends Request implements Paginatable
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    public function __construct(protected WorkspaceType $workspace, protected string $collection)
    {
        // $myWorkspace = $workspace;
        // $curCollection = $collection;
        $this->middleware()
            ->onRequest(static function (PendingRequest $request) use ($workspace, $collection) {
                $cacheKey = self::generateCacheKey($workspace, $collection);
                $lastQueryTime = cache($cacheKey);
                if ($lastQueryTime) {
                    $request->query()->add('updated-min', $lastQueryTime);
                }
                cache([$cacheKey => now()->toIso8601String()]);
            });
    }

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return "/atomservlet/{$this->workspace->value}/{$this->collection}";
        // return '/workers/'.$this->workerId;
    }

    public function createDtoFromResponse(Response $response): OracleFeed
    {
        // dump('DTO Conversion!', $response->json('feed'));

        return OracleFeed::fromArray($response->json('feed'));
    }

    public static function generateCacheKey(WorkspaceType $workspace, string $collection): string
    {
        return implode(':', [
            'oracle',
            'feeds',
            $workspace->value,
            $collection,
        ]);
    }

    public static function clearCache(WorkspaceType $workspace, string $collection): void
    {
        cache()->forget(self::generateCacheKey($workspace, $collection));
    }
}
