<?php

if(isset($_POST['region_id_option']))
  {
    include('db.php');

    $region_id = $_POST['region_id_option'];

    $get_select_options_district_district = mysql_query("SELECT district, district_id FROM district_test WHERE region_id = ".$region_id."");

    while($row = mysql_fetch_array($get_select_options_district_district))
       {
         echo '<option value="'.$row["district_id"].'">'.$row["district"].'</option>';
       }
     exit;
  }

?>
