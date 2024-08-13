<?php

namespace ChrisReedIO\OracleHCM\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class ListRecruitingJobFamilies extends Request
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
}
