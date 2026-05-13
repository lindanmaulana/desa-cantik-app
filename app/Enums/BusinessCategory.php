<?php

namespace App\Enums;

enum BusinessCategory: string {
    case CULINARY = 'culinary';
    case FASHION = 'fashion';
    case AGRICULTURE = 'agriculture';
    case SERVICES = 'services';
    case CRAFT = 'craft';
    case TRADE = 'trade';
    case OTHER = 'other';
}
