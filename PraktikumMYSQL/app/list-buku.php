<?php include("../config/database.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perpustakaan | Kuliah Pemrograman Web Tingkat Lanjut</title>
</head>
<body>
    <header>
        <h3>Katalog Buku</h3>
    </header>

    <nav>
        <a href="../index.php"></a>
        <a href="form-daftar.php"> {+} Tambah Baru</a>
    </nav>

    <br>

    <table border="1">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Buku</th>
            <th>Judul Buku</th>
            <th>Pengarang</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>

        <?php 
        $sql = "SELECT * FROM buku";
        $query = mysqli_query($db, $sql);
        
        $no = 0;
        while($buku = mysqli_fetch_array($query)){
            echo "<tr>";
            echo "<td>" . ++$no . "</td>"; 

            $kolom = ['kode_buku', 'judul_buku', 'pengarang', 'penerbit', 'tahun_terbit', 'stok'];

            foreach ($kolom as $k) {
                echo "<td>" . $buku[$k] . "</td>";
            }
            echo "<td>";
            echo "<a href='form-edit.php?id=".$buku['id']."'>Edit</a> | ";
            echo "<a href='hapus.php?id=".$buku['id']."'>Hapus</a>";
            echo "</td>";
            
            echo "</tr>";
            }?>
    </tbody>
    </table>

    <p>Total: <?php echo mysqli_num_rows($query) ?></p>
</body>
</html>