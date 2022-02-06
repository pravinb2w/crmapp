<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

class CommonHelper
{
    public static function getExpiry($period, $start_date)
    {
        $period = explode("-",$period);
        $day = $period[0];
        $start = date('Y-m-d', strtotime($start_date ) ); 
        if( strtolower($period[1]) == 'm' ) {
            return date('Y-m-d', strtotime( '+'.$day.' month', strtotime($start) ));
        } else if(  strtolower($period[1]) == 'y' ) {
            return date('Y-m-d', strtotime( '+'.$day.' year', strtotime($start) ));
        } else if(  strtolower($period[1]) == 'd' ) {
            return date('Y-m-d', strtotime( '+'.$day.' days', strtotime($start) ));
        }
    }
}