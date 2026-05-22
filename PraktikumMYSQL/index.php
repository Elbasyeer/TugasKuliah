<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <h3>SISTEM PERPUSTAKAAN</h3>
        <h1>Kuliah Pemrograman Web Lanjut</h1>
    </header>

    <h4>Menu</h4>
    <nav>
        <ul>
            <li><a href="app/form-daftar.php">Daftar Buku Baru</a></li>
            <li><a href="app/list-buku.php">Katalog Buku</a></li>
        </ul>
    </nav>

    <?php if(isset($_GET['status'])): ?>
    <p>
        <?php 
            if($_GET['status'] == 'sukses'){
                echo "Buku berhasil ditambahkan!";
            } else {
                echo "Buku gagal disimpan!";
            }
        ?>
    </p>
    <?php endif; ?>

</body>
</html>