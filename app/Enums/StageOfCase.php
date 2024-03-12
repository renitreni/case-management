<?php

namespace App\Enums;

enum StageOfCase: string
{
    case TRIAL = 'trial';
    case ARREST = 'arrest';
    case APPEAL = 'appeal';
    case PRETRIAL = 'pretrial';
    case SENTENCING = 'sentencing';
    case ESTABLISHMENT_OF_CAHRGES = 'established of charges';
    case ARRAIGNMENT_AND_BOND_HEARING = 'arraignment and bond hearing';
}
