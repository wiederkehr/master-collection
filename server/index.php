<?php

header('Content-Type: application/json');

$db_hostname = 'localhost';
$db_database = 'example';
$db_username = 'example';
$db_password = 'example';

$db_server = mysql_connect($db_hostname, $db_username, $db_password);
mysql_select_db('...', $db_server); 


if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());

mysql_select_db($db_database)
or die("Unable to select database: " . mysql_error());

mysql_query('SET CHARACTER SET utf8');

// just query the database through mysql in normal fashion
$result = mysql_query("SELECT `id`, `newspaper`, `title`, `date`, `newscategory`, `url` FROM `graphics` ORDER BY title DESC") or die('Could not query');


$json = array();
$total_records = mysql_num_rows($result);

if($total_records >= 1){
  while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
    $json[] = $row;
  }
}

echo json_encode($json);


// mysql_close($db);

?>