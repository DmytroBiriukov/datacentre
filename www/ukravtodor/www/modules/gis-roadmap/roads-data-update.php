<?php
    include("../../../cgi-bin/db_functions.php"); 
    $tableName="gis_roads";
    $keyValues=array(
        "OGR_FID"   => $_POST['OGR_FID']);
    $fieldValues=array(
        "title"     => $_POST['title'],
        "numbway"   => $_POST['numbway'],
        "type"      => $_POST['type']);
    sqlUpdateInsertQuery($tableName, $fieldValues, $keyValues);
?>