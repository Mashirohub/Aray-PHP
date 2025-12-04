<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Array (วันที่ 4 ธันวาคม 2568)</title>

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

</head>
<body>

    <h1>แบบทดสอบ Array ใน index PHP</h1>
    <div class="box">
        <?php
        $cars = array("Volvo", "BMW", "Toyota");
        echo "<div class='result-line'>I like <span class='highlight'>" . $cars[0] . "</span>, <span class='highlight'>" . $cars[1] . "</span> and <span class='highlight'>" . $cars[2] . "</span>.</div>";
        ?>
    </div>

    <h1>แบบทดสอบ Associative Array</h1>
    <div class="box">
        <?php
        $age = array("Peter"=>"35", "KAi"=>"37", "Somsi"=>"43", "Sompong"=>"19");

        echo "<div class='result-line'>Peter is <span class='highlight'>" . $age['Peter'] . "</span> years old.</div>";
        echo "<div class='result-line'>KAi is <span class='highlight'>" . $age['KAi'] . "</span> years old.</div>";
        echo "<div class='result-line'>Somsi is <span class='highlight'>" . $age['Somsi'] . "</span> years old.</div>";
        echo "<div class='result-line'>Sompong is <span class='highlight'>" . $age['Sompong'] . "</span> years old.</div>";
        ?>
    </div>

    <h1>การใช้ For กับ Index Array</h1>
    <div class="box">
        <?php
        $Animal = array("Salmon","Bear","Wolf","Cat","Dog","Fish");
        $arrlen = count($Animal);

        for($x = 0; $x < $arrlen; $x++) {
            echo "<div class='result-line'>" . $Animal[$x] . "</div>";
        }
        ?>
    </div>

    <h1>การใช้ Foreach กับ Index Array</h1>
    <div class="box">
        <?php
        $Animal = array("Salmon","Bear","Wolf","Cat","Dog","Fish");

        foreach($Animal as $value) {
            echo "<div class='result-line'>" . $value . "</div>";
        }
        ?>
    </div>

    <h1>การใช้ Foreach กับ Associative Array</h1>
    <div class="box">
        <?php
        $Animal = array("Salmon"=>"40", "Bear"=>"37", "Wolf"=>"27",
                        "Cat"=>46, "Dog"=>"50", "Fish"=>"49");

        foreach($Animal as $x => $x_value) {
            echo "<div class='result-line'>" . $x . " ขนาด <span class='highlight'>" . $x_value . " นิ้ว</span></div>";
        }
        ?>
    </div>
    <h1>การใช้ Array 2 มิติ(Two - Dimansion)</h1>
    <div class= "box">
        <?php
        $cars = array(
            array("Volvo",22,18),
            array("BMW",15,13),
            array("Saab",5,2),
            array("Land Rover",17,15),
        );
        $rows = count($cars);
        for($row = 0; $row < $rows; $row++){
            echo "<p><b>Row number $row</b></p>";
            echo"<ul>";
            $cols = count($cars[$row]);
            for ($col = 0; $col < $cols; $col++){
                echo "<li>".$cars[$row][$col]."</li>";
            }
            echo"</ul>";
        }
        ?>


</body>
</html>
