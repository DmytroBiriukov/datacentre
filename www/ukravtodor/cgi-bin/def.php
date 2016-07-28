<?php

define("host", "localhost");
define("user", "ukravtodor");
define("pwd", "mcblk0p7");
define("database", "ukravtodor");
define("projectpath", "/home/dmitrij/www/ukravtodor");
define("projecttmppath", "/home/dmitrij/tmp");

$serverIP=explode(".", $_SERVER[SERVER_ADDR]);
if($serverIP[0]=="10" && $serverIP[1]=="10") 
{ define("ip_server_local", "10.10.20.40");
  define("ip_server_remote", "213.160.135.162:10080");
}else 
{ if($serverIP[0]=="10" && $serverIP[1]=="39") 
  { define("ip_server_local", "10.39.5.251");
    define("ip_server_remote", "91.202.128.36");  
  } else
  { //define("ip_server_local", "datacentre.dyndns.info");
    //define("ip_server_remote", "datacentre.dyndns.info");      
	define("ip_server_local", "192.168.1.2");
    define("ip_server_remote", "192.168.1.2");      
  }
}
?>