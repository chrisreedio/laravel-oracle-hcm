<?php

namespace ChrisReedIO\OracleHCM\Enums;

enum LookupType: string
{
    case PHONE_TYPE = 'PHONE_TYPE';
    case EMAIL_TYPE = 'EMAIL_TYPE';
    case ADDRESS_TYPE = 'ADDRESS_TYPE';
    case TITLE = 'TITLE';
}
