<?php
require "session.php";
require "../koneksi.php";

$id = $_GET['id'];
$queryKategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id = '$id'");
$dataKategori = mysqli_fetch_assoc($queryKategori);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Detail Kategori</title>
</head>

<body>
    <?php require "navbar.php" ?>

    <div class="container mt-5">
        <h2>Detail Kategori</h2>

        <div class="col-12 col-md-6">
            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" name="kategori" id="kategori" value="<?php echo $dataKategori['nama'] ?>" class="form-control">
                </div>

                <div class="mt-5">
                    <button type="submit" class="btn btn-primary" name="editBtn">Edit</button>
                </div>
            </form>

            <?php
            if (isset($_POST['editBtn'])) {
                $kategori = htmlspecialchars($_POST['kategori']);

                $queryEdit = mysqli_query($conn, "UPDATE kategori SET nama = '$kategori' WHERE id = '$id'");

                if ($dataKategori['nama'] == $kategori) {
                    echo '<div class="alert alert-warning" role="alert">Tidak ada perubahan</div>';
                } else {
                    $query = mysqli_query($conn, "SELECT * FROM kategori WHERE nama = '$kategori'");
                    $cek = mysqli_num_rows($query);
                    
                    if ($cek > 0) {
                        echo '<div class="alert alert-danger" role="alert">Kategori sudah ada</div>';
                    } else {
                        if ($queryEdit) {
                            $query = mysqli_query($conn, "INSERT INTO kategori VALUES (NULL, '$kategori')");
                            $success_message = $query ? 'Berhasil menambahkan kategori!' : 'Gagal menambahkan kategori!';
                            $alert_class = $query ? 'alert-success' : 'alert-danger';
                            echo '<div class="alert ' . $alert_class . ' mt-3" role="alert">' . $success_message . '</div>';
                            echo '<meta http-equiv="refresh" content="2;url=kategori.php">';
                        } else {
                            echo '<div class="alert alert-danger" role="alert">Gagal edit kategori</div>';
                        }
                    }
                }
            }
            ?>
        </div>

    </div>


    <!-- bootstrap dam fontawesome -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3e2c450e53.js" crossorigin="anonymous"></script>

</body>

</html>