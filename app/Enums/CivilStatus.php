<?php

namespace App\Enums;

enum CivilStatus: string
{
    case Single = 'S';
    case Married = 'M';
    case WidowOrWidower = 'W';
    case Separated = 'SE';
}
