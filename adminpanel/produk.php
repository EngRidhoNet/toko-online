<?php
require "session.php";
require "../koneksi.php";

$queryProduk = mysqli_query($conn, "SELECT * FROM produk");
$jumlahProduk = mysqli_num_rows($queryProduk);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Tambahkan jQuery dan DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>
<style>
    .no-decoration {
        text-decoration: none;
    }

    .no-decoration:hover {
        text-decoration: underline;
    }


    /* Tambahkan gaya untuk card dengan border-radius */
</style>

<body>
    <?php require "navbar.php"; ?>

    <div class="container mt-5">
        <!-- start breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel/" class="no-decoration text-muted"><i class="fa-solid fa-house"></i> Home </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Produk
                </li>
            </ol>
        </nav>
        <!-- end breadcrumb -->
        <!-- start form -->
        <div class="container mt-5" style="text-align: justify;">
            <!-- <div class="card card-custom mb-3" style="border-radius: 20px;">
                <div class="card-body">
                    <div class="my-5 ">
                        <h3>Tambah Produk</h3>
                        <form action="" method="post" enctype=""></form>
                    </div>
                </div>
            </div> -->

            <!-- start modal -->
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTambah">
                Tambah Produk
            </button>

            <!-- Modal -->
            <div class="modal fade modal-lg modal-dialog-scrollable" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Data Produk</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div>
                                    <label for="nama">Nama Produk</label>
                                    <input type="text" name="nama" id="nama" class="form-control" autocomplete="off">
                                </div>
                                <div class="mt-3">
                                    <label for="kategori">Kategori</label>
                                    <select name="kategori" id="kategori">
                                        <option value="">Pilih Kategori</option>
                                        <?php
                                        $queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
                                        while ($dataKategori = mysqli_fetch_assoc($queryKategori)) {
                                            echo '<option value="' . $dataKategori['id'] . '">' . $dataKategori['nama'] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class = "mt-2">
                                    <label for="ketersediaan-stok">Ketersediaan-Stok</label>
                                    <select name="ketersediaan-stok" id="ketersediaan-stok">
                                        <option value="Tersedia">Tersedia</option>
                                        <option value="Habis">Habis</option>
                                    </select>
                                </div>
                                <div class="mt-2">
                                    <label for="harga">Harga</label>
                                    <input type="number" name="harga" id="harga" class="form-control" autocomplete="off">
                                </div>
                                <div class="mt-2">
                                    <label for="gambar">Gambar</label>
                                    <input type="file" name="gambar" id="gambar" class="form-control" autocomplete="off">
                                </div>
                                <div class="mt-2">
                                    <label for="stok">Stok</label>
                                    <input type="number" name="stok" id="stok" class="form-control" autocomplete="off">
                                </div>
                                <div class="mt-2">
                                    <label for="deskripsi">Detail</label>
                                    <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control"></textarea>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Understood</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal -->
        </div>
        <!-- end form -->

        <!-- START LIST PRODUK -->
        <div class="container mt-5">
            <div class="card card-custom mb-3" style="border-radius: 20px;">
                <div class="card-body">
                    <div class="mt-3">
                        <h2>List Produk</h2>
                        <div class="table-responsive mt-5">
                            <table id="kategoriTable" class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Ketersediaan Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($jumlahProduk == 0) {
                                        echo '<tr><td colspan="5" class="text-center">Tidak ada produk</td></tr>';
                                    } else {
                                        $no = 1;
                                        while ($dataProduk = mysqli_fetch_assoc($queryProduk)) {
                                            echo '<tr>';
                                            echo '<td>' . $no . '</td>';
                                            echo '<td>' . $dataProduk['nama'] . '</td>';
                                            echo '<td>' . $dataProduk['kategori_id'] . '</td>';
                                            echo '<td>' . $dataProduk['harga'] . '</td>';
                                            echo '<td>' . $dataProduk['ketersediaan_stok'] . '</td>';
                                            echo '</tr>';
                                            $no++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END LIST PRODUK -->
    </div>
    <!-- bootstrap dan font awesome -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3e2c450e53.js" crossorigin="anonymous"></script>

    <script>
        // Inisialisasi DataTables dengan fitur pencarian dan sorting
        $(document).ready(function() {
            $('#kategoriTable').DataTable({
                searching: true,
                ordering: true
            });
        });
    </script>
</body>

</html>