<?php
  function mysql_connect($db_database)
  {
    global $db_host;
    global $db_user;
    global $db_pass;
    global $mysql_connection;
    $mysql_connection = new mysqli(
      $db_host,
      $db_user,
      $db_pass
    );
    if (!$mysql_connection) {
      die("Connection failed: " . mysqli_connect_error());
    }
    $mysql_connection->select_db($db_database);
  }
?>
