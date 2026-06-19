<?php

namespace App\Enums;

enum UserRole: string {
    case SUPER_ADMIN = 'super_admin';
    case ADMIN = 'admin';
    case OPERATOR = 'operator';
    case HEAD_OF_RW = 'head_of_rw';
    case HEAD_OF_RT = 'head_of_rt';
}
