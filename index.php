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
      --bg:#edf3f4;
      --bg-2:#e6eff1;
      --panel:#f8fbfc;
      --text:#1f2a37;
      --muted:#6b7c8f;
      --line:#d9e4e8;
      --acc:#87b8d8;
      --acc-2:#b6cfe2;
      --shadow:0 10px 28px rgba(73, 102, 128, .08);
      --shadow-hover:0 18px 34px rgba(73, 102, 128, .15);
      --radius:18px;
    }

    *{box-sizing:border-box}
    html,body{margin:0}
    body{
      font-family:'Plus Jakarta Sans',system-ui,-apple-system,Segoe UI,Roboto,sans-serif;
      color:var(--text);
      background:
        radial-gradient(1200px 500px at -10% -20%, #d6e6ef 0%, transparent 58%),
        radial-gradient(900px 420px at 110% -10%, #d9e8ec 0%, transparent 55%),
        linear-gradient(180deg,var(--bg),var(--bg-2));
      min-height:100vh;
      position:relative;
      overflow-x:hidden;
    }

    body::before{
      content:"";
      position:fixed;
      inset:0;
      background-image:radial-gradient(rgba(116,141,164,.22) 1.1px, transparent 1.1px);
      background-size:18px 18px;
      opacity:.35;
      pointer-events:none;
      z-index:0;
    }

    .wrap{
      position:relative;
      z-index:1;
      max-width:1200px;
      margin:0 auto;
      padding:38px 20px 56px;
      animation:fadeIn .6s ease-out;
    }

    .hero{
      background:rgba(255,255,255,.62);
      backdrop-filter: blur(6px);
      border:1px solid rgba(255,255,255,.7);
      border-radius:24px;
      box-shadow:var(--shadow);
      padding:34px 30px;
      margin-bottom:20px;
    }

    .eyebrow{
      letter-spacing:.18em;
      font-size:12px;
      text-transform:uppercase;
      color:#7390a8;
      font-weight:700;
      margin-bottom:12px;
    }

    h1{
      margin:0;
      font-size:clamp(30px,5vw,52px);
      line-height:1.08;
      font-weight:800;
    }

    .sub{
      margin:10px 0 8px;
      font-size:14px;
      text-transform:uppercase;
      letter-spacing:.16em;
      color:#7b8ea0;
      font-weight:600;
    }

    .desc{
      margin:0;
      color:var(--muted);
      line-height:1.75;
      max-width:760px;
    }

    .panel-grid{
      display:grid;
      grid-template-columns:1.35fr .85fr;
      gap:16px;
      margin-bottom:16px;
    }

    .card{
      background:var(--panel);
      border:1px solid var(--line);
      border-radius:var(--radius);
      box-shadow:var(--shadow);
    }

    .sys{
      padding:18px;
    }

    .sys h3{
      margin:0 0 12px;
      font-size:14px;
      color:#60778d;
      text-transform:uppercase;
      letter-spacing:.12em;
    }

    .sys-list{display:grid;gap:10px}
    .sys-item{
      display:flex;
      justify-content:space-between;
      align-items:center;
      font-size:14px;
      color:#4a6176;
      background:#f2f7f9;
      border:1px solid #e4edf1;
      border-radius:12px;
      padding:10px 12px;
    }

    .folders{
      padding:18px;
    }

    .folders-head{
      display:flex;
      justify-content:space-between;
      align-items:center;
      margin-bottom:12px;
    }

    .folders-head h2{
      margin:0;
      font-size:16px;
      letter-spacing:.08em;
      text-transform:uppercase;
      color:#60778d;
      font-weight:700;
    }

    .count-pill{
      font-size:12px;
      color:#49667f;
      background:#e8f1f5;
      border:1px solid #d5e4ea;
      border-radius:999px;
      padding:6px 11px;
      font-weight:700;
    }

    .grid{
      display:grid;
      grid-template-columns:repeat(3,minmax(0,1fr));
      gap:12px;
    }

    .folder{
      text-decoration:none;
      color:inherit;
      background:#f4f9fb;
      border:1px solid #dce8ee;
      border-radius:16px;
      padding:14px;
      transition:all .3s ease;
      position:relative;
      overflow:hidden;
      animation:rise .45s ease both;
    }

    .folder::after{
      content:"";
      position:absolute;
      width:140px;
      height:140px;
      right:-60px;
      top:-70px;
      background:radial-gradient(circle, rgba(135,184,216,.22), transparent 65%);
      pointer-events:none;
    }

    .folder:hover{
      transform:translateY(-5px);
      border-color:#c6dae7;
      box-shadow:var(--shadow-hover);
      background:#f8fcfe;
    }

    .icon{
      width:42px;height:42px;
      border-radius:12px;
      display:grid;place-items:center;
      background:linear-gradient(145deg,#dceaf2,#e9f2f6);
      color:#5d7d97;
      margin-bottom:10px;
      font-size:20px;
    }

    .fname{
      font-weight:700;
      font-size:15px;
      margin-bottom:4px;
      word-break:break-word;
    }

    .meta{
      color:#7c91a4;
      font-size:12px;
      display:flex;
      align-items:center;
      gap:6px;
    }

    .empty{
      text-align:center;
      color:#7f95a9;
      font-size:14px;
      padding:24px;
      border:1px dashed #cddde7;
      border-radius:14px;
      background:#f5fafc;
    }

    @media (max-width:980px){
      .panel-grid{grid-template-columns:1fr}
      .grid{grid-template-columns:repeat(2,minmax(0,1fr))}
    }
    @media (max-width:640px){
      .hero{padding:24px 20px}
      .grid{grid-template-columns:1fr}
    }

    @keyframes fadeIn{from{opacity:0;transform:translateY(6px)}to{opacity:1;transform:translateY(0)}}
    @keyframes rise{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
  </style>
</head>
<body>
  <main class="wrap">
    <section class="hero">
      <div class="eyebrow">Based On My Projects</div>
      <h1>Kumpulan Project Praktikum</h1>
      <div class="sub">Nuriskha Ainun Fahmi (243200330) [24]</div>
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
