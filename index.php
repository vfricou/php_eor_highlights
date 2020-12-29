<?php
  require_once 'include/define.php';
  require 'include/functions.php';
  require 'include/vars.php';
?>
<!doctype html>
<html lang="en">
  <?php require 'include/html_head.php'; ?>
  <body>
    <?php require 'include/html_navbar.php'; ?>
    <div class="container-fluid">
      <?php
        $dateyear = Date('Y');
        $datemonth = date('m');
        ?>
      <form action="include/insert_data.php" method="POST">
        <div class="container">
          <div class="row">
            <div class="col-md-6 mb-3 mt-5">
              <div class="input-group">
                <span class="input-group-text">Application</span>
                <select class="form-control" name="app_selector">
                  <?php
                  mysql_connect($db_name);
                  $result = $mysql_connection->query("SELECT DAP_NAME FROM d_application WHERE DAP_SOURCE = 'global'");
                  while ($row = $result->fetch_assoc()) {
                    print_r("<option>" . $row['DAP_NAME'] . $option_tag_close);
                  }
                  $mysql_connection->close();
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-3 mb-3 mt-5">
              <div class="input-group">
                <span class="input-group-text">Year</span>
                <select class="form-control" name="year_selector">
                  <?php
                  $year_now = date('Y');
                  mysql_connect($db_name);
                  $result = $mysql_connection->query("SELECT DISTINCT(year) FROM d_time_date ORDER BY `year` ASC;");
                  while ($row = $result->fetch_assoc()) {
                    if ( $row['year'] == $year_now ) {
                      print_r($option_tag_open . $row['year'] . "' selected>" . $row['year'] . $option_tag_close);
                    } else {
                      print_r($option_tag_open . $row['year'] . "'>" . $row['year'] . $option_tag_close);
                    }
                  }
                  $mysql_connection->close();
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-3 mb-3 mt-5">
              <div class="input-group">
                <span class="input-group-text">Month</span>
                <select class="form-control" name="month_selector">
                  <?php
                  $month_now = date('m');
                  mysql_connect($db_name);
                  $result = $mysql_connection->query("SELECT DISTINCT(month) FROM d_time_date ORDER BY `month` ASC;");
                  while ($row = $result->fetch_assoc()) {
                    if ( $row['month'] == $month_now ) {
                      print_r($option_tag_open . $row['month'] . "' selected>" . $row['month'] . $option_tag_close);
                    } else {
                      print_r($option_tag_open . $row['month'] . "'>" . $row['month'] . $option_tag_close);
                    }
                  }
                  $mysql_connection->close();
                  ?>
                </select>
              </div>

            </div>
          </div>
          <div class="row">
            <div class="col-md-12 mb-3">
              <div class="input-group">
                <span class="input-group-text">Description</span>
                <textarea class="form-control" name="desc" aria-label="Description" placeholder="Incident description"></textarea>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button class="btn btn-primary me-md-2" type="submit">Submit</button>
              </div>
            </div>
          </div>
      </form>
    </div>
  </body>
</html>
