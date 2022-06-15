<!DOCTYPE html>
<html lang="en">

<?php
include 'db_connect.php';

session_start();

if (isset($_SESSION["username"])) {
    header("location: index");
    exit();
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <title>Recipe Keeper | Register</title>
    <link rel="stylesheet" href="css/register-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ebe774794a.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" aria-label="Ninth navbar example">
        <div class="container-xl ">
            <a class="navbar-brand" href="#"><img class="navbar-logo" src="img/logo.png" alt="Recipe Keeper" srcset=""></a>

            <div class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index"> <i class="fa-solid fa-house"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="recipes"> <i class="fa-solid fa-receipt"></i> Recipes</a>
                </li>
            </div>

            <div class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="login"> <i class="fa-solid fa-right-to-bracket"></i> Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="register"> <i class="fa-solid fa-user-plus"></i> Register</a>
                </li>
            </div>
        </div>
    </nav>

    <div class="container-xl">
        <div class="row">
            <div class="col-xl-6 offset-xl-3">
                <div class="register-form">
                    <h1 class="card-title"> <i class="fa fa-user-plus"></i> Register</h1>
                    <form action="register" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="username" name="username" placeholder="&#xf007; Username" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="&#xF0e0; Email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="&#xF023; Password" required>
                        </div>
                        <input type="submit" class="btn btn-primary" value="&#xf234; Register">
                        <?php
                        if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
                            $username = $_POST['username'];
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                            $stmt = $conn->prepare("SELECT * FROM users WHERE username=? OR email=?");
                            $stmt->execute([$username, $email]);
                            $check_user = $stmt->fetch();
                            if ($check_user) {
                        ?>
                                <div class="alert alert-danger" role="alert">
                                    <strong>Error <i class="fa-solid fa-exclamation"></i></strong> Username or email already exists.
                                </div>
                            <?php
                            } else {
                                $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
                                $stmt->execute([$username, $email, $password]);
                            ?>
                                <div class="alert alert-success" role="alert">
                                    <strong>Success <i class="fa-solid fa-square-check"></i></strong> You have successfully registered.
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>