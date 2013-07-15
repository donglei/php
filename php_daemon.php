#! /usr/local/php/bin/php
<?php
error_reporting(0);
set_time_limit(0);

$running = true;
$today = strtotime('today');
$tomorrow = strtotime('tomorrow');

	
while ($running)
{
	$today = strtotime('today');
	if ($today == $tomorrow)
	{
		$tomorrow = strtotime('tomorrow');
		//TODO YOUR CODE
	}
}
