<?php
namespace common\helpers;

use DateTime;

class Date
{
    public static function normalizeDate(?string $value): ?string
    {
        if (empty($value)) {
            return null;
        }

        $value = trim($value);

        $formats = [
            'Y-m-d','Y/m/d','Y.m.d','Ymd',
            'd/m/Y','d-m-Y','d.m.Y',
            'd/m/y','d-m-y',
            'm/d/Y','m-d-Y','m.d.Y',
            'm/d/y',
            'd M Y','d F Y',
            'M d Y','F d Y',
            'Y M d','Y F d',
            'Y-m-d H:i:s','Y-m-d H:i',
            'c'
        ];

        foreach ($formats as $format) {

            $dt = DateTime::createFromFormat($format, $value);

            if ($dt) {

                $errors = DateTime::getLastErrors();

                if ($errors === false || ($errors['warning_count'] == 0 && $errors['error_count'] == 0)) {
                    return $dt->format('Y-m-d');
                }

            }
        }

        return null;
    }
}