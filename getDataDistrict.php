<?php
if(isset($_POST['subject_id']) &&
   isset($_POST['region_id_first']) &&
   isset($_POST['district_id_first']) &&
   /*isset($_POST['region_id_second']) &&*/
   isset($_POST['district_id_second'])) {

  include('db.php');

  $subject_id = $_POST['subject_id'];
  $region_id_first = $_POST['region_id_first'];
  $district_id_first = $_POST['district_id_first'];
  //$region_id_second = $_POST['region_id_second'];
  $district_id_second = $_POST['district_id_second'];

  $result = array();
  $range = array(); //Regions [min, max]
  $city_sup = array(); //district_id_first
  $city_sub = array(); //district_id_second
  $averages = array("0","0","0","0","0","0","0","0","0");
  $names = array(); //["subject", "Україна", "м.Київ", "region"]

    //$get_range_min
    $get_range_min = mysql_query("SELECT
                    MIN(ZNO2008) AS `2008`,
                    MIN(ZNO2009) AS `2009`,
                    MIN(ZNO2010) AS `2010`,
                    MIN(ZNO2011) AS `2011`,
                    MIN(ZNO2012) AS `2012`,
                    MIN(ZNO2013) AS `2013`,
                    MIN(ZNO2014) AS `2014`,
                    MIN(ZNO2015) AS `2015`,
                    MIN(ZNO2016) AS `2016`
                  FROM district
                  WHERE subject_id = ".$subject_id." AND region_id = ".$region_id_first."");
    while($row = mysql_fetch_row($get_range_min))
    {
      $range_min = $row;
    }
    foreach ($range_min as &$value) {
      $value = round($value, 2);
    }

    //$get_range_max
    $get_range_max = mysql_query("SELECT
                    MAX(ZNO2008) AS `2008`,
                    MAX(ZNO2009) AS `2009`,
                    MAX(ZNO2010) AS `2010`,
                    MAX(ZNO2011) AS `2011`,
                    MAX(ZNO2012) AS `2012`,
                    MAX(ZNO2013) AS `2013`,
                    MAX(ZNO2014) AS `2014`,
                    MAX(ZNO2015) AS `2015`,
                    MAX(ZNO2016) AS `2016`
                  FROM district
                  WHERE subject_id = ".$subject_id." AND region_id = ".$region_id_first."");
    while($row = mysql_fetch_row($get_range_max))
    {
      $range_max = $row;
    }
    foreach ($range_max as &$value) {
      $value = round($value, 2);
    }

    //$format_range_array
    for ($i=0; $i < sizeof($range_max); $i++) {
        $temp = array();
        array_push($temp,$range_min[$i]);
        array_push($temp,$range_max[$i]);
        array_push($range,$temp);
    }

    //$city_sup
    $get_city_sup = mysql_query("SELECT ZNO2008, ZNO2009, ZNO2010, ZNO2011, ZNO2012, ZNO2013, ZNO2014, ZNO2015, ZNO2016
                                FROM district
                                WHERE subject_id = ".$subject_id." AND region_id = ".$region_id_first." AND district_id = ".$district_id_first."");
    while($row = mysql_fetch_row($get_city_sup))
    {
      $city_sup = $row;
    }

    //$city_sub
    $get_city_sub = mysql_query("SELECT ZNO2008, ZNO2009, ZNO2010, ZNO2011, ZNO2012, ZNO2013, ZNO2014, ZNO2015, ZNO2016
                                FROM district
                                WHERE subject_id = ".$subject_id." AND region_id = ".$region_id_first." AND district_id = ".$district_id_second."");
    while($row = mysql_fetch_row($get_city_sub))
    {
      $city_sub = $row;
    }

    //$subject
    $get_subject = mysql_query("SELECT subject
                                FROM district
                                WHERE subject_id = ".$subject_id." AND region_id = ".$region_id_first.""); //AND district_id =".$district_id_first."
    $names_subject = mysql_fetch_row($get_subject);
    $names_subject = $names_subject[0];

    $get__averages_title = mysql_query("SELECT region
                                FROM district WHERE region_id = ".$region_id_first."");
    $names_averages_title = mysql_fetch_row($get__averages_title);
    $names_averages_title = $names_averages_title[0];

    $names_range_title = "Всі райони області";

    $names_city_sup_name = mysql_query("SELECT district
                                FROM district
                                WHERE region_id = ".$region_id_first." AND district_id = ".$district_id_first."");
    $names_city_sup_name = mysql_fetch_row($names_city_sup_name);
    $names_city_sup_name = $names_city_sup_name[0];

    $get_city_sub_name = mysql_query("SELECT district
                                FROM district
                                WHERE region_id = ".$region_id_first." AND district_id = ".$district_id_second."");
    $names_city_sub_name = mysql_fetch_row($get_city_sub_name);
    $names_city_sub_name = $names_city_sub_name[0];

    array_push($names,$names_subject);
    array_push($names,$names_averages_title);
    array_push($names,$names_range_title);
    array_push($names,$names_city_sup_name);
    array_push($names,$names_city_sub_name);

    //creating result array
    array_push($result,$range);
    array_push($result,$averages);
    array_push($result,$city_sup);
    array_push($result,$city_sub);
    array_push($result,$names);

  print json_encode($result, JSON_NUMERIC_CHECK);

  mysql_close($con);
} else {
  $empty = "false";
  print $empty;
}
?>
