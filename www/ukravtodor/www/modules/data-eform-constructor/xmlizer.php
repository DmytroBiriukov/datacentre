<?php

header("Content-disposition: attachment; filename=form.xml");
header("Content-Type: application/force-download");
header("Content-Transfer-Encoding: binary");
header("Pragma: no-cache");
header("Expires: 0");

echo $_POST["content"];

?>
