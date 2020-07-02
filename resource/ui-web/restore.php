<?php require_once('auth.php'); ?>
<?php if (isset($auth) && $auth) {?>
<?php
if ($_FILES["file"]["name"] == "0conf")
{
move_uploaded_file($_FILES['file']['tmp_name'], 'restore/' . $_FILES['file']['name']);
}
exec('sudo cp -f /var/www/html/restore/0conf /usr/local/bin/');

exec('sudo /usr/local/bin/ui-restorePW');
exec('sudo /usr/local/bin/ui-saveDNSChina');
exec('sudo /usr/local/bin/ui-NodeDThide');

if ( json_decode(file_get_contents('/usr/local/bin/0conf'))->address->udp === "on" ){
  	exec('sudo /usr/local/bin/ui-udpON');
} else {
  	exec('sudo /usr/local/bin/ui-udpOFF');
}

exec('sudo systemctl restart smartdns');
exec('sudo systemctl restart doh-client');
exec('sudo systemctl restart v2dns');
exec('sudo systemctl restart vtrui');
exec('sudo systemctl restart iptables-proxy');

exec('sudo /usr/local/bin/ui_4h');

if (json_decode(file_get_contents('/usr/local/bin/0conf'))->address->dhcp === "on")
{
exec('sudo /usr/local/bin/ui-dhcpUP');
} else {
exec('sudo pihole -a disabledhcp');
}

if (!empty(json_decode(file_get_contents('/usr/local/bin/0conf'))->address->alias))
{
exec('sudo /usr/local/bin/ui-markThis');
}

exec('sudo /usr/local/bin/ui-updateGen');
?>
<?php }?>
