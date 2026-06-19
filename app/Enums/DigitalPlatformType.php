<?php

namespace App\Enums;

enum DigitalPlatformType: string {
    case NONE = 'none';
    case SOCIAL_MEDIA = 'social_media';
    case ECOMMERCE = 'ecommerce';
    case DELIVERY_APP = 'delivery_app';
    case RIDE_HAILING = 'ride_hailing';

    public function label(): string {
        return match($this) {
            self::NONE => 'Tidak Ada',
            self::SOCIAL_MEDIA => 'Media Sosial',
            self::ECOMMERCE => 'E-commerce / Toko Online',
            self::DELIVERY_APP => 'Aplikasi Pengantaran (Delivery)',
            self::RIDE_HAILING => 'Ojek / Taksi Online (Ride Hailing)',
        };
    }
}
