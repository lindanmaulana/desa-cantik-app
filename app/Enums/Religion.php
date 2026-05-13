<?php

namespace App\Enums;

enum Religion: string
{
    case ISLAM = 'islam';
    case PROTESTANT = 'protestant';
    case CATHOLIC = 'catholic';
    case HINDU = 'hindu';
    case BUDHA = 'budha';
    case CONFUCIAN = 'confucian';
    case OTHER = 'other';
}
