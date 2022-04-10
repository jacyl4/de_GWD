<?php
    session_start();
    $PWDhash = json_decode(file_get_contents('/opt/de_GWD/0conf'))->address->PWD;
    if(isset($PWDhash))
    {
        $GWDpwhash = $PWDhash;
    }
    else
    {
        $GWDpwhash = "";
    }


    if(isset($_GET['logout']))
    {
        unset($_SESSION["GWDhash"]);
        setcookie('persistentlogin', '');
        exit();
    }
    $auth = false;


    if (isset($_COOKIE["persistentlogin"]))
    {
        if ($GWDpwhash = $_COOKIE["persistentlogin"])
        {
            $auth = true;
            setcookie('persistentlogin', $GWDpwhash, time()+60*60*24*7, '/; samesite=none');
        }
        else
        {
            $auth = false;
            setcookie('persistentlogin', '');
        }
    }
    else if(isset($_GET['gwdpw']))
    {
        $logininput = hash('sha256',hash('sha256',$_GET['gwdpw']));
        if( $GWDpwhash === $logininput )
        {
            $_SESSION["GWDhash"] = $GWDpwhash;
            setcookie('persistentlogin', $GWDpwhash, time()+60*60*24*7);
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