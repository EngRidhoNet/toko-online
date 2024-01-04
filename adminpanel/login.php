<?php
session_start();
require '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <style>
        .main {
            height: 100vh;
            background-color: #eee;
        }

        .login-box {
            width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            box-sizing: border-box;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group button {
            width: 100%;
            padding: 8px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="login-box">
            <h2>EngRidhoNet | Toko</h2>
            <form action="" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit" name="loginbtn">Login</button>
                </div>
            </form>
        </div>
        <div>
            <?php
            if (isset($_POST['loginbtn'])) {
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);

                $sql = "SELECT * FROM users WHERE username = '$username'";
                $query = mysqli_query($conn, $sql);
                $cek = mysqli_num_rows($query);
                $data = mysqli_fetch_array($query);
                if ($cek > 0) {
                    if (password_verify($password, $data['password'])) {
                        $_SESSION['$username'] = $data['$username'];
                        $_SESSION['login'] = true;
                        header("location:index.php");
                    }
                } else{
            ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        Username atau Password salah!
                    </div>
            <?php
                }
                
            }
            ?>
        </div>
    </div>
</body>

</html>