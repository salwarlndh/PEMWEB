<?php
require 'conn.php';

if (isset($_POST['add'])) {
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $harga = $_POST['harga'];

    // File Gambar
    $gambar = $_FILES['gambar']['name'];
    $x = explode('.', $gambar);
    $nama_gambar = strtolower(($x[0]));
    $ekstensi = strtolower(end($x));
    $gambar_baru = "$nama_gambar.$ekstensi";
    $tmp = $_FILES['gambar']['tmp_name'];
    $checktipe_ekstensi = array("jpg", "jpeg", "gif", "webp");
    if(in_array($ekstensi, $checktipe_ekstensi) === false){
        echo "
        <script>
            alert('Ekstensi bukan tipe gambar');
            document.location.href = 'add.php'
        </script>";
    }
    else {
        if(move_uploaded_file($tmp, 'imgUpload/'.$gambar_baru)) {
            $result = mysqli_query($conn, "INSERT INTO product VALUES
            ('', '$nama', '$jenis', '$harga', '$gambar_baru')");
            if ($result) {
                echo "
                <script> 
                    alert('Data Berhasil Ditambahkan ! ');
                    document.location.href = 'dashboard.php'
                </script>";
            }
            else {
                echo "
                <script> ('Data Gagal Ditambahkan !');
                document.location.href = 'add.php
            </script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <section class="add-data">
        <div class="add-form-container">
            <h1>Tambah Data</h1><br><hr>
                <form action="" method="post" enctype="multipart/form-data">
                    <label for="nama">Nama Product</label>
                    <input type="text" name="nama" class="textfield">

                    <label for="jenis">Jenis Product:</label>
                        <select name="jenis" id="jenis">
                            <option value="Face Wash">Face Wash</option>
                            <option value="Serum">Serum</option>
                            <option value="Moisturizer">Moisturizer</option>
                        </select>

                    <label for="harga">Harga Product</label>
                    <input type="text" name="harga" class="textfield">

                    <label for="profile">Gambar</label>
                    <input type="file" name = "gambar" class = "gambar">

                    <input type="submit" name="add" value="Create" class="login-btn">
                </form>
        </div>
    </section>
</body>
</html>