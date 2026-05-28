<?php
include("../config/database.php");

if (isset($_POST['simpan'])) {

    $id = $_POST['id'];
    $kode_buku = $_POST['kode_buku'];
    $judul_buku = $_POST['judul_buku'];
    $pengarang = $_POST['pengarang_buku'];
    $penerbit = $_POST['penerbit_buku'];
    $tahun_terbit = $_POST['tahun_terbit']; // Berhasil disinkronkan!
    $stok = $_POST['stok_buku'];

    // Buat query update sesuai nama kolom di database Anda
    $sql = "UPDATE buku SET 
            kode_buku='$kode_buku', 
            judul_buku='$judul_buku', 
            pengarang='$pengarang', 
            penerbit='$penerbit', 
            tahun_terbit=$tahun_terbit, 
            stok=$stok 
            WHERE id=$id";
            
    $query = mysqli_query($db, $sql);

    // Apakah query update berhasil?
    if ($query) {
        // Kalau berhasil dialihkan ke halaman list-buku.php
        header('Location: list-buku.php');
    } else {
        // Kalau gagal tampilkan pesan error
        die("Gagal menyimpan perubahan: " . mysqli_error($db));
    }

} else {
    die("Akses dilarang...");
}
?>
