<?php 
require 'function.php';

$tamus = query("SELECT * FROM tamu")
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <h1>Daftar Tamu</h1>
    <div class="container">
        <!-- tambah -->

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahtamu">Tambah
            Tamu</button>

        <div class="modal fade" id="tambahtamu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Tamu</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="post">

                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama">
                            </div>

                            <div class="mb-3">
                                <label for="hp" class="form-label">No HP</label>
                                <input type="text" name="hp" class="form-control" id="hp">
                            </div>

                            <div class="mb-3">
                                <label for="ket" class="form-label">Keterangan</label>
                                <input type="text" name="ket" class="form-control" id="ket">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button name="btntambah" type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- tambah -->

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">No HP</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Tombol</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tamus as $tamu){ ?>
                <tr>
                    <td><?= $tamu["id"] ?></td>
                    <td><?= $tamu["nama"] ?></td>
                    <td><?= $tamu["hp"] ?></td>
                    <td><?= $tamu["ket"] ?></td>
                    <td>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#btnhapus<?= $tamu["id"] ?>">Hapus</button>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#btnubah<?= $tamu["id"] ?>">Ubah</button>
                    </td>
                </tr>
                <!-- hapus -->
                <div class="modal fade" id="btnhapus<?= $tamu["id"] ?>" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Apakah anda yakin?</h1>
                            </div>
                            <div class="modal-body">
                                Hal ini tidak dapat di urungkan!
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <form action="" method="post">
                                    <input name="id" type="hidden" value="<?= $tamu["id"]; ?>">
                                    <button class="btn btn-danger" type="submit" name="btnhapus">Yakin</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- hapus -->

                <!-- ubah -->
                <div class="modal fade" id="btnubah<?= $tamu["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Tamu</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="post">
                                    <input type="hidden" name="id" value="<?= $tamu["id"] ?>">
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input value="<?= $tamu["nama"]; ?>" type="text" name="nama"
                                            class="form-control" id="nama">
                                    </div>

                                    <div class="mb-3">
                                        <label for="hp" class="form-label">No HP</label>
                                        <input value="<?= $tamu["hp"]; ?>" type="text" name="hp" class="form-control"
                                            id="harga">
                                    </div>

                                    <div class="mb-3">
                                        <label for="ket" class="form-label">Keterangan</label>
                                        <input value="<?= $tamu["ket"]; ?>" type="text" name="ket" class="form-control"
                                            id="stok">
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button name="btnubah" type="submit" class="btn btn-primary">Ubah</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- ubah -->
                <?php }; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
 if(isset($_POST["btnhapus"])){
 $id = $_POST["id"];
 mysqli_query($conn, "DELETE FROM tamu WHERE id=$id");
 echo "<script>
 document.location.href='index.php'
 </script>";}

  if(isset($_POST["btntambah"])){
   $nama = $_POST["nama"];
   $hp = $_POST["hp"];
   $ket = $_POST["ket"];
   mysqli_query($conn, "INSERT INTO tamu (`id`, `nama`, `hp`, `ket`) VALUES (NULL, '$nama', '$hp', '$ket')");
   echo "<script>
   document.location.href='index.php'
   </script>";
 }
 
 if(isset($_POST["btnubah"])){
   $id = $_POST["id"];
   $nama = $_POST["nama"];
   $hp = $_POST["hp"];
   $ket = $_POST["ket"];
   mysqli_query($conn, "UPDATE tamu SET `nama` = '$nama', `hp` = '$hp', `ket` = '$ket' WHERE `tamu`.`id` = $id");
 
   if(mysqli_affected_rows($conn)>0){
     echo "<script>
     alert('Tamu berhasil diubah!');
     document.location.href='index.php'
     </script>";
   }else{
     echo "<script>
     alert('Tamu gagal diubah!');
     document.location.href='index.php'
     </script>";
   }
 }
 ?>