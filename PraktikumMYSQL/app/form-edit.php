<?php

include("../config/database.php");

// kalau tidak ada id di query string
if( !isset($_GET['id']) ){
    header('Location: list-buku.php');
}

// ambil id dari query string
$id = $_GET['id'];

// buat query untuk ambil data dari database
$sql = "SELECT * FROM buku WHERE id=$id limit 1";
$query = mysqli_query($db, $sql);
$buku = mysqli_fetch_array($query);

// jika data yang di-edit tidak ditemukan
if( mysqli_num_rows($query) < 1 ){
    die("data tidak ditemukan...");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulir Edit Buku | Kuliah Pemrograman Web Lanjut</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body>
    <header>
        <h3>Formulir Edit Buku</h3>
    </header>

    <form action="proses-edit.php" method="POST">
        <fieldset>
            
            <input type="hidden" name="id" value="<?php echo $buku['id'] ?>" />
            
            <p>
                <label for="kode_buku">Kode Buku: </label>
                <input type="text" name="kode_buku" placeholder="Isikan Kode Buku" value="<?php echo $buku['kode_buku'] ?>" required />
            </p>
            
            <p>
                <label for="judul_buku">Judul Buku: </label>
                <input type="text" name="judul_buku" placeholder="Isikan Judul Buku" value="<?php echo $buku['judul_buku'] ?>" required />
            </p>
            
            <p>
                <label for="pengarang_buku">Pengarang Buku: </label>
                <input type="text" name="pengarang_buku" placeholder="Isikan Pengarang Buku" value="<?php echo $buku['pengarang'] ?>" required />
            </p>
            
            <p>
                <label for="penerbit_buku">Penerbit Buku: </label>
                <input type="text" name="penerbit_buku" placeholder="Isikan Penerbit Buku" value="<?php echo $buku['penerbit'] ?>" required />
            </p>
            
            <p>
                <label for="tahun_terbit">Tahun Penerbitan Buku: </label>
                <input type="text" name="tahun_terbit" maxlength="4" id="tahun" pattern="\d{4}" placeholder="Isikan Tahun Penerbitan Buku" value="<?php echo $buku['tahun_terbit'] ?>" required />
            </p>
            
            <p>
                <label for="stok_buku">Stok Buku: </label>
                <input type="text" name="stok_buku" placeholder="Isikan Kode Buku" value="<?php echo $buku['stok'] ?>" required />
            </p>
            
            <p>
                <input type="submit" value="Simpan" name="simpan" />
                <a href="list-buku.php">Kembali</a>
            </p>
            
        </fieldset>
    </form>
</body>
</html>
