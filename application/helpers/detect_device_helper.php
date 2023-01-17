<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @return bool
 */
function deviceIpod()
{
	if(stripos($_SERVER['HTTP_USER_AGENT'],"iPod"))
	{
		return true;
	}

	return false;
}

/**
 * @return bool
 */
function deviceIphone()
{
	if(stripos($_SERVER['HTTP_USER_AGENT'],"iPhone") && deviceIpad())
	{
		return true;
	}

	return false;
}

/**
 * @return bool
 */
function deviceIpad()
{
	if(stripos($_SERVER['HTTP_USER_AGENT'],"iPad"))
	{
		return true;
	}

	return false;
}

/**
 * @return bool
 */
function deviceWindows()
{
	if(stripos($_SERVER['HTTP_USER_AGENT'],"Windows"))
	{
		return true;
	}

	return false;
}

/**
 * @return bool
 */
function deviceAndroidPhone()
{
	if(stripos($_SERVER['HTTP_USER_AGENT'],"Android"))
	{
		if(stripos($_SERVER['HTTP_USER_AGENT'],"mobile")){
			return true;
		}
	}

	return false;
}



