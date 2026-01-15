<?php
function splitThaiName($fullName)
{
    $prefixes = [
        "นาย", "นาง", "นางสาว", "เด็กชาย", "เด็กหญิง",
        "น.ส.", "ด.ช.", "ด.ญ.", "ร.ต.ต.", "ด.ต.", "มรว.",
        "ผศ.", "ดร.", "ว่าที่ ร.ต.", "ว่าที่ร้อยตรี", "พระครู"
    ];
    
    $result = ["prefix" => "", "firstname" => "", "lastname" => ""];
    $fullName = trim(preg_replace('/\s+/', ' ', $fullName));
    
    usort($prefixes, function($a, $b) { return mb_strlen($b, 'UTF-8') - mb_strlen($a, 'UTF-8'); });

    foreach ($prefixes as $p) {
        $len = mb_strlen($p, 'UTF-8');
        if (mb_substr($fullName, 0, $len, 'UTF-8') === $p) {
            $result['prefix'] = $p;
            $fullName = ltrim(mb_substr($fullName, $len));
            break;
        }
    }

    $parts = explode(' ', trim($fullName));
    if (count($parts) === 1) {
        $result['firstname'] = $parts[0];
    } else {
        $result['firstname'] = array_shift($parts);
        $result['lastname'] = implode(' ', $parts);
    }

    return $result;
}

$data = ["prefix" => "", "firstname" => "", "lastname" => ""];
$inputValue = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['fullname'])) {
    $inputValue = trim($_POST['fullname']);
    $data = splitThaiName($inputValue);
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>แยกชื่อ-สกุลไทย</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Noto+Sans+Thai:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg: #f8fafc;
            --card: #ffffff;
            --text: #1e293b;
            --muted: #64748b;
            --border: #e2e8f0;
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --input-bg: #ffffff;
            --result-bg: #f8fafc;
            --success: #10b981;
        }

        [data-theme="dark"] {
            --bg: #0f172a;
            --card: #1e293b;
            --text: #f1f5f9;
            --muted: #94a3b8;
            --border: #334155;
            --primary: #818cf8;
            --primary-dark: #6366f1;
            --input-bg: #1e293b;
            --result-bg: #1e293b;
            --success: #34d399;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Noto Sans Thai', system-ui, sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            padding: 2rem 1rem;
            transition: background 0.4s ease, color 0.4s ease;
        }

        .container {
            width: 100%;
            max-width: 780px;
            margin: 0 auto;
        }

        .card {
            background: var(--card);
            border-radius: 1.5rem;
            box-shadow: 0 20px 40px rgba(0,0,0,0.18);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 2.5rem 2.5rem 2rem;
            text-align: center;
            position: relative;
        }

        .theme-toggle {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            background: rgba(255,255,255,0.25);
            border: none;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .theme-toggle:hover {
            background: rgba(255,255,255,0.4);
            transform: scale(1.1);
        }

        .content {
            padding: 2.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.6rem;
            color: var(--muted);
            font-weight: 500;
            font-size: 0.95rem;
        }

        .input-group {
            display: flex;
            gap: 0.8rem;
        }

        input[type="text"] {
            flex: 1;
            padding: 1rem 1.25rem;
            border: 2px solid var(--border);
            border-radius: 0.875rem;
            font-size: 1.1rem;
            background: var(--input-bg);
            color: var(--text);
            transition: all 0.25s;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99,102,241,0.18);
        }

        button {
            padding: 0 2rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 0.875rem;
            font-size: 1.05rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        button:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(99,102,241,0.3);
        }

        .result-section {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px dashed var(--border);
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .result-item {
            margin-bottom: 1.5rem;
        }

        .result-value {
            background: var(--result-bg);
            padding: 1rem 1.25rem;
            border-radius: 0.875rem;
            border: 1px solid var(--border);
            font-size: 1.15rem;
            min-height: 50px;
            display: flex;
            align-items: center;
            transition: all 0.3s;
        }

        .has-value {
            background: rgba(16,185,129,0.12);
            border-color: rgba(16,185,129,0.3);
            color: var(--success);
        }

        .empty {
            color: var(--muted);
            font-style: italic;
        }

        @media (max-width: 640px) {
            .input-group { flex-direction: column; }
            button { width: 100%; padding: 1rem; }
        }
    </style>
</head>
<body data-theme="light">

<div class="container">
    <div class="card">
        <div class="header">
            <h1>แยกชื่อ-สกุลไทย</h1>
            <p>กรอกชื่อเต็ม แล้วแยกได้ในพริบตา!</p>
            <button class="theme-toggle" id="themeToggle" aria-label="สลับธีม">🌙</button>
        </div>

        <div class="content">
            <form method="post" class="form-group">
                <label>ชื่อ-สกุลเต็ม (รวมคำนำหน้า)</label>
                <div class="input-group">
                    <input type="text" name="fullname" 
                           placeholder="เช่น นายสมชาย ใจดี, ดร.วิชัย สุขใจ, น.ส.พรทิพย์"
                           value="<?= htmlspecialchars($inputValue ?? '', ENT_QUOTES, 'UTF-8') ?>"
                           required autofocus>
                    <button type="submit">แยกชื่อ</button>
                </div>
            </form>

            <div class="result-section">
                <div class="result-item">
                    <label>คำนำหน้า</label>
                    <div class="result-value <?= !empty($data['prefix']) ? 'has-value' : 'empty' ?>">
                        <?= !empty($data['prefix']) ? htmlspecialchars($data['prefix']) : '– ไม่มีคำนำหน้า –' ?>
                    </div>
                </div>

                <div class="result-item">
                    <label>ชื่อ</label>
                    <div class="result-value <?= !empty($data['firstname']) ? 'has-value' : 'empty' ?>">
                        <?= !empty($data['firstname']) ? htmlspecialchars($data['firstname']) : '– ยังไม่ได้กรอก –' ?>
                    </div>
                </div>

                <div class="result-item">
                    <label>นามสกุล</label>
                    <div class="result-value <?= !empty($data['lastname']) ? 'has-value' : 'empty' ?>">
                        <?= !empty($data['lastname']) ? htmlspecialchars($data['lastname']) : '– ไม่มีนามสกุล –' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const toggleBtn = document.getElementById('themeToggle');
    const html = document.documentElement;

    // โหลดธีมที่เคยเลือกไว้
    const savedTheme = localStorage.getItem('theme') || 
                      (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    
    html.setAttribute('data-theme', savedTheme);
    toggleBtn.textContent = savedTheme === 'dark' ? '☀️' : '🌙';

    toggleBtn.addEventListener('click', () => {
        const current = html.getAttribute('data-theme');
        const next = current === 'dark' ? 'light' : 'dark';
        
        html.setAttribute('data-theme', next);
        toggleBtn.textContent = next === 'dark' ? '☀️' : '🌙';
        
        localStorage.setItem('theme', next);
    });
</script>

</body>
</html>