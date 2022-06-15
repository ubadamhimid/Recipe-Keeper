<!DOCTYPE html>
<html lang="en">

<?php
include 'db_connect.php';
SESSION_START();

if (!isset($_SESSION["username"])) {
    header("location: login");
    exit();
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <title>Recipe Keeper | Profile</title>
    <link rel="stylesheet" href="css/style.css">
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
                <?php
                if (isset($_SESSION["username"])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="addrecipe"> <i class="fa-solid fa-plus"></i> Add Recipe</a>
                    </li>
                <?php }
                ?>
            </div>

            <div class="navbar-nav ml-auto">
                <?php
                if (isset($_SESSION["username"])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout"> <i class="fa-solid fa-sign-out-alt"></i> Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="profile"> <i class="fa-solid fa-user"></i> <?php echo $_SESSION["username"] ?></a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login"> <i class="fa-solid fa-right-to-bracket"></i> Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register"> <i class="fa-solid fa-user-plus"></i> Register</a>
                    </li>
                <?php
                }
                ?>
            </div>
        </div>
    </nav>


    <div class="album py-5">
        <div class="container recipe-container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center"> <i class="fa-solid fa-user"></i> Profile</h1>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">

                            <h2 class="text-center"> Username: <?php echo $_SESSION["username"] ?></h2>
                        </div>
                        <div class="col-md-12">
                            <h3 class="text-center">Email: <?php echo $_SESSION["email"] ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>