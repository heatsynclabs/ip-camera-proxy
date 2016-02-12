<?php

require("config.inc.php");

if($_GET['camera'] == 1) 
{
	$rand = rand(1000,9999);
	$url = 'http://172.22.110.11/snapshot.cgi?'.$rand;
	
	$curl_handle=curl_init();
	curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curl_handle,CURLOPT_URL,$url); 
	curl_setopt($curl_handle, CURLOPT_USERPWD, "$cam1user:$cam1pass");
	$buffer = curl_exec($curl_handle);
	curl_close($curl_handle);
	
	if (empty($buffer))
	{
	    print "";
	}
	elseif($buffer == "Can not get image.")
	{
	    print "Can not get image.";
	}
	else
	{
	    header("Content-Type: image/jpeg");
	    print $buffer;
	}
}
elseif($_GET['camera'] == 2) 
{
	$rand = rand(1000,9999);
	$url = 'http://172.22.110.12/snapshot.cgi?'.$rand;
	
	$curl_handle=curl_init();
	curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curl_handle,CURLOPT_URL,$url); 
	curl_setopt($curl_handle, CURLOPT_USERPWD, "$cam2user:$cam2pass");
	$buffer = curl_exec($curl_handle);
	curl_close($curl_handle);
	
	if (empty($buffer))
	{
	    print "";
	}
	elseif($buffer == "Can not get image.")
	{
	    print "Can not get image.";
	}
	else
	{
	    header("Content-Type: image/jpeg");
	    print $buffer;
	}
}
elseif($_GET['camera'] == 3) 
{
	$rand = rand(1000,9999);
	$url = 'http://172.22.110.13/snapshot.cgi?'.$rand;
	
	$curl_handle=curl_init();
	curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curl_handle,CURLOPT_URL,$url); 
	curl_setopt($curl_handle, CURLOPT_USERPWD, "$cam3user:$cam3pass");
	$buffer = curl_exec($curl_handle);
	curl_close($curl_handle);
	
	if (empty($buffer))
	{
	    print "";
	}
	elseif($buffer == "Can not get image.")
	{
	    print "Can not get image.";
	}
	else
	{
	    header("Content-Type: image/jpeg");
	    print $buffer;
	}
}
elseif($_GET['camera'] == 4) 
{
	$rand = rand(1000,9999);
	$url = 'http://172.22.110.14/snapshot.cgi?'.$rand;
	
	$curl_handle=curl_init();
	curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($curl_handle,CURLOPT_URL,$url); 
	curl_setopt($curl_handle, CURLOPT_USERPWD, "$cam4user:$cam4pass");
	$buffer = curl_exec($curl_handle);
	curl_close($curl_handle);
	
	if (empty($buffer))
	{
	    print "";
	}
	elseif($buffer == "Can not get image.")
	{
	    print "Can not get image.";
	}
	else
	{
	    header("Content-Type: image/jpeg");
	    print $buffer;
	}
}
elseif($_GET['camera'] == 9)
{
	# Used to separate multipart
	$boundary = "IPCamBoundary";
	
	# We start with the standard headers. PHP allows us this much
	header("Cache-Control: no-cache");
	header("Cache-Control: private");
	header("Pragma: no-cache");
	header("Content-type: image/jpeg");
	
	# From here out, we no longer expect to be able to use the header() function
	print "--$boundary\n";
	
	# Set this so PHP doesn't timeout during a long stream
	set_time_limit(0);
	
	# Disable Apache and PHP's compression of output to the client
	@apache_setenv('no-gzip', 1);
	@ini_set('zlib.output_compression', 0);
	
	# Set implicit flush, and flush all current buffers
	@ini_set('implicit_flush', 1);
	for ($i = 0; $i < ob_get_level(); $i++)
	    ob_end_flush();
	ob_implicit_flush(1);
	
	# The loop, producing one jpeg frame per iteration
//	while (true) {
	   
	
	    # Your function to get one jpeg image
		$rand = rand(1000,9999);
		$url = 'http://intranet.heatsynclabs.org:9001/GetData.cgi?'.$rand;
		
		$curl_handle=curl_init();
		curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
		curl_setopt($curl_handle,CURLOPT_URL,$url); 
		$buffer = curl_exec($curl_handle);
		curl_close($curl_handle);
		
		if (!empty($buffer))
		{
			# Per-image header, note the two new-lines
	  		print "Content-type: image/jpeg\n\n";
			print $buffer;
		}
		else {
			print "Content-type: text/html\n\n";
			print "No image.";
		}
	
	    # The separator
	    print "--$boundary\n";
//	}


	
}
else {
	print "Error: No camera requested.";
}


?>
