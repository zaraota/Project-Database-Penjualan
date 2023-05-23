<?php
$host   = "localhost";
$user   = "root";
$pass   = "";

$db     = "tes_programphp";
$koneksi = mysqli_connect($host, $user, $pass, $db);

//cek koneksi
if (!$koneksi) {
    die("Koneksi ke database gagal");
}
/*
else {
    echo "koneksi berhasil";}
*/
$id_produk  = "";
$nama_produk = "";
$harga      = "";
$kategori   = "";
$status     = "";
$berhasil   = "";
$gagal      = "";

if (isset($_GET['op'])){
    $op = $_GET['op'];
} else {
    $op ="";
}
if (isset($_GET['id'])){
    $id = $_GET['id'];}


if ($op == 'delete'){
    $id     = $_GET['id'];
    $sql1   = "delete from list where id = '$id'";
    $q1     = mysqli_query($koneksi,$sql1);

    if($q1){
        $berhasil = "Berhasil Hapus data";
    }else {
        $gagal = "Gagal hapus data";
    }
}

if (isset($_POST['submit'])) {
    $id_produk  = $_POST['idproduk'];
    $nama_produk = $_POST['namaproduk'];
    $harga      = $_POST['harga'];
    $kategori   = $_POST['kategori'];
    $status     = $_POST['status'];

    if ($id_produk && $nama_produk && $harga && $kategori && $status) {
        $sql1   = "insert into list(id_produk,nama_produk,harga,kategori,status) values ('$id_produk', '$nama_produk', '$harga', '$kategori', '$status')";
        $q1     = mysqli_query($koneksi, $sql1);

        if ($q1) {
            $berhasil   = "Data berhasil diinput";
        } else {
            $gagal      = "Data GAGAL diinput";
        }
    } else {
        $gagal = "Masukkan Data";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .mx-auto {
            width: 800px;
        }

        .card {
            margin-top: 20px;
        }

        .grey {
            color: gray;
        }

        .btnreset {
            margin-top: 3px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!--input data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Tambah data
            </div>
            <div class="card-body">
                <?php
                if ($gagal) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $gagal ?>
                    </div>
                <?php
                }

                if ($berhasil) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $berhasil ?>
                    </div>
                <?php
                }
                ?>


                <form action="" method="post">
                    <div class="mb-3 row">
                        <label for="idproduk" class="col-sm-2 col-form-label">Id Produk</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="idproduk" name="idproduk" value="<?php echo $id_produk ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="namaproduk" class="col-sm-2 col-form-label">Nama Produk</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="namaproduk" name="namaproduk" value="<?php echo $nama_produk ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $harga ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="kategori" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kategori" name="kategori" value="<?php echo $kategori ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="status" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="status" id="status">
                                <option value="" class="grey"> - Pilih status penjualan -</option>
                                <option value="bisa dijual" <?php if ($status == "bisadijual") echo "selected" ?>> Bisa dijual</option>
                                <option value="tidak bisa dijual" <?php if ($status == "tidakbisadijual") echo "selected" ?>>Tidak bisa dijual</option>

                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
        <!--read data -->
        <div class="card">
            <div class="card-header bg-info">
                Produk data
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Id Produk</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Status</th>
                        </tr>
                    <tbody>
                        <?php
                        $sql2   = "select *from list order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            $id_produk  = $r2['id_produk'];
                            $nama_produk = $r2['nama_produk'];
                            $harga      = $r2['harga'];
                            $kategori   = $r2['kategori'];
                            $status     = $r2['status'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?> </th>
                                <td scope="row"><?php echo $id_produk ?> </td>
                                <td scope="row"><?php echo $nama_produk ?> </td>
                                <td scope="row"><?php echo $harga ?> </td>
                                <td scope="row"><?php echo $kategori ?> </td>
                                <td scope="row"><?php echo $status ?> </td>
                                <td>
                                    <a href="index.php?op=delete&id=<?php echo $id ?>" onclick="return confirm ('Hapus data?')"><button type="button" class="btn btn-danger">Hapus</button></a>
                                    
                                </td>

                            </tr>
                        <?php
                        }

                        ?>
                    </tbody>
                    </thead>
                </table>
            </div>
        </div>

    </div>
    
</body>

</html>