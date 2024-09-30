<?php

namespace ChrisReedIO\OracleHCM\Enums;

enum LinkType: string
{
    case Self = 'self';
    case Canonical = 'canonical';
    case Parent = 'parent';
    case Child = 'child';
    case Associated = 'associated';
    case Related = 'related';
    case Edit = 'edit';
}
