<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
if ($_FILES["file"]["name"] == "0conf")
{
move_uploaded_file($_FILES['file']['tmp_name'], 'restore/' . $_FILES['file']['name']);
}
exec('sudo cp -f /var/www/html/restore/0conf /usr/local/bin/');

if (!empty(json_decode(file_get_contents('/usr/local/bin/0conf'))->address->alias))
{
exec('sudo /usr/local/bin/ui-markThis');
}

if (!empty(json_decode(file_get_contents('/usr/local/bin/0conf'))->v2ad))
{
exec('sudo /usr/local/bin/ui-v2adADD');
} else {
exec('sudo /usr/local/bin/ui-v2adDEL');
}

if (!empty(json_decode(file_get_contents('/usr/local/bin/0conf'))->address->alias))
{
exec('sudo /usr/local/bin/ui-dhcpUP');
} else {
exec('sudo pihole -a disabledhcp');
}

if (!empty(json_decode(file_get_contents('/usr/local/bin/0conf'))->updateAddr))
{
exec('sudo /usr/local/bin/ui-updateGen');
}

exec('sudo /usr/local/bin/ui-restorePW');
exec('sudo /usr/local/bin/ui-NodeDThide');

$data = json_decode(file_get_contents('/usr/local/bin/0conf'), true);
if ( $data['splitDNS'] === "gfw" ){
	exec('sudo /usr/local/bin/ui-changeNLgfw');
}
elseif ( $data['splitDNS'] === "chnw" ){
	exec('sudo /usr/local/bin/ui-changeNLchnw');
}

exec('sudo systemctl restart iptables-proxy');
exec('sudo systemctl restart doh-client');
exec('sudo systemctl restart v2dns');
exec('sudo systemctl restart vtrui');
exec('sudo chmod 666 /usr/local/bin/0conf');

?>
<?php }?>
