<html>
<head>
        <title>Hello world!</title>
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
        <img id="logo" src="logo.png" />
        <h1>Hi...</h1>
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
</body>
</html>
