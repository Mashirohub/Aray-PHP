<?php
// Logic เดิม + God ที่ 1 ล้าน (ส่วนลด 50%)
$amountRaw = isset($_POST['amount']) ? $_POST['amount'] : '';
$amount = is_numeric($amountRaw) ? floatval($amountRaw) : 0;
$isMember = isset($_POST['member']);
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!is_numeric($amountRaw) || $amount < 0) {
        $error = 'ยอดซื้อไม่สามารถเป็นค่าที่ไม่ถูกต้องหรือติดลบได้';
    }
}

$discountRate = 0;
$level = 'ไม่ได้รับส่วนลด';
$nextTarget = null;
$nextRate = null;
$levelColor = '#6b7280';
$isGod = false;

if ($amount >= 1000000) {
    $discountRate = 50;
    $level = 'GOD';
    $levelColor = '#c084fc';
    $isGod = true;
} elseif ($amount >= 10000) {
    $discountRate = 30;
    $level = 'God';
    $levelColor = '#a78bfa';
    $nextTarget = 1000000;
    $nextRate = 50;
} elseif ($amount >= 5000) {
    $discountRate = 20;
    $level = 'Platinum';
    $levelColor = '#a5b4fc';
    $nextTarget = 10000;
    $nextRate = 30;
} elseif ($amount >= 3000) {
    $discountRate = 15;
    $level = 'Gold';
    $levelColor = '#fbbf24';
    $nextTarget = 5000;
    $nextRate = 20;
} elseif ($amount >= 1000) {
    $discountRate = 10;
    $level = 'Silver';
    $levelColor = '#cbd5e1';
    $nextTarget = 3000;
    $nextRate = 15;
} elseif ($amount >= 500) {
    $discountRate = 5;
    $level = 'Bronze';
    $levelColor = '#cd7f32';
    $nextTarget = 1000;
    $nextRate = 10;
} else {
    $nextTarget = 500;
    $nextRate = 5;
}

$memberRate = ($isMember && $amount >= 500) ? 5 : 0;
$totalDiscountRate = $discountRate + $memberRate;
$discountMoney = $amount * ($totalDiscountRate / 100);
$netPrice = $amount - $discountMoney;

$progressPercent = $nextTarget ? min(100, ($amount / $nextTarget) * 100) : 100;
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>GOD MODE - ไฟลุก สายฟ้าฟาด!</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@700;900&family=Noto+Sans+Thai:wght@700;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>

    <style>
        :root {
            --purple-neon: #c084fc;
            --gold-neon: #fbbf24;
            --fire-orange: #ff6b00;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #0a0015;
            color: white;
            font-family: 'Inter', 'Noto Sans Thai', sans-serif;
            overflow-x: hidden;
        }

        <?php if ($isGod): ?>
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: radial-gradient(circle at 50% 30%, rgba(192,132,252,0.25), transparent 60%);
            pointer-events: none;
            animation: cosmicFlicker 8s infinite alternate;
        }
        @keyframes cosmicFlicker {
            0%,100% { opacity: 0.6; }
            50% { opacity: 0.9; }
        }
        <?php endif; ?>

        .container { max-width: 950px; margin: 1.5rem auto; padding: 1rem; }

        .card {
            background: rgba(10, 0, 20, 0.9);
            backdrop-filter: blur(15px);
            border: 3px solid var(--purple-neon);
            border-radius: 1.8rem;
            box-shadow: 0 0 80px rgba(192,132,252,0.7), inset 0 0 40px rgba(192,132,252,0.4);
            padding: 3.5rem 2.5rem;
            position: relative;
            overflow: hidden;
        }

        /* Lightning bolts around card */
        .lightning {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
        }

        .bolt {
            position: absolute;
            width: 4px;
            height: 120px;
            background: linear-gradient(to bottom, transparent, var(--purple-neon), transparent);
            opacity: 0;
            animation: lightningFlash 4s infinite;
            filter: blur(2px);
        }

        .bolt:nth-child(1) { top: 10%; left: 15%; animation-delay: 0.5s; transform: rotate(25deg); }
        .bolt:nth-child(2) { top: 40%; right: 10%; animation-delay: 1.2s; transform: rotate(-35deg); }
        .bolt:nth-child(3) { bottom: 15%; left: 30%; animation-delay: 2.8s; transform: rotate(15deg); }

        @keyframes lightningFlash {
            0%, 10%, 20%, 100% { opacity: 0; }
            5%, 15% { opacity: 0.9; height: 180px; }
        }

        /* Fire sparks */
        .sparks {
            position: absolute;
            inset: 0;
            pointer-events: none;
        }

        .spark {
            position: absolute;
            width: 6px;
            height: 6px;
            background: var(--fire-orange);
            border-radius: 50%;
            box-shadow: 0 0 12px var(--fire-orange);
            animation: sparkFly 6s infinite;
            opacity: 0;
        }

        @keyframes sparkFly {
            0% { transform: translate(0,0) scale(1); opacity: 0; }
            20% { opacity: 0.9; }
            100% { transform: translate(var(--x), var(--y)) scale(0); opacity: 0; }
        }

        /* Aura + pulse */
        .god-aura {
            position: absolute;
            inset: -30%;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(192,132,252,0.45), transparent 70%);
            animation: auraPulse 5s infinite alternate;
        }

        @keyframes auraPulse {
            0% { transform: scale(1) rotate(0deg); opacity: 0.5; }
            100% { transform: scale(1.4) rotate(360deg); opacity: 0.9; }
        }

        .god-title {
            font-size: 5rem;
            font-weight: 900;
            background: linear-gradient(90deg, var(--gold-neon), var(--purple-neon), var(--gold-neon));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 40px var(--purple-neon);
            animation: fireGlow 2s infinite alternate;
            text-align: center;
        }

        @keyframes fireGlow {
            0% { text-shadow: 0 0 20px var(--purple-neon), 0 0 40px var(--fire-orange); }
            100% { text-shadow: 0 0 60px var(--purple-neon), 0 0 100px var(--fire-orange); }
        }

        .result-big {
            font-size: 4.2rem;
            color: var(--gold-neon);
            text-shadow: 0 0 35px var(--purple-neon);
            text-align: center;
            margin: 2rem 0;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <?php if ($isGod): ?>
            <div class="god-aura"></div>
            <div class="lightning">
                <div class="bolt"></div>
                <div class="bolt"></div>
                <div class="bolt"></div>
            </div>
            <div class="sparks">
                <!-- สร้าง spark แบบ random ด้วย JS ข้างล่าง -->
            </div>
        <?php endif; ?>

        <?php if ($isGod): ?>
            <div class="god-title">GOD MODE</div>
            <div style="text-align:center;font-size:2.2rem;color:#ff6b00;text-shadow:0 0 20px #c084fc;margin:1rem 0;">
                ไฟลุก ⚡ สายฟ้าฟาด!
            </div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div style="background:rgba(255,0,0,0.4);padding:1.5rem;border-radius:1rem;margin-bottom:2rem;text-align:center;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <input type="number" name="amount" step="0.01" placeholder="กรอกยอดซื้อ (บาท)" 
                   value="<?= htmlspecialchars($amountRaw) ?>" required 
                   style="width:100%;padding:1.6rem;font-size:2.2rem;text-align:center;background:rgba(255,255,255,0.05);border:3px solid var(--purple-neon);border-radius:1.2rem;color:white;">
            
            <div style="margin:2.5rem 0;text-align:center;">
                <input type="checkbox" name="member" id="member" <?= $isMember ? 'checked' : '' ?> style="transform:scale(2);">
                <label for="member" style="font-size:1.7rem;margin-left:1.2rem;color:#ddd;">เป็นสมาชิก (+5%)</label>
            </div>

            <div style="text-align:center;">
                <button type="submit" style="background:linear-gradient(45deg,#c084fc,#ff6b00,#fbbf24);color:black;font-size:1.8rem;font-weight:900;padding:1.4rem 4rem;border:none;border-radius:999px;cursor:pointer;box-shadow:0 0 40px rgba(192,132,252,0.8);">
                    ปลุกเทพ!
                </button>
            </div>
        </form>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$error): ?>
        <div style="margin-top:5rem;position:relative;">
            <div style="position:relative;width:260px;height:260px;margin:0 auto;">
                <svg width="260" height="260" style="position:absolute;">
                    <defs>
                        <linearGradient id="godFire" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#fbbf24"/>
                            <stop offset="50%" stop-color="#c084fc"/>
                            <stop offset="100%" stop-color="#ff6b00"/>
                        </linearGradient>
                    </defs>
                    <circle cx="130" cy="130" r="110" fill="none" stroke="#2d004d" stroke-width="24"/>
                    <circle cx="130" cy="130" r="110" fill="none" stroke="url(#godFire)" stroke-width="24"
                            stroke-dasharray="690" stroke-dashoffset="<?= 690 - (690 * $totalDiscountRate / 100) ?>"
                            style="filter: drop-shadow(0 0 20px #c084fc);"/>
                </svg>
                <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);font-size:6rem;font-weight:900;color:#fbbf24;text-shadow:0 0 40px #ff6b00,0 0 60px #c084fc;">
                    <?= $totalDiscountRate ?>%
                </div>
            </div>

            <div class="result-big">
                <?= number_format($netPrice, 2) ?> บาท
            </div>

            <div style="font-size:3rem;text-align:center;color:var(--gold-neon);margin:2rem 0;text-shadow:0 0 30px var(--purple-neon);">
                <?= $level ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
// สร้างประกายไฟแบบ random เมื่อเป็น GOD
<?php if ($isGod): ?>
function createSpark() {
    const spark = document.createElement('div');
    spark.className = 'spark';
    spark.style.left = Math.random() * 100 + '%';
    spark.style.top = Math.random() * 100 + '%';
    spark.style.setProperty('--x', (Math.random() - 0.5) * 300 + 'px');
    spark.style.setProperty('--y', (Math.random() - 0.5) * 300 + 'px');
    spark.style.animationDelay = Math.random() * 3 + 's';
    document.querySelector('.sparks').appendChild(spark);
    
    setTimeout(() => spark.remove(), 7000);
}

setInterval(createSpark, 400);

// Confetti ไฟ + สายฟ้า
function godStorm() {
    confetti({
        particleCount: 180,
        spread: 140,
        startVelocity: 70,
        ticks: 400,
        origin: { y: 0.4 },
        colors: ['#c084fc', '#fbbf24', '#ff6b00', '#ffffff', '#7c3aed']
    });
}
godStorm();
setTimeout(godStorm, 700);
setTimeout(godStorm, 1400);
<?php endif; ?>
</script>

</body>
</html>