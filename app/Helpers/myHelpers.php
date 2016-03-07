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


if (!function_exists('set_active')) {
    /**
     * Returns 'active' if the request path is equal to $path
     *
     * @param $path
     * @param string $active
     * @return string
     */
    function set_active($path, $active = 'active') {


        //handles when the $path is an array
        if(is_array($path)) {
            foreach($path as $item)
            {
                //handles when the $path is sent by action command
                if(starts_with($item, 'http')) {
                    //Get only the path
                    $url = parse_url($item, PHP_URL_PATH).'*';
                    //remove the first slash '/'
                    $url = substr($url, 1);
                }
                else
                    $url = $item;

                //add the the $url to a $parse_url variable
                //this also works if the sent array has mixed action command and manually written paths
                $parse_url[] = $url;
            }
        }
        //cases where the $path is not an array but is sent by the action command
        else if(starts_with($path, 'http')) {
            //Get only the path
            $parse_url = parse_url($path, PHP_URL_PATH).'*';
            //remove the first slash '/'
            $parse_url = substr($parse_url, 1);
        }
        //other cases
        else {
            $parse_url = $path;
        }

        return call_user_func_array('Request::is', (array) $parse_url) ? $active : '';
    }
}