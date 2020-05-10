<?php
    session_start();
    $setupVars = parse_ini_file("/etc/pihole/setupVars.conf");
    if(isset($setupVars['WEBPASSWORD']))
    {
        $GWDpwhash = $setupVars['WEBPASSWORD'];
    }
    else
    {
        $GWDpwhash = "";
    }


    if(isset($_GET['logout']))
    {
        unset($_SESSION["GWDhash"]);
        exit();
    }
    $auth = false;


    if(isset($_GET['gwdpw']))
    {
        $logininput = hash('sha256',hash('sha256',$_GET['gwdpw']));
        if( $GWDpwhash === $logininput )
        {
            $_SESSION["GWDhash"] = $GWDpwhash;
            $auth = true;
        }
        else
        {
            $auth = false;
        }
    }
    else if (isset($_SESSION["GWDhash"]))
    {
        if($_SESSION["GWDhash"] === $GWDpwhash)
        {
            $auth = true;
        }
        else
        {
            $auth = false;
        }
    }
    else
    {
        $auth = false;
    }
?>