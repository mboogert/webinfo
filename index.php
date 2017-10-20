<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Pragma: no-cache"); // HTTP/1.0
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
?>

<?php
$file_content = file('/etc/hostname', FILE_IGNORE_NEW_LINES);
$container_hostname = $file_content[0];
?>

<?php
$dc1 = array("pvm11150.proservers.nl", "pvm11151.proservers.nl", "pvm11152.proservers.nl");
$dc2 = array("pvm11030.proserve.nl", "pvm11031.proserve.nl", "pvm11032.proserve.nl");
$local = array("localhost", "lt30");

if (in_array($container_hostname, $dc1)) {
        $datacenter = "dc1";
        $dc1_color = "green";
        $dc2_color = "blue";
        $background_direction = "-left";
}
if (in_array($container_hostname, $dc2)) {
        $datacenter = "dc2";
        $dc1_color = "blue";
        $dc2_color = "green";
        $background_direction = "-right";
}
if (in_array($container_hostname, $local)) {
        $datacenter = "localhost";
        $dc1_color = "blue";
        $dc2_color = "blue";
        $background_direction = "";
}
?>

<html>
<head>
        <title>Hi, my name is...</title>
        <!--<meta http-equiv="refresh" content="1">-->
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
        <div style="background-image: url(/background<?php print $background_direction; ?>.png); position: absolute; top: 0; bottom: 0; left: 0; right: 0; margin: auto; height: 820px; width: 703px;">
                <div style="background-image: url(/swarm-moby-<?php print $dc1_color; ?>.png); position: absolute; left: 50; top: 600; width: 200px; height: 108;"></div>
                <div style="background-image: url(/swarm-moby-<?php print $dc2_color; ?>.png); position: absolute; right: 50; top: 600; width: 200px; height: 108px;"></div>
        </div>
        <h1>Hi...</h1>
        <?php if($container_hostname) {?><h3>...my docker host is <?php echo $container_hostname; ?></h3><?php } ?>
        <?php if($datacenter) {?><h3>...my datacenter is <?php echo $datacenter; ?></h3><?php } ?>
        <?php if($_SERVER["SERVER_NAME"]) {?><h3>...my host name is <?php echo $_SERVER["SERVER_NAME"]; ?></h3><?php } ?>
        <?php if($_SERVER["SERVER_ADDR"]) {?><h3>...my ip address is <?php echo $_SERVER["SERVER_ADDR"]; ?></h3><?php } ?>
        <?php if($_ENV["HOSTNAME"]) {?><h3>...my container name is <?php echo $_ENV["HOSTNAME"]; ?></h3><?php } ?>
        <?php
        $links = [];
        foreach($_ENV as $key => $value) {
                if(preg_match("/^(.*)_PORT_([0-9]*)_(TCP|UDP)$/", $key, $matches)) {
                        $links[] = [
                                "name" => $matches[1],
                                "port" => $matches[2],
                                "proto" => $matches[3],
                                "value" => $value
                        ];
                }
        }
?>
</div>
</body>
</html>
