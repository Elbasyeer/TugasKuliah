<!DOCTYPE HTML>
<html>
<head>
    <title>Form Penambahan Buku Baru | Kuliah Pemroograman Web Lanjut</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>

<body>
    <header>
        <h3>Form Penambahan Buku Baru</h3>
    </header>

    <form action="proses-pendaftaran.php" method="POST">

        <fieldset>

            <p>
                <label for="nama">Kode Buku: </label>
                <input type="text" name="kode_buku" placeholder="Isikan Kode buku" required />
            </p>
            <p>
                <label for="nama">Judul Buku: </label>
                <input type="text" name="judul_buku" placeholder="Isikan Judul buku" required />
            </p>
            <p>
                <label for="nama">Pengarang Buku: </label>
                <input type="text" name="pengarang_buku" placeholder="Isikan pengarang buku" required />
            </p>
            <p>
                <label for="nama">Penerbit Buku: </label>
                <input type="text" name="penerbit_buku" placeholder="Isikan penerbit buku" required />
            </p>
            <p>
                <label for="nama">Tahun Penerbitan Buku: </label>
                <input type="text" maxlength="4" id="tahun" pattern="\d{4}" name="tahun_penerbitan_buku" placeholder="Isikan tahun penerbitan buku" required/>
            </p>
            <p>
                <label for="nama">Stok Buku: </label>
                <input type="number" min="0" name="stok_buku" placeholder="Isikan stok buku" required />
            </p>
            <p>
                <input type="submit" value="Simpan" name="simpan" />
                <input type="reset" value="Kosongkan" name="reset" />
                <a href="list-buku.php">Kembali</a>
            </p>

        </fieldset>

    </form>

</body>
</html>
