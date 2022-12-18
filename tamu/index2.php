<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Upload file</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <h1>Upload!</h1>

    <!-- tambah -->
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#upload">
        Upload
    </button>

    <!-- Modal -->
    <div class="modal fade" id="upload" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" id="nama">
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">file</label>
                            <input type="file" name="upload" class="form-control" id="file">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button name="btnupload" type="submit" class="btn btn-primary">simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- tambah -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</body>

</html>

<?php 
    if(isset($_POST["btnupload"])){


    $nama = $_POST["nama"];
    $namaFile = $_FILES['upload']['name'];
    $ukuranFile = $_FILES['upload']['size'];
    $error = $_FILES['upload']['error'];
    $tmpName = $_FILES['upload']['tmp_name'];

    if ($error === 4) {
        echo "<script>alert('Masukkan Gambar Dulu!')</script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $extensiValid = ['jpg', 'jpeg', 'png'];
    $extensi = explode('.', $namaFile);
    $extensi = strtolower(end($extensi));

    // cek apakah isinya ada atau tidak
    if (!in_array($extensi, $extensiValid)) {
        echo "<script>alert('Yang anda masukkan bukan gambar')</script>";
        return false;
    }

    // cek ukuran file
    if ($ukuranFile > 10000000) {
        echo "<script>alert('Ukuran file gambar terlalu besar!')</script>";
        return false;
    }

    $namaFileBaru = uniqid() . "." . $extensi;

    move_uploaded_file($tmpName, "img/" . $namaFileBaru);

    $namaGambar = $namaFileBaru;

        $conn = mysqli_connect("localhost","root","","namag");
        mysqli_query($conn, "INSERT INTO `gambar` (`id`, `nama`, `gambar`) VALUES (NULL, '$nama', '$namaGambar')");
        
    }
?>