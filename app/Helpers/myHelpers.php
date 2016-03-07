<?php

if (!function_exists('format_balance')) {

    /**
     * Returns the number formated with balance
     *
     * @param
     * @param int $decimals
     * @param string $dec_point
     * @param string $thousands_sep
     * @return string
     */
    function format_balance($value, $decimals = 2, $dec_point = ',', $thousands_sep = ' ', $include_sign = true)
    {
        return number_format($value , $decimals, $dec_point, $thousands_sep)." &euro;";
    }


}
