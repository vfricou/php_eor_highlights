<?php
  require_once 'include/define.php';
  require 'include/functions.php';
  require 'include/vars.php';
?>
<!doctype html>
<html lang="en">
  <?php require 'include/html_head.php'; ?>
  <body>
    <?php require 'include/html_navbar.php';
      $dateyear = Date('Y');
      $datemonth = date('m');
    ?>
    <div class="container-fluid min-vh-100">
      <div class="container">
        <form action="include/insert_data.php" method="POST">
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
        </form>
      </div>


      <div class="container pt-5">
        <h3 class="h3" id="tabledesc">Last 3 month comments</h3>
        <table class="table" aria-describedby="tabledesc">
          <tr>
            <th scope="col">Application</th>
            <th scope="col">Year</th>
            <th scope="col">Month</th>
            <th scope="col">Comment</th>
            <th scope="col"></th>
          </tr>

            <?php
              mysql_connect($db_name);
              if ($month_now <= 02) {
                $year = $year_now - 1;
                if ($month_now == 01) {
                  $month = 11;
                } elseif ($month_now == 02) {
                  $month = 12;
                }
              } else {
                $year = $year_now;
              }

              $comment_list = $mysql_connection->query("
                  SELECT DAP_ID,DAP_NAME,dca_year,dca_month,dca_comment
                  FROM d_appli_contract_month_comment
                      JOIN d_application ON dca_appli_id=DAP_ID
                  WHERE concat(dca_year,dca_month) > DATE_FORMAT(DATE_SUB(curdate(), INTERVAL 3 MONTH ), '%Y%m')
                  ORDER BY `DAP_NAME` ASC;");
              while ($row = $comment_list->fetch_assoc()){
                print_r("<tr>");
                print_r("<td>" . $row['DAP_NAME'] . $table_td_close);
                print_r("<td>" . $row['dca_year'] . $table_td_close);
                print_r("<td>" . $row['dca_month'] . $table_td_close);
                print_r("<td>" . $row['dca_comment'] . $table_td_close);
                print_r("<td>");
                $url_chain = base64_encode(serialize($row));
                print_r(sprintf("<a class=\"btn btn-danger\" href=\"include/delete_data.php?opts=%s\" role=\"button\">Delete</a>", $url_chain));
                print_r($table_td_close);
                print_r("</tr>");
              }
              $mysql_connection->close();
            ?>

        </table>
      </div>
    </div>
  </body>

</html>
