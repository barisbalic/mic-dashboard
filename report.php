<h2>Power report generator</h2>
<?php
mysql_connect('localhost', 'pdu', 'XXXX') or die(mysql_error());
mysql_select_db('pdu_readings') or die(mysql_error());

echo "<form action='generate_pdu_report.php' method='post'>";
echo "<label for='month'>Select month:</label>";
echo "<select name='month'>";
$sql = "SHOW TABLES";
$result = mysql_query($sql);
while ($row = mysql_fetch_row($result)) {
    if ($row[0] == pdu_ip){
    } else {
    echo "<option value='{$row[0]}'>{$row[0]}</option>\n";
    }
}
echo "</select><br /><br />";

echo "<label for='device'>Select device:</label>";
echo "<select name='device'>";
$sql = "SELECT device_name FROM pdu_ip ORDER BY device_name DESC";
$result = mysql_query($sql);
while ($row = mysql_fetch_row($result)) {
    echo "<option value='{$row[0]}'>{$row[0]}</option>\n";
}
echo "</select><br /><br />";

echo "<label for=half'>Select cab type:</label><br />";
echo "Full <input type='radio' name='half' value='full'><br />Top <input type='radio' name='half' value='top'><br />Bottom <input type='radio' name='half' value='bottom'><br /><br />";

echo "<input type='submit' value='Send'> <input type='reset'>";

?>