<?php
    include("../../../cgi-bin/def.php");
    $tableName="userprofiles";
    $keyValues=array(
        "userprf"     => $_POST['userprf']);
    sqlDeleteQuery($tableName, $keyValues)
?>