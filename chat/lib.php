<?php

    $sDBServer = "localhost";
    $sDBName = "chat";
    $sDBUsername = "root";
    $sDBPassword = "";


    $oLink = mysql_connect($sDBServer,$sDBUsername,$sDBPassword);
    @mysql_select_db($sDBName) or $sStatus = "Unable to open database";

?>