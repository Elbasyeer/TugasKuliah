<?php
$baseDir = __DIR__;
$items = @scandir($baseDir) ?: [];
$folders = [];
foreach ($items as $item) {
    if ($item === '.' || $item === '..') continue;
    if ($item[0] === '.') continue;
    $full = $baseDir . DIRECTORY_SEPARATOR . $item;
    if (is_dir($full)) {
        $folders[] = $item;
    }
}
sort($folders, SORT_NATURAL | SORT_FLAG_CASE);

$totalFolders = count($folders);
$currentDate = date('d M Y, H:i');
$phpVersion = PHP_VERSION;
$serverName = $_SERVER['SERVER_NAME'] ?? 'localhost';
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Projek Doing • Muhammad Aziz Al Mubasyir</title>
  <link rel="icon" type="image/png" href="https://img.icons8.com/parakeet/48/bear.png" />
  <link rel="apple-touch-icon" href="https://img.icons8.com/parakeet/48/bear.png" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
  <style>
    :root{
      --bg:#0a0a0a;
      --surface:#111111;
      --surface-soft:#181818;
      --panel:#141414;
      --text:#ffffff;
      --muted:#aaaaaa;
      --line:rgba(255,255,255,0.08);
      --accent:#ffc107;
      --accent-strong:#d9a700;
      --shadow:0 24px 80px rgba(0,0,0,0.45);
      --shadow-hover:0 14px 32px rgba(255,193,7,0.14);
      --radius:10px;
    }

    *{box-sizing:border-box}
    html,body{margin:0;min-height:100%;}
    body{
      font-family:Roboto,system-ui,-apple-system,Segoe UI,Helvetica,Arial,sans-serif;
      color:var(--text);
      background:linear-gradient(180deg, #0a0a0a 0%, #070707 100%);
      min-height:100vh;
      position:relative;
      overflow-x:hidden;
    }

    body::before{
      content:"";
      position:fixed;
      inset:0;
      background-image:radial-gradient(rgba(255,255,255,0.04) 1px, transparent 1px);
      background-size:20px 20px;
      opacity:.12;
      pointer-events:none;
      z-index:0;
    }

    .wrap{
      position:relative;
      z-index:1;
      max-width:1200px;
      margin:0 auto;
      padding:40px 20px 58px;
      animation:fadeIn .6s ease-out;
    }

    .hero{
      background:rgba(17,17,17,0.96);
      border:1px solid var(--line);
      border-radius:12px;
      box-shadow:var(--shadow);
      padding:36px 32px;
      margin-bottom:24px;
    }

    .eyebrow{
      letter-spacing:.26em;
      font-size:12px;
      text-transform:uppercase;
      color:var(--muted);
      font-weight:700;
      margin-bottom:12px;
    }

    h1{
      margin:0;
      font-size:clamp(36px,5vw,56px);
      line-height:1.05;
      font-weight:800;
      text-transform:uppercase;
      letter-spacing:.04em;
      color:var(--text);
    }

    .sub{
      margin:12px 0 10px;
      font-size:13px;
      text-transform:uppercase;
      letter-spacing:.18em;
      color:var(--muted);
      font-weight:600;
    }

    .desc{
      margin:0;
      color:var(--muted);
      line-height:1.8;
      max-width:760px;
    }

    .panel-grid{
      display:grid;
      grid-template-columns:1.35fr .85fr;
      gap:18px;
      margin-bottom:18px;
    }

    .card{
      background:var(--surface);
      border:1px solid var(--line);
      border-radius:var(--radius);
      box-shadow:0 20px 60px rgba(0,0,0,0.28);
    }

    .sys{
      padding:22px;
    }

    .sys h3{
      margin:0 0 14px;
      font-size:13px;
      color:var(--text);
      text-transform:uppercase;
      letter-spacing:.18em;
      font-weight:700;
    }

    .sys-list{display:grid;gap:12px}
    .sys-item{
      display:flex;
      justify-content:space-between;
      align-items:center;
      font-size:14px;
      color:var(--text);
      background:rgba(255,255,255,0.03);
      border:1px solid rgba(255,255,255,0.08);
      border-radius:10px;
      padding:14px 16px;
    }

    .sys-item span{
      color:var(--muted);
      text-transform:uppercase;
      letter-spacing:.12em;
      font-weight:600;
    }

    .sys-item strong{
      color:var(--text);
      font-weight:700;
    }

    .folders{
      padding:22px;
    }

    .folders-head{
      display:flex;
      justify-content:space-between;
      align-items:center;
      margin-bottom:14px;
      gap:12px;
    }

    .folders-head h2{
      margin:0;
      font-size:15px;
      letter-spacing:.18em;
      text-transform:uppercase;
      color:var(--text);
      font-weight:700;
    }

    .count-pill{
      font-size:11px;
      color:var(--text);
      background:rgba(255,193,7,0.12);
      border:1px solid rgba(255,193,7,0.22);
      border-radius:999px;
      padding:7px 14px;
      font-weight:700;
    }

    .grid{
      display:grid;
      grid-template-columns:repeat(3,minmax(0,1fr));
      gap:14px;
    }

    .folder{
      text-decoration:none;
      color:inherit;
      background:rgba(255,255,255,0.03);
      border:1px solid rgba(255,255,255,0.08);
      border-radius:12px;
      padding:20px;
      transition:transform .25s ease, border-color .25s ease, box-shadow .25s ease, background .25s ease;
      position:relative;
      overflow:hidden;
      animation:rise .45s ease both;
    }

    .folder::after{
      content:"";
      position:absolute;
      width:100px;
      height:100px;
      right:-30px;
      top:-30px;
      background:radial-gradient(circle, rgba(255,193,7,0.18), transparent 60%);
      pointer-events:none;
    }

    .folder:hover{
      transform:translateY(-4px);
      border-color:rgba(255,193,7,0.4);
      box-shadow:0 24px 55px rgba(0,0,0,0.35);
      background:rgba(255,255,255,0.05);
    }

    .icon{
      width:44px;height:44px;
      border-radius:10px;
      display:grid;place-items:center;
      background:rgba(255,193,7,0.12);
      color:var(--accent);
      margin-bottom:12px;
      font-size:20px;
    }

    .fname{
      font-weight:700;
      font-size:15px;
      margin-bottom:6px;
      word-break:break-word;
    }

    .meta{
      color:var(--muted);
      font-size:12px;
      display:flex;
      align-items:center;
      gap:6px;
    }

    .empty{
      text-align:center;
      color:var(--muted);
      font-size:14px;
      padding:26px;
      border:1px dashed rgba(255,255,255,0.12);
      border-radius:12px;
      background:rgba(255,255,255,0.03);
    }

    @media (max-width:980px){
      .panel-grid{grid-template-columns:1fr}
      .grid{grid-template-columns:repeat(2,minmax(0,1fr))}
    }
    @media (max-width:640px){
      .hero{padding:28px 20px}
      .grid{grid-template-columns:1fr}
    }

    @keyframes fadeIn{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}
    @keyframes rise{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:translateY(0)}}
  </style>
</head>
<body>
  <main class="wrap">
    <section class="hero">
      <div class="eyebrow">Based On My Projects</div>
      <h1>Kumpulan Project Praktikum</h1>
      <div class="sub">Muhammad Aziz Al Mubasyir (243200310) [24]</div>
      <p class="desc">
        Selamat datang di portal project praktikum. Halaman ini menampilkan seluruh folder project secara otomatis.
      </p>
    </section>

    <section class="panel-grid">
      <div class="card folders">
        <div class="folders-head">
          <h2>Project Explorer</h2>
          <span class="count-pill"><?= $totalFolders ?> Folder</span>
        </div>

        <?php if ($totalFolders > 0): ?>
          <div class="grid">
            <?php foreach ($folders as $i => $folder): ?>
              <a class="folder" href="<?= htmlspecialchars($folder, ENT_QUOTES, 'UTF-8') ?>/" target="_blank">
                <div class="icon"><i class="ri-folder-3-line"></i></div>
                <div class="fname"><?= htmlspecialchars($folder, ENT_QUOTES, 'UTF-8') ?></div>
                <div class="meta"><i class="ri-terminal-box-line"></i>Project Folder</div>
              </a>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <div class="empty">Belum ada folder praktikum yang terdeteksi.</div>
        <?php endif; ?>
      </div>

      <aside class="card sys">
        <h3>System Info</h3>
        <div class="sys-list">
          <div class="sys-item"><span>Current Date</span><strong><?= htmlspecialchars($currentDate, ENT_QUOTES, 'UTF-8') ?></strong></div>
          <div class="sys-item"><span>PHP Version</span><strong><?= htmlspecialchars($phpVersion, ENT_QUOTES, 'UTF-8') ?></strong></div>
          <div class="sys-item"><span>Server Name</span><strong><?= htmlspecialchars($serverName, ENT_QUOTES, 'UTF-8') ?></strong></div>
          <div class="sys-item"><span>Total Folder</span><strong><?= $totalFolders ?></strong></div>
        </div>
      </aside>
    </section>
  </main>
</body>
</html>
