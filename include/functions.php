<?php
  require 'vars.php';
  include 'init_sentry.php';

  function mysql_connect(string $db_database): void
  {
    global $db_host;
    global $db_user;
    global $db_pass;
    global $db_timeout;
    global $mysql_connection;
    $mysql_connection = mysqli_init() or die ("Failed to create mysqli object");
    $mysql_connection->options(MYSQLI_OPT_CONNECT_TIMEOUT, $db_timeout) or die ('MySQLi Fail to set connect timeout');
    $mysql_connection->options(MYSQLI_OPT_READ_TIMEOUT, $db_timeout) or die ('MySQLi fail to set read timeout');
    $mysql_connection->real_connect(
      $db_host,
      $db_user,
      $db_pass
    ) or die ('Fail to connect to database: '.mysqli_connect_error());

    $mysql_connection->select_db($db_database);
  }
?>
