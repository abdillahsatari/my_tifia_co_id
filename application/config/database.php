<?php
defined('BASEPATH') or exit('No direct script access allowed');


$active_group = 'default';
$query_builder = TRUE;


// 'username' => 'tfxco_kabinet',
// 'password' => '6PeM9QHcnWTd',
// 'database' => 'tfxco_kabinet',

//  'hostname' => 'localhost',
//	'username' => 'root',
// 	'username' => 'tfxco_kabinet',
//  'password' => 'b4w@ka12Eng',
//  'database' => 'tfxco_kabinet',

'hostname' => 'localhost',
'username' => 'u8877646_abdillah',
'password' => 'HpPavilionDv6',
'database' => 'u8877646_tifia_kabinet',

$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'u8877646_abdillah',
	'password' => 'HpPavilionDv6',
	'database' => 'u8877646_tifia_kabinet',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	 'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
