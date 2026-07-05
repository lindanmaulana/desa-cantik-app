<?php

namespace App\Enums\Traits;


/**
 * @method static array cases() <-- Tambahkan baris ini untuk membungkam Intelephense
 */
trait HasOptions
{
    public static function options(): array
    {
        $options = [];
        foreach (static::cases() as $case) {
            $options[$case->value] = method_exists($case, 'label') ? $case->label() : $case->name;
        }
        return $options;
    }
}
