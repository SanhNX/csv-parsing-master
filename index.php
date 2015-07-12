<?php
$username = 'root';
$password = '';
$hostname = 'localhost';
$db = 'csv';

$dbhandle = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");
if (!$dbhandle) {
    echo "Could not connect to server<br>";
    die(mysql_error());
} else {
    echo "Connection established<br>"; 
}

$con1 = mysql_select_db($db);

if (!$con1) {
    echo "Cannot select database<br>";
    die(mysql_error()); 
} else {
    echo "Database selected<br>";
}
$i = 0;
if (($handle = fopen("test.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $sql = "INSERT INTO record (id, name, marks) VALUES (default,'".mysql_escape_string($data[0])."','".mysql_escape_string($data[1])."')";
        $query = mysql_query($sql);
        if($query){
            echo "row ".$i." inserted<br>";
        }
        else{
            echo die(mysql_error());
        }
        $i++;
    }
    fclose($handle);
}

?>
