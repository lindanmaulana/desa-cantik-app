<?php

namespace App\Enums;

enum EconomicStatus: string
{
    case VERY_POOR = 'very_poor';
    case POOR = 'poor';
    case NEAR_POOR = 'near_poor';
    case MIDDLE_INCOME = 'middle_income';
    case HIGH_INCOME = 'high_income';
}
