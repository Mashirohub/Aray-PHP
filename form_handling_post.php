<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
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

        label {
            font-weight: 500;
            color: #555;
        }
    </style>
</head>
<body>
    
    <div class="form">
        <h2>ลงทะเบียน</h2>
        <!-- แก้ไข: เปลี่ยน action เป็น welcome.php เพื่อส่งค่าไปอีกหน้า -->
        <form method="post" action="welcome.php">
            <label for="fname">ชื่อ (First Name)</label>
            <input type="text" name="fname" id="fname" placeholder="กรอกชื่อของคุณ..">

            <label for="lname">นามสกุล (Last Name)</label>
            <input type="text" name="lname" id="lname" placeholder="กรอกนามสกุลของคุณ..">

            <input type="submit" value="ยืนยันข้อมูล">
        </form>
    </div>

</body>
</html>