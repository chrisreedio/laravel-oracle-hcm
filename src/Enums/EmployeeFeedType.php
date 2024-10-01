<?php

namespace ChrisReedIO\OracleHCM\Enums;

enum EmployeeFeedType: string
{
    case Hires = 'newhire';
    case Assignment = 'empassignment';
    case Updates = 'empupdate';
    case Payroll = 'payupdate';
    case Termination = 'termination';
    case CancelWorkRelationship = 'cancelworkrelship';
    case UpdateWorkRelationship = 'workrelshipupdate';
}
