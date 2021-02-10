<?php
  include_once '../conf/define.php';
  include 'functions.php';
  require 'vars.php';
?>

<!doctype html>
<html lang="en">
  <?php require 'html_head.php'; ?>
  <body>
    <?php require 'html_navbar.php'; ?>
        <div class="container-fluid">
        <?php
          mysql_connect($db_name);

          $result = $mysql_connection->query("SELECT DAP_ID FROM d_application WHERE DAP_SOURCE = 'global' and DAP_NAME = '$_POST[app_selector]'");
          $row = $result->fetch_assoc();
          $sql_insert = "INSERT INTO d_appli_contract_month_comment (dca_appli_id,dca_year,dca_month,dca_comment)
          VALUES (".$row['DAP_ID'].",".$_POST['year_selector'].",".$_POST['month_selector'].",'".$_POST['desc']."')";

          if ($mysql_connection->query($sql_insert) === TRUE) {
            echo '<div class="alert alert-info mt-5" role="alert">New highlight correctly inserted</div>';
          } else {
            echo '<div class="alert alert-danger mt-5" role="alert">Error: '. $sql_insert . "<br/>" . $mysql_connection->error . '</div>';
          }

          $mysql_connection->close();
        ?>
    </div>
  </body>
</html>
