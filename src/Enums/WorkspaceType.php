<?php

namespace ChrisReedIO\OracleHCM\Enums;

enum WorkspaceType: string
{
    case Employee = 'employee';
    case WorkStructures = 'workstructures';
    case AvailabilityPatterns = 'availabilityPatterns';
}
