<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Form</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Prompt', sans-serif;
            background-color: #f0f2f5; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px 15px;
            margin: 8px 0 20px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box; 
            transition: border-color 0.3s;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #4CAF50;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .box {
            margin-top: 20px;
            padding: 15px;
            background-color: #e8f5e9;
            border-left: 5px solid #4CAF50;
            color: #2e7d32;
            border-radius: 4px;
            animation: fadeIn 0.5s;
        }

        .error {
            border-left-color: #f44336; /* ถ้าไม่กรอกขึ้น error*/
            background-color: #ffebee;
            color: #c62828;
        }

        label {
            font-weight: 500;
            color: #555;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    
    <div class="form">
        <h2>ลงทะเบียนเเบบ Get From</h2>
        <form method="get" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
            <label for="fname">ชื่อ (First Name)</label>
            <input type="text" name="fname" id="fname" placeholder="กรอกชื่อของคุณ..">

            <label for="lname">นามสกุล (Last Name)</label>
            <input type="text" name="lname" id="lname" placeholder="กรอกนามสกุลของคุณ..">

            <input type="submit" value="ยืนยันข้อมูล">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET['fname']) && isset($_GET['lname'])){
                
                $name = htmlspecialchars($_GET['fname']);
                $lname = htmlspecialchars($_GET['lname']);
                
                if (empty($name) || empty($lname)) {
                    echo "<div class='box error'>กรุณากรอกข้อมูลให้ครบถ้วน</div>";
                } else {
                    echo "<div class='box'>";
                    echo "สวัสดีคุณ <strong>" . $name . " " . $lname . "</strong>";
                    echo "</div>";
                }
            }
        }    
        ?>
    </div>

</body>
</html>