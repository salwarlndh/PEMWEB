<?php
require "conn.php";
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM product where id_produk = '$id'");
    
    $product = [];
    
    while ($row = mysqli_fetch_assoc($result)){
        $product[] = $row;
    }
    
    $product = $product[0];
};


if (isset($_POST['update'])) {
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
            document.location.href = 'update.php'
        </script>";
    }
    else {
        if(move_uploaded_file($tmp, '../assets-landpage/'.$gambar_baru)) {
            $result = mysqli_query($conn, "UPDATE product SET
            nama = '$nama', jenis='$jenis', harga='$harga', gambar = '$gambar_baru' WHERE id_produk = '$id'");
            if ($result) {
                echo "
                <script> 
                    alert('Data Berhasil Diupdate ! ');
                    document.location.href = 'dashboard.php'
                </script>";
            }
            else {
                echo "
                <script> ('Data Gagal Diupdate!');
                document.location.href = 'update.php
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
    <title>Edit Data</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <section class="add-data">
        <div class="add-form-container">
            <h1>Update Data</h1><br><hr>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" value="id">
                <label for="nama">Nama Product</label>
                <input type="text" name="nama" value="<?php echo $product['nama']?>" class="textfield">

                <label for="jenis">Jenis Product:</label>
                    <select name="jenis" id="jenis" value="<?php echo $product['jenis']?>">
                        <option value="Face Wash">Face Wash</option>
                        <option value="Serum">Serum</option>
                        <option value="Moisturizer">Moisturizer</option>
                    </select>

                <label for="harga">Harga Product</label>
                <input type="text" name="harga" value="<?php echo $product['harga']?>" class="textfield">

                <label for="profile">Gambar</label>
                <input type="file" name = "gambar" class = "gambar" value="<?= $gambar['gambar'];?>">

                <input type="submit" name="update" value="Update Data" class="login-btn">
            </form>
        </div>
    </section>
</body>
</html>