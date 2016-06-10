<?php

function flash($title = null, $message = null)
{
	$flash = app('App\Http\Utilities\Flash');

	if (func_num_args() == 0)
	{
		return $flash;
	}

	return $flash->info($title, $message);
}

function messageGen($request = null)
{
	$generator = app('App\Http\Utilities\MessageGenerator');

	if (func_num_args() == 0)
	{
		return $generator;
	}

	return $generator->make_message($request);
}

?>