<?php
/**
 * COMPLETE GOOGLE DISCOVER GENERATOR V7.0 - GEMINI 2.5 & 3 SUPPORT
 */

// --- 1. CONFIGURATION ---
$MY_API_KEY = "AIzaSyAg3B3dYuN6BaZLescfTUXH5f4JTBBnfyo"; 
$PASSWORD_AKSES = "admin123"; 
$MY_DOMAIN = "https://rivo88.github.io/"; 

session_start();

if (isset($_GET['logout'])) { session_destroy(); header("Location: generator.php"); exit(); }
if (isset($_POST['login'])) {
    if ($_POST['password'] === $PASSWORD_AKSES) { $_SESSION['logged_in'] = true; header("Location: generator.php"); exit(); }
}
$isLoggedIn = isset($_SESSION['logged_in']);

// --- 3. AJAX ENDPOINT ---
if (isset($_GET['action']) && $_GET['action'] == 'generate_single' && $isLoggedIn) {
    header('Content-Type: application/json');
    // Looping Gambar ImageKit
    $list_gambar = [
        "https://ik.imagekit.io/bumisquad/keempat.jpg",
        "https://ik.imagekit.io/bumisquad/ketiga.jpg",
        "https://ik.imagekit.io/bumisquad/kedua.jpg",
        "https://ik.imagekit.io/bumisquad/qHfzSXp.jpg",
        "https://petir-image.live/uploads/dcgetar/ini/nonverba83.webp",
        "https://petir-image.live/uploads/dcgetar/dc-webp/10.webp",
        "https://petir-image.live/uploads/dcgetar/tm/hajih4.png",
        "https://petir-image.live/uploads/dcgetar/ini/nonverba106.webp",
        "https://petir-image.live/uploads/dcgetar/ini/nonverba72.webp",
        "https://petir-image.live/uploads/dcgetar/ini/nonverba106.webp",
        "https://petir-image.live/uploads/dcgetar/ini/nonverba110.webp",
        "https://petir-image.live/uploads/dcgetar/dc-webp/15.webp",
        "https://image-resource77.cloud/uploads/sero4kxsh/kencang/s5.jpg",
        "https://petir-image.live/uploads/aset/discover/9.jpg",
        "https://petir-image.live/uploads/dcgetar/dc-webp/9.webp",
        "https://petir-image.live/uploads/dcgetar/tm/hajih3.png",
        "https://petir-image.live/uploads/dcgetar/dc-webp/8.webp",
        "https://image-resource77.cloud/uploads/sero4kxsh/kencang/bebaspakai-2.png",
        "https://image-resource77.cloud/uploads/sero4kxsh/kencang/s14.jpg",
        "https://image-resource77.cloud/uploads/sero4kxsh/kencang/s10.jpg",
        "https://image-resource77.cloud/uploads/sero4kxsh/kencang/s9.jpg",
        "https://image-resource77.cloud/uploads/sero4kxsh/kencang/bebaspakai-1.png",
        "https://petir-image.live/uploads/aset/discover/5.jpg",
        "https://petir-image.live/uploads/dcgetar/ini/163.jpg",
        "https://image-resource77.cloud/uploads/sero4kxsh/kencang/s6.jpg",
        "https://petir-image.live/uploads/dcgetar/dc-jpg/141.jpg",
        "https://image-resource77.cloud/uploads/sero4kxsh/kencang/bebaspakai-6.png",
        "https://image-resource77.cloud/uploads/sero4kxsh/kencang/s13.jpg",
        "https://petir-image.live/uploads/dcgetar/ini/22.jpg",
        "https://image-resource77.cloud/uploads/sero4kxsh/kencang/s7.jpg",
        "https://image-resource77.cloud/uploads/sero4kxsh/kencang/bebaspakai-8.png",
        "https://petir-image.live/uploads/dcgetar/tm/hajih9.png",
        "https://petir-image.live/uploads/dcgetar/ini/681.webp",
        "https://image-resource77.cloud/uploads/sero4kxsh/kencang/bebaspakai-3.png",
    ];
    $img_idx = isset($_GET['img_idx']) ? (int)$_GET['img_idx'] : 0;
    $selected_image = $list_gambar[$img_idx % count($list_gambar)];

    // Database Acak
    $names = ["Andi", "Budi", "Dani", "Eko", "Rangga", "Sari", "Putri", "Dewi", "Mawar", "Melati"];
    $profs = ["Driver Ojol", "Tukang Bakso", "Montir", "Teknisi", "Guru", "Barista"];
    $cities = ["Jakarta", "Bekasi", "Tangerang", "Depok", "Bandung", "Surabaya", "Medan"];
    $games = ["Mahjong Ways 2", "Gates of Olympus", "Starlight Princess", "Lucky Neko"];
    $platforms = ["WINSLOT118", "NAGABET76", "SLOT88", "RAJAGACOR"];

    $data = [
        'name' => $names[array_rand($names)],
        'prof' => $profs[array_rand($profs)],
        'city' => $cities[array_rand($cities)],
        'game' => $games[array_rand($games)],
        'plat' => $platforms[array_rand($platforms)],
        'win' => rand(50, 500) . "000000"
    ];

    // BERDASARKAN HASIL TES MODEL ANDA:
    // Kita gunakan Gemini 2.5 Flash (Stabil) dan Gemini 3 Flash (Preview)
    $models = ["gemini-2.5-flash", "gemini-3-flash-preview", "gemini-2.0-flash-001"];
    
    $ai_response_text = "";
    $error_detail = "";

    foreach ($models as $model_name) {
        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model_name}:generateContent?key=" . trim($MY_API_KEY);
        
        $prompt = "Buat artikel berita viral Bahasa Indonesia untuk Google Discover. Format JSON: {\"title\": \"...\", \"meta_description\": \"...\", \"content\": \"...\"}. Subjek: {$data['name']} ({$data['prof']}) di {$data['city']} menang hadiah Rp " . number_format($data['win'],0,',','.') . " saat main {$data['game']}. Tulis dengan gaya jurnalistik menarik, gunakan subheadings ##.";

        $payload = [
            "contents" => [["parts" => [["text" => $prompt]]]],
            "safetySettings" => [
                ["category" => "HARM_CATEGORY_HATE_SPEECH", "threshold" => "BLOCK_NONE"],
                ["category" => "HARM_CATEGORY_SEXUALLY_EXPLICIT", "threshold" => "BLOCK_NONE"],
                ["category" => "HARM_CATEGORY_HARASSMENT", "threshold" => "BLOCK_NONE"],
                ["category" => "HARM_CATEGORY_DANGEROUS_CONTENT", "threshold" => "BLOCK_NONE"]
            ],
            "generationConfig" => [
                "temperature" => 0.8,
                "response_mime_type" => "application/json"
            ]
        ];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        
        $resp = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code === 200) {
            $res_arr = json_decode($resp, true);
            $ai_response_text = $res_arr['candidates'][0]['content']['parts'][0]['text'] ?? '';
            if ($ai_response_text) break;
        } else {
            $err_json = json_decode($resp, true);
            $error_detail = $err_json['error']['message'] ?? "Error $http_code";
        }
    }

    if (!$ai_response_text) {
        echo json_encode(["error" => "AI Error: " . $error_detail]);
        exit;
    }

    $res = json_decode($ai_response_text, true);
    if (!$res) {
        preg_match('/\{.*\}/s', $ai_response_text, $matches);
        $res = json_decode($matches[0] ?? '', true);
    }

    if (!$res) {
        echo json_encode(["error" => "Format JSON AI tidak valid."]);
        exit;
    }

    // Markdown to HTML
    $content_html = preg_replace('/^## (.+)$/m', '<h2>$1</h2>', $res['content']);
    $content_html = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $content_html);
    $content_html = "<p>" . str_replace("\n\n", "</p><p>", $content_html) . "</p>";

    $title = trim(str_replace(['#', '*', '**'], '', $res['title']));
    $slug = trim(preg_replace('/[^a-z0-9\-]/', '-', strtolower($title)), '-');
    $canonical = rtrim($MY_DOMAIN, '/') . "/kompasnews/" . $slug . ".html";

    if (!file_exists("template.html")) {
        echo json_encode(["error" => "template.html tidak ditemukan!"]);
        exit;
    }

    $template = file_get_contents("template.html");
    $finalHtml = str_replace(
        ["{{TITLE}}", "{{META_DESCRIPTION}}", "{{CONTENT}}", "{{DATE}}", "{{PLATFORM}}", "{{GAME}}", "{{GAMBAR}}", "{{CANONICAL}}", "{{URL}}"],
        [$title, substr($res['meta_description'], 0, 155), $content_html, date("d F Y"), $data['plat'], $data['game'], $selected_image, $canonical, $canonical],
        $template
    );

    if (!is_dir('output')) mkdir('output', 0777, true);
    file_put_contents("output/{$slug}.html", $finalHtml);

    echo json_encode([
        "success" => true,
        "title" => $title,
        "url" => "output/{$slug}.html",
        "canonical" => $canonical
    ]);
    exit;
}
?>
<!-- Script HTML ke bawah tetap sama seperti sebelumnya -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discover AI V6.0 - Stable</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .main-card { max-width: 600px; margin: 50px auto; border-radius: 15px; }
        .log-area { max-height: 300px; overflow-y: auto; background: white; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        .log-item { font-size: 13px; border-bottom: 1px solid #eee; padding: 5px 0; }
    </style>
</head>
<body>
<div class="container">
    <?php if (!$isLoggedIn): ?>
        <div class="card main-card shadow p-4 mt-5">
            <h4 class="text-center mb-3">Login Generator</h4>
            <form method="POST">
                <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
                <button class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    <?php else: ?>
        <div class="card main-card shadow p-4">
            <div class="d-flex justify-content-between mb-3">
                <h4 class="text-primary">✨ Discover AI V6.0</h4>
                <a href="?logout=1" class="btn btn-sm btn-outline-danger">Logout</a>
            </div>
            
            <div class="mb-3">
                <label class="fw-bold">Jumlah Artikel:</label>
                <select id="articleCount" class="form-select mb-3">
                    <option value="1">1 Artikel</option>
                    <option value="4">4 Artikel (1 Loop Gambar)</option>
                    <option value="8">8 Artikel (2 Loop Gambar)</option>
                    <option value="20">20 Artikel</option>
                </select>
                <button id="startBtn" onclick="startGeneration()" class="btn btn-success w-100 fw-bold">GENERATE SEKARANG</button>
            </div>

            <div id="progressArea" style="display:none;">
                <hr>
                <h6>Status: <span id="statusInfo" class="text-warning">Menunggu...</span></h6>
                <div class="progress mb-3" style="height: 15px;">
                    <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-success" style="width: 0%"></div>
                </div>
                <div id="logArea" class="log-area shadow-sm"></div>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
async function startGeneration() {
    const count = document.getElementById('articleCount').value;
    const btn = document.getElementById('startBtn');
    const status = document.getElementById('statusInfo');
    const logArea = document.getElementById('logArea');
    const bar = document.getElementById('progressBar');

    btn.disabled = true;
    document.getElementById('progressArea').style.display = 'block';
    logArea.innerHTML = "";
    
    for (let i = 0; i < count; i++) {
        const percent = ((i + 1) / count) * 100;
        status.innerText = `Memproses ${i + 1} dari ${count}...`;
        addLog(`⏳ Menyiapkan artikel ${i + 1}...`);

        try {
            const response = await fetch(`?action=generate_single&img_idx=${i}`);
            const result = await response.json();

            if (result.success) {
                addLog(`✅ <b>SUKSES:</b> <a href="${result.url}" target="_blank">${result.title}</a> <br> <small class="text-muted">🔗 Canonical: ${result.canonical}</small>`);
            } else {
                addLog(`❌ <b>GAGAL:</b> ${result.error}`, 'text-danger');
            }
        } catch (e) {
            addLog(`❌ <b>ERROR:</b> Koneksi gagal.`, 'text-danger');
        }

        bar.style.width = percent + '%';
        if (i < count - 1) await new Promise(r => setTimeout(r, 4000));
    }

    status.innerText = "Selesai!";
    btn.disabled = false;
}

function addLog(msg, colorClass = "") {
    const logArea = document.getElementById('logArea');
    const div = document.createElement('div');
    div.className = "log-item " + colorClass;
    div.innerHTML = msg;
    logArea.prepend(div);
}
</script>
</body>
</html>
