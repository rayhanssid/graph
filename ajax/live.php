<?php
	include("../config/config.php");
	$interface = $_GET["interface"];
	$API = new routeros_api();
	if ($API->connect($ip , $username, $password)) {
		$rows = array(); 
		$rows2 = array();	
		$API->write("/interface/monitor-traffic",false);
		$API->write("=interface=".$interface,false);  
		$API->write("=once=",true);
		$READ = $API->read(false);
		$ARRAY = $API->parse_response($READ);
		if(count($ARRAY)>0){  
			$rx = number_format($ARRAY[0]["rx-bits-per-second"]/1024,1);
			$tx = number_format($ARRAY[0]["tx-bits-per-second"]/1024,1);
			$rows['name'] = 'Tx';
			$rows['data'][] = $tx;
			$rows2['name'] = 'Rx';
			$rows2['data'][] = $rx;
		}else{  
			echo $ARRAY['!trap'][0]['message'];	 
		} 
	}else{
		echo "<font color='#ff0000'>The connection failed. Check if the Api is active.</font>";
	}
	$API->disconnect();
	$result = array();
	array_push($result,$rows);
	array_push($result,$rows2);
	print json_encode($result, JSON_NUMERIC_CHECK);
?>
