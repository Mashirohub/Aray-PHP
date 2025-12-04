<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Form Decoration</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Prompt', sans-serif;
            background-color: #f3f4f6; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form {
            background-color: #ffffff;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #666;
            font-weight: 500;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 20px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-family: 'Prompt', sans-serif;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #6c5ce7;
            box-shadow: 0 0 0 4px rgba(108, 92, 231, 0.1);
        }

        input[type="submit"] {
            width: 100%;
            background-color: #6c5ce7;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #5b4cc4;
        }

        .box {
            margin-top: 25px;
            padding: 15px;
            background-color: #edf2f7;
            border-left: 5px solid #6c5ce7;
            border-radius: 4px;
            color: #2d3748;
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="form">
        <h1>ลงทะเบียนเเบบ Post Form</h1>
        
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <label for="fname">First Name</label>
            <input type="text" name="fname" id="fname" placeholder="กรอกชื่อของคุณ...">

            <label for="lname">Last Name</label>
            <input type="text" name="lname" id="lname" placeholder="กรอกนามสกุล...">

            <input type="submit" value="Submit Data">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
           
            $name = $_POST['fname'] ?? '';
            $lname = $_POST['lname'] ?? '';

            if (empty($name)) {
                echo "<div class='box' style='border-left-color: #ff4757; color: #ff4757;'>Name is empty!</div>";
            } else {
                echo "<div class='box'>";
                echo "<strong>Name-LastName:</strong> " . htmlspecialchars($name) . " " . htmlspecialchars($lname);
                echo "</div>";
            }
        }
        ?>
    </div>

</body>
</html>