<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
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
        .con {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }
        .error {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        .message{
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        .name-highlight {
            color: #4CAF50;
            font-weight: 600;
        }
        .btn-back {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #666;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            transition: background-color 0.3s;
        }
        .btn-back:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

    <div class="con">
        <?php
            $fname = isset($_POST['fname']) ? htmlspecialchars($_POST['fname']) : "";
            $lname = isset($_POST['lname']) ? htmlspecialchars($_POST['lname']) : "";

            if (!empty($fname) && !empty($lname)) {
                echo "<div class='message'>ยินดีต้อนรับ<br><span class='name-highlight'>คุณ $fname $lname</span></div>";
                echo "<p>การลงทะเบียนเสร็จสมบูรณ์</p>";
            } else {
                echo "<div class='error' style='color: #f44336;'>เกิดข้อผิดพลาด กรูุณากรอกใหม่</div>";
                echo "<p>กรุณากรอกข้อมูลให้ครบถ้วน</p>";
            }
        ?>
        
        <a href="form_handling_post.php" class="btn-back">กลับหน้าลงทะเบียน</a>
    </div>

</body>
</html>