<?php

$totalapp = 0;
$totalact = 0;

$table = "CREATE TABLE IF NOT EXISTS #TABLENAME# (`id` int(11) NOT NULL AUTO_INCREMENT,`reading_time` datetime NOT NULL,`device_name` varchar(128) NOT NULL,`socket` int(11) NOT NULL,`current` int(11) NOT NULL,`voltage` int(11) NOT NULL,`active_power` int(11) NOT NULL,`app_power` int(11) NOT NULL,PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";
	mysql_connect('localhost', 'pdu', 'XXXX') or syslog(LOG_ERR, 'PDU Power could not connect to mysql database.');
	mysql_select_db('pdu_readings');

$table_name = strtolower(date("m_Y_F") . '_readings');
$statement = str_replace('#TABLENAME#', $table_name, $table);
mysql_query($statement);

	$query = mysql_query('SELECT ip FROM pdu_ip');
	$addresses = array();
	while($address = mysql_fetch_assoc($query))
	{
		$addresses[] = $address['ip'];
	}

foreach($addresses as $address)
{
	$response = snmprealwalk($address, 'public', null); 
	$device_name = str_replace('STRING: ', '', $response['SNMPv2-MIB::sysName.0']);

	$records = array();
	$metrics = array(4,6,7,8);
	foreach($metrics as $metric)
	{
		$query = '.1.3.6.1.4.1.13742.4.1.2.2.1.' . $metric;
        	$response = snmprealwalk($address,'public', $query);

		foreach($response as $id => $data)
		{	
			$socket = str_replace('SNMPv2-SMI::enterprises.13742.4.1.2.2.1.' . $metric . '.', '', $id);
			$data = str_replace('Gauge32: ', '',  $data);
			$records[$socket][$metric] = $data;
		}
	}


	foreach($records as $socket => $output)
	{
		$statement = "INSERT INTO " . $table_name .  " (device_name, reading_time, socket, current, voltage, active_power, app_power)  VALUES('" . $device_name . "', NOW(), " . $socket . "," . $output[4] . "," . $output[6] . "," . $output[7] . "," . $output[8] . " )";
//print $statement . '<br />';
		mysql_query($statement);
		$totalact = $totalact + $output[7];
		$totalapp = $totalapp + $output[8];
	}
	$statement = "INSERT INTO Totaled_Readings_Minute (device_name, reading_time, active_power, app_power)  VALUES('" . $device_name . "', NOW(), " . $totalact . "," . $totalapp . " )";
	mysql_query($statement);
}    
?>