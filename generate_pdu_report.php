<?php
$month = $_POST['month'];
$device = $_POST['device'];
$half = $_POST['half'];

if ($half == full){
  $first = 1;
  $last = 20;
  $size = "This is a full rack";
  $check = "odd or even";
}

if ($half == top){
  $first = 1;
  $last = 9;
  $size = "This is a top 1/2 rack";
  $check = "even";
}

if ($half == bottom){
  $first = 9;
  $last = 20;
  $size = "This is a bottom 1/2 rack"; 
  $check = "odd";
}

mysql_connect('localhost', 'pdu', 'XXXX') or die(mysql_error());
mysql_select_db('pdu_readings') or die(mysql_error());
$table_name = $month;

// $sql = mysql_query("SELECT active_power from $table_name WHERE device_name='$device'");

 // $sql = mysql_query("SELECT active_power from $table_name WHERE device_name='$device' AND socket BETWEEN '$first' AND '$last'");

 $sql = mysql_query("SELECT * from $table_name WHERE device_name='$device' AND socket BETWEEN '$first' AND '$last'");

$total = 0;

while ($row = mysql_fetch_assoc($sql)) 
 {
 $value = $row['active_power'];
 $valuekw = $value / 1000;
 $valuekwh = $valuekw / 60;
 $total = $total + $valuekwh;
}

echo "<h2>Power readings from ".$device." socket numbers ".$first." to ".$last."</h2>";

echo "<strong>".$size." and is usualy an ".$check." rack number</strong><br /><br />";

echo "Total kWh - " . round($total, 4) . "<br />";

$ppu = 0.14;

$cost = $total * $ppu;

$cost = round($cost, 2);

echo "Total cost - £" . $cost;

?>