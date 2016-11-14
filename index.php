<?php
include('db.php');
//region
$get_select_options_subject_region = mysql_query("SELECT DISTINCT subject, subject_id FROM subjects");

$get_select_options_region_region = mysql_query("SELECT DISTINCT region, region_id FROM subjects");

//district
$get_select_options_subject_district = mysql_query("SELECT DISTINCT subject, subject_id FROM district_test");

$get_select_options_region_district = mysql_query("SELECT DISTINCT region, region_id FROM district_test");

?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="favicon-32x32.png" sizes="32x32">
  <title>Регіональні дані ЗНО-2016 (графіки)</title>
  <link rel="stylesheet" href="css/tabs.css" media="screen" title="no title">
  <script src="js/vendors.js"></script>
  <script src="js/charts.js"></script>
  <script src="js/tabs.js"></script>
  <style>
    body {
      background: #F5F5F5;
      font-family: monospace;
    }

    h3 {
      text-align: center;
      color: #5C6773;
      font-weight: normal;
    }

    .container {
      max-width: 1400px;
      min-width: 310px;
      margin: 0 auto;
    }

    form {
      text-align: center;
    }

    #river-region {
      margin-bottom: 30px;
    }

    select {
      width: 20%;
    }

    .selectors-error {
      text-align: center;
      color: #ef5350;
      font-weight: normal;
      font-size: 1.1em;
      margin: 10px 0 0 0;
      visibility: hidden;
      opacity: 0;
      transition: visibility .5s, opacity .5s ease-in-out;
    }

    .selectors-error.show {
      visibility: visible;;
      opacity: 1;
    }

    .copy {
      margin-top: 20px;
      text-align: right;
      font-family: monospace;
      font-size: 12px;
      color: #B89981;
    }

    .copy span {
      color: #333333;
    }
  </style>
  <script>
    function fetchDistrictOptions(val, content)
    {
      content = content.split(" ");
      var content_0 = document.getElementById(""+content[0]+"");
      var content_1 = document.getElementById(""+content[1]+"");

      $.ajax({
        type: 'post',
        url: 'getDistrict.php',
        data: {
          region_id_option:val
        },
        success: function (response) {
          content_0.innerHTML = response;
          content_1.innerHTML = response;
        }
      });
    }
  </script>
</head>
<body>
  <?php include_once("analyticstracking.php") ?>
  <div class="container">
    <div class="material-tabs">
      <div class="tabbed-section__selector">
        <a class="tabbed-section__selector-tab-1 active" href="#">По областях</a>
        <a class="tabbed-section__selector-tab-2" href="#">По регіонах</a>
        <span class="tabbed-section__highlighter"></span>
      </div>

      <div class="tabbed-section-1 visible">
        <h3>Оберіть предмет та області для порівняння</h2>
          <span class="divider"></span>
          <form id="river-region" action="getDataRegion.php" method="POST">
            <select name="subject_id">
              <?php
                while ($row = mysql_fetch_array($get_select_options_subject_region))
                {
                  echo '<option value="'.$row["subject_id"].'">'.$row["subject"].'</option>';
                }
              ?>
            </select>
            <select name="region_id_sup">
              <?php
                while ($row = mysql_fetch_array($get_select_options_region_region))
                {
                  echo '<option value="'.$row["region_id"].'">'.$row["region"].'</option>';
                }
              ?>
            </select>
            <select name="region_id_sub">
              <?php
                mysql_data_seek($get_select_options_region_region, 0);
                while ($row = mysql_fetch_array($get_select_options_region_region))
                {
                  if ($row["region"] == "м.Київ") {
                    echo '<option value="'.$row["region_id"].'" selected>'.$row["region"].'</option>';
                  }
                  echo '<option value="'.$row["region_id"].'">'.$row["region"].'</option>';
                }
              ?>
            </select>
            <button type="submit" name="submit">Показати графік</button>
          </form>

          <div id="container-region" style="min-width: 310px; max-width: 1400px; height: 400px; margin: 0 auto"></div>
        </div>

        <div class="tabbed-section-2 hidden">
          <h3>Оберіть предмет, регіон та район для порівняння</h3>
          <span class="divider"></span>
          <form id="river-district" action="getDataDistrict.php" method="POST">
            <select name="subject_id">
              <?php
                while ($row = mysql_fetch_array($get_select_options_subject_district))
                {
                  echo '<option value="'.$row["subject_id"].'">'.$row["subject"].'</option>';
                }
              ?>
            </select>
            <select name="region_id_first" data-content="district_id_first district_id_second" onchange="fetchDistrictOptions(this.value, this.dataset.content);">
              <option>-</option>
              <?php
                while ($row = mysql_fetch_array($get_select_options_region_district))
                {
                  echo '<option value="'.$row["region_id"].'">'.$row["region"].'</option>';
                }
              ?>
            </select>
            <select name="district_id_first" id="district_id_first">

            </select>
            <!-- <select name="region_id_second" data-content="district_id_second" onchange="fetchDistrictOptions(this.value, this.dataset.content);">
              <option>-</option>
              <?php
                mysql_data_seek($get_select_options_region_district, 0);
                while ($row = mysql_fetch_array($get_select_options_region_district))
                {
                  echo '<option value="'.$row["region_id"].'">'.$row["region"].'</option>';
                }
              ?>
            </select> -->
            <select name="district_id_second" id="district_id_second">

            </select>
            <button type="submit" name="submit">Показати графік</button>
          </form>
          <p id="district-selectors-error" class="selectors-error">* Оберіть параметри!</p>
          <div id="container_district" style="min-width: 310px; max-width: 1400px; height: 400px; margin: 0 auto"></div>
        </div>
      </div>

      <div class="copy" style="">
        <p>&copy; Created by <span>Roman Ivaskevych</span> with Highcharts</p>
      </div>

    </div>
  </body>
  </html>
