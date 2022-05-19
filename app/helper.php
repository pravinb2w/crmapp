<?php 


function superadmin() {
    $role = \Auth::user()->role_id;
    if( isset($role ) && !empty($role)){
        return false;
    }
    return true;
}