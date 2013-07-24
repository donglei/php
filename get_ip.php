<?php
function valid_ip($ip)
{
    $ip_segments = explode('.', $ip);

    // Always 4 segments needed
    if (count($ip_segments) != 4)
    {
    	return FALSE;
    }
    // IP can not start with 0
    if (substr($ip_segments[0], 0, 1) == '0')
    {
    	return FALSE;
    }
    // Check each segment
    foreach ($ip_segments as $segment)
    {
    	// IP segments must be digits and can not be 
    	// longer than 3 digits or greater then 255
    	if (preg_match("/[^0-9]/", $segment) OR $segment > 255 OR strlen($segment) > 3)
    	{
    		return FALSE;
    	}
    }

    return TRUE;
}
//获取ip地址
function ip()
{
	if ($_SERVER['HTTP_X_FORWARDED_FOR'] AND valid_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
	{
		$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else if ($_SERVER['REMOTE_ADDR'] AND $_SERVER['HTTP_CLIENT_IP'])
	{
		$ip_address = $_SERVER['HTTP_CLIENT_IP'];
	}
	else if ($_SERVER['REMOTE_ADDR'])
	{
		$ip_address = $_SERVER['REMOTE_ADDR'];
	}
	else if ($_SERVER['HTTP_CLIENT_IP'])
	{
		$ip_address = $_SERVER['HTTP_CLIENT_IP'];
	}

	if ($ip_address === FALSE)
	{
		$ip_address = '0.0.0.0';
		
		return $ip_address;
	}

	if (strstr($ip_address, ','))
	{
		$x = explode(',', $ip_address);
		$ip_address = end($x);
	}

	return $ip_address;
}
