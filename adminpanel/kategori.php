<?php
require "session.php";
require "../koneksi.php";

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Tambahkan jQuery dan DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <style>
        .no-decoration {
            text-decoration: none;
        }

        .no-decoration:hover {
            text-decoration: underline;
        }

        /* Tambahkan gaya untuk card dengan border-radius */
    </style>
</head>

<body>
    <!-- Navbar-Start -->
    <?php require "navbar.php"; ?>
    <!-- Navbar End -->

    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="../adminpanel/" class="no-decoration text-muted"><i class="fa-solid fa-house"></i> Home </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Kategori
                </li>
            </ol>
        </nav>

        <div class="container mt-5">
            <div class="card card-custom mb-3" style="border-radius: 20px;">
                <div class="card-body">
                    <div class="mt-3">
                        <h2>List Kategori</h2>
            
                        <div class="table-responsive mt-5">
                            <table id="kategoriTable" class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Kategori</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $number = 1;
                                    while ($data = mysqli_fetch_assoc($queryKategori)) {
                                        echo '<tr>
                                                <td>' . $number . '</td>
                                                <td>' . $data['nama'] . '</td>
                                              </tr>';
                                        $number++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Fontawesome dan cdn bootstrap -->
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