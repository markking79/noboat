<?php

if (! function_exists('convertOunces')) {
    function convertOunces($ounces, $format = 'imperial') {
        if ($format == 'imperial')
            return round ($ounces / 16, 1) . ' lb.';
        else
            return round ($ounces / 35.27, 1) . ' kg.';
    }
}