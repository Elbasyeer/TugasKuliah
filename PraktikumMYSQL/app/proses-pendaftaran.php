<?php

include("PraktikumMYSQL/config/database.php");

// cek apakah tombol daftar sudah diklik atau belum?
if(isset($_POST['simpan'])){

    // ambil data dari formulir
    $kode_buku = $_POST['kode_buku'];
    $judul = $_POST['judul_buku'];
    $pengarang = $_POST['pengarang_buku'];
    $penerbit = $_POST['penerbit_buku'];
    $tahun = $_POST['tahun_penerbitan_buku'];
    $stok = $_POST['stok_buku'];

    // buat query
    $sql = "INSERT INTO buku (kode_buku, judul_buku, penulis_buku, penerbit_buku, tahun_penerbit, Stok) VALUE ('$kode_buku', '$judul', '$pengarang', '$penerbit', '$tahun', '$stok')";
    $query = mysqli_query($db, $sql);

    // apakah query simpan berhasil?
    if( $query ) {
        // kalau berhasil alihkan ke halaman list-buku.php dengan status=sukses
        header('Location: ../index.php?status=sukses');
    } else {
        // kalau gagal alihkan ke halaman list-buku.php dengan status=gagal
        header('Location: ../index.php?status=gagal');
    }

} else {
    die("Akses dilarang...");
}

?>
