<?php
  include_once 'define.php';
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
          $url_opts = unserialize(base64_decode($_GET['opts']));

          mysql_connect($db_name);

          $sql_delete = "DELETE FROM d_appli_contract_month_comment
          WHERE
             dca_appli_id = " . $url_opts['DAP_ID'] . " AND
             dca_year = " . $url_opts['dca_year'] . " AND
             dca_month = ".$url_opts['dca_month']." AND
             dca_comment = '" . $url_opts['dca_comment'] . "'";

          if ($mysql_connection->query($sql_delete) === TRUE) {
            echo '<div class="alert alert-info mt-5" role="alert">Highlight correctly deleted</div>';
          } else {
            echo '<div class="alert alert-danger mt-5" role="alert">Error: '. $sql_delete . "<br/>" . $mysql_connection->error . '</div>';
          }

          $mysql_connection->close();
        ?>
    </div>
  </body>
</html>
