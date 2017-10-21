<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Pragma: no-cache"); // HTTP/1.0
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
?>

<?php
  require "predis/autoload.php";
  Predis\Autoloader::register();

  $redis = new Predis\Client(array(
    "scheme" => "tcp",
    "host" => "swarmdemo_redis",
    "port" => 6379));
?>

<?php
$file_content = file('/etc/hostname', FILE_IGNORE_NEW_LINES);
$container_hostname = $file_content[0];
?>

<?php
$dc1 = array("pvm11150.proservers.nl", "pvm11151.proservers.nl", "pvm11152.proservers.nl");
$dc2 = array("pvm11030.proserve.nl", "pvm11031.proserve.nl", "pvm11032.proserve.nl");
$local = array("localhost", "lt30");

$pvm11150_color = "blue";
$pvm11151_color = "blue";
$pvm11152_color = "blue";
$pvm11030_color = "blue";
$pvm11031_color = "blue";
$pvm11032_color = "blue";

$pvm11150_counter = ($redis -> get('pvm11150_counter'));
$pvm11151_counter = ($redis -> get('pvm11151_counter'));
$pvm11152_counter = ($redis -> get('pvm11152_counter'));
$pvm11030_counter = ($redis -> get('pvm11030_counter'));
$pvm11031_counter = ($redis -> get('pvm11031_counter'));
$pvm11032_counter = ($redis -> get('pvm11032_counter'));

switch ($container_hostname) {
    case "pvm11150.proservers.nl":
	$pvm11150_color = "green";
	$pvm11150_counter++;
        $redis -> set('pvm11150_counter', $pvm11150_counter);
        break;
    case "pvm11151.proservers.nl":
        $pvm11151_color = "green";
	$pvm11151_counter++;
        $redis -> set('pvm11151_counter', $pvm11151_counter);
        break;
    case "pvm11152.proservers.nl":
        $pvm11152_color = "green";
	$pvm11152_counter++;
        $redis -> set('pvm11152_counter', $pvm11152_counter);
        break;
    case "pvm11030.proserve.nl":
        $pvm11030_color = "green";
	$pvm11030_counter++;
        $redis -> set('pvm11030_counter', $pvm11030_counter);
        break;
    case "pvm11031.proserve.nl":
        $pvm11031_color = "green";
	$pvm11031_counter++;
        $redis -> set('pvm11031_counter', $pvm11031_counter);
        break;
    case "pvm11032.proserve.nl":
        $pvm11032_color = "green";
	$pvm11032_counter++;
        $redis -> set('pvm11032_counter', $pvm11032_counter);
        break;
}

if (in_array($container_hostname, $dc1)) {
        $datacenter = "dc1";
        $dc1_color = "green";
        $dc2_color = "blue";
        $background_direction = "left";
}
if (in_array($container_hostname, $dc2)) {
        $datacenter = "dc2";
        $dc1_color = "blue";
        $dc2_color = "green";
        $background_direction = "right";
}
if (in_array($container_hostname, $local)) {
        $datacenter = "localhost";
        $dc1_color = "blue";
        $dc2_color = "blue";
        $background_direction = "left";
}
?>

<html>
<head>
        <title>Docker Swarm HA</title>
        <meta http-equiv="refresh" content="1">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
        <style>
        body {
                background-color: white;
                text-align: center;
                padding: 50px;
                font-family: "Open Sans","Helvetica Neue",Helvetica,Arial,sans-serif;
        }

        #logo {
                margin-bottom: 40px;
        }
        </style>
</head>
<body>
<div style="background-image: url(/background.png); position: absolute; top: 0; bottom: 0; left: 0; right: 0; margin: auto; height: 820px; width: 703px;">
	<div style="background-image: url(/background-<?php print $background_direction; ?>.png); position: absolute; top: 0; bottom: 0; left: 0; right: 0; margin: auto; height: 820px; width: 703px;">
		<div style="background-image: url(/swarm-moby-<?php print $dc1_color; ?>.png); position: absolute; left: 75; top: 450; width: 200px; height: 108;"></div>
		<div style="background-image: url(/swarm-moby-<?php print $dc2_color; ?>.png); position: absolute; right: 75; top: 450; width: 200px; height: 108px;"></div>

		<div style="background-image: url(/docker-host-<?php print $pvm11150_color; ?>.png); position: absolute; left: 25; top: 600; width: 84px; height: 111px;"></div>
		<div style="position: absolute; left: 25; top: 710; width: 55; text-align: center;"><b><?php print $pvm11150_counter; ?></b></div>
		<div style="background-image: url(/docker-host-<?php print $pvm11151_color; ?>.png); position: absolute; left: 140; top: 600; width: 84px; height: 111px;"></div>
		<div style="position: absolute; left: 140; top: 710; width: 55; text-align: center;"><b><?php print $pvm11151_counter; ?></b></div>
		<div style="background-image: url(/docker-host-<?php print $pvm11152_color; ?>.png); position: absolute; left: 250; top: 600; width: 84px; height: 111px;"></div>
		<div style="position: absolute; left: 250; top: 710; width: 55; text-align: center;"><b><?php print $pvm11152_counter; ?></b></div>

		<div style="background-image: url(/docker-host-<?php print $pvm11030_color; ?>.png); position: absolute; right: 25; top: 600; width: 84px; height: 111px;"></div>
		<div style="position: absolute; right: 25; top: 710; width: 55; text-align: center;"><b><?php print $pvm11030_counter; ?></b></div>
		<div style="background-image: url(/docker-host-<?php print $pvm11031_color; ?>.png); position: absolute; right: 140; top: 600; width: 84px; height: 111px;"></div>
		<div style="position: absolute; right: 140; top: 710; width: 55; text-align: center;"><b><?php print $pvm11031_counter; ?></b></div>
		<div style="background-image: url(/docker-host-<?php print $pvm11032_color; ?>.png); position: absolute; right: 250; top: 600; width: 84px; height: 111px;"></div>
		<div style="position: absolute; right: 250; top: 710; width: 55; text-align: center;"><b><?php print $pvm11032_counter; ?></b></div>

	</div>
</div>
</body>
</html>
