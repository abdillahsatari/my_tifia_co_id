<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

/*
|--------------------------------------------------------------------------
| Maintenance Hook
|--------------------------------------------------------------------------
|
| Hook point. The hook will be called very early during system execution.
*/
$hook['pre_system'][] = array(
    'class'    => 'maintenance_hook', // The name of the class wish to invoke
    'function' => 'offline_check', // The method name wish to call
    'filename' => 'maintenance_hook.php', // The file name containing the class/function
    'filepath' => 'hooks' // The name of the directory containing hook script
);
