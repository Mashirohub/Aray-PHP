<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, sans-serif;
            background: #eef3f7;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #0d47a1;
            background: #bbdefb;
            padding: 10px 20px;
            border-left: 5px solid #0d47a1;
            box-shadow: 0 2px 5px rgba(0,0,0,0.15);
        }

        .box {
            background: #fff;
            padding: 20px;
            margin-bottom: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            line-height: 1.8;
            font-size: 18px;
        }

        .result-line {
            padding: 5px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .result-line:last-child {
            border-bottom: none;
        }

        .highlight {
            color: #1565c0;
            font-weight: bold;
        }
    </style>
    <h1>การใช้ GOBALS</h1>
    <div class= "box">
        <?php
        $x = 75;
        $y = 25;

        function addition(){
            $GLOBALS['A'] = $GLOBALS['x'] + $GLOBALS['y'];
        }

        addition();
        echo $A;
        ?>
    <h1></h1>
    <div class=box>
        <?php
        echo $_SERVER['PHP_SELF'];
        echo"<br>";
        echo $_SERVER['SERVER_NAME'];
        echo"<br>";
        echo $_SERVER['HTTP_HOST'];
        echo"<br>";
        echo $_SERVER['HTTP_REFERER'];
        echo"<br>";
        echo $_SERVER['HTTP_USER_AGENT'];
        echo"<br>";
        echo $_SERVER['SCRIPT_NAME'];
        echo"<br>";
        ?>

    </div>    
       

</body>
</html>