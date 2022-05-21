<?php

if (!function_exists('phone_map')) {
    /**
     * Throws exception
     *
     * @param string $phone
     * @return array
     */
    function phone_map(String $phone)
    {
        $_phone = [
            'code'   => '62',
            'number' => $phone,
        ];

        if (str_starts_with($phone, '08')) {
            $_phone['code']   = '62';
            $_phone['number'] = substr($phone, 1);
        } elseif (str_starts_with($phone, '62')) {
            $_phone['code']   = '62';
            $_phone['number'] = substr($phone, 2);
        }

        return $_phone;
    }
}
