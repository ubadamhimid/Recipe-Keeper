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
    <title>Recipe Keeper | Login</title>
    <link rel="stylesheet" href="css/login-style.css">
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
                    <a class="nav-link active" href="login"> <i class="fa-solid fa-right-to-bracket"></i> Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register"> <i class="fa-solid fa-user-plus"></i> Register</a>
                </li>
            </div>
        </div>
    </nav>

    <div class="container-xl">
        <div class="row">
            <div class="col-xl-6 offset-xl-3">
                <div class="login-form">
                    <h1> <i class="fa-solid fa-right-to-bracket"></i> Login</h1>
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="&#xF0e0; Email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="&#xF023; Password" required>
                        </div>
                        <input type="submit" class="btn btn-primary" name="login" value="&#xF2f6; Login">
                    </form>

                    <?php
                    if (isset($_POST['login'])) {
                        $email = $_POST['email'];
                        $password = $_POST['password'];

                        $query = "SELECT * FROM users WHERE email = :email AND password = :password";
                        $stmt = $conn->prepare($query);
                        $stmt->bindParam(':email', $email);
                        $stmt->bindParam(':password', $password);
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($row['email'] == $email && $row['password'] == $password) {
                            $_SESSION['username'] = $row['username'];
                            $_SESSION['email'] = $email;
                            $_SESSION['password'] = $password;
                            header('Location: index');
                        } else {
                    ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Error <i class="fa fa-exclamation"></i></strong> Wrong email or password.
                            </div>
                    <?php
                        }
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>