<!DOCTYPE html>
<html lang="en">

<?php
include 'db_connect.php';
SESSION_START();
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <title>Recipe Keeper | Home</title>
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
                    <a class="nav-link active" aria-current="page" href="index"> <i class="fa-solid fa-house"></i> Home</a>
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
                        <a class="nav-link" href="profile"> <i class="fa-solid fa-user"></i> <?php echo $_SESSION["username"] ?></a>
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
                    <h1 class="text-center"> <i class="fa-solid fa-clock-rotate-left"></i> Recent</h1>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">

                <?php
                $sql = "SELECT * FROM recipe ORDER BY timeStamp DESC LIMIT 8";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                while ($row = $stmt->fetch()) {
                    $Rating = $row['Rating'];
                    if ($Rating == 5) {
                        $Rating = '<i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i>';
                    } else if ($Rating == 4) {
                        $Rating = '<i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-regular fa-star"></i>';
                    } else if ($Rating == 3) {
                        $Rating = '<i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i>';
                    } else if ($Rating == 2) {
                        $Rating = '<i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i>';
                    } else if ($Rating == 1) {
                        $Rating = '<i class="fa-solid fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i>';
                    } else {
                        $Rating =  "-";
                    }
                    $img = $row['recipeImage'];
                    if (file_exists('upload/'.$img . '.jpg')) {
                        $img = $row['recipeImage'];;
                    } else {
                        $img = 'image-not-found';
                    }
                ?>
                    <div class="col">
                        <div class="cards">
                            <div class="card-headers">
                                <a href="view?url=<?php echo $row['url'] ?>"><img src="upload/<?php echo $img ?>.jpg" alt="<?php echo $row['recipeName'] ?>" class="card-img-top"></a>
                                <div class="box-title">
                                    <a href="view?url=<?php echo $row['url'] ?>">
                                        <h5 class="card-title"><?php echo $row['recipeName'] ?></h5>
                                    </a>
                                    <div class="card-rating">
                                        <?php echo $Rating ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>

        <div class="container recipe-container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center"> <i class="fa-solid fa-fire-flame-curved"></i> 5 Ster</h1>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">

                <?php
                $sql = "SELECT * FROM recipe WHERE Rating = 5 ORDER BY timeStamp DESC LIMIT 8";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                while ($row = $stmt->fetch()) {
                    $Rating = $row['Rating'];
                    if ($Rating == 5) {
                        $Rating = '<i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i>';
                    } else if ($Rating == 4) {
                        $Rating = '<i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-regular fa-star"></i>';
                    } else if ($Rating == 3) {
                        $Rating = '<i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i>';
                    } else if ($Rating == 2) {
                        $Rating = '<i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i>';
                    } else if ($Rating == 1) {
                        $Rating = '<i class="fa-solid fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i>';
                    } else {
                        $Rating =  "-";
                    }
                    $img = $row['recipeImage'];
                    if (file_exists('upload/'.$img . '.jpg')) {
                        $img = $row['recipeImage'];;
                    } else {
                        $img = 'image-not-found';
                    }
                ?>
                    <div class="col">
                        <div class="cards">
                            <div class="card-headers">
                                <a href="view?url=<?php echo $row['url'] ?>"><img src="upload/<?php echo $img ?>.jpg" alt="<?php echo $row['recipeName'] ?>" class="card-img-top"></a>
                                <div class="box-title">
                                    <a href="view?url=<?php echo $row['url'] ?>">
                                        <h5 class="card-title"><?php echo $row['recipeName'] ?></h5>
                                    </a>
                                    <div class="card-rating">
                                        <?php echo $Rating ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>

        <div class="container recipe-container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center"> <i class="fa-solid fa-mug-saucer"></i> Braekfast</h1>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">

                <?php
                $sql = "SELECT * FROM recipe WHERE recipeCategory = 'Breakfast' ORDER BY timeStamp DESC LIMIT 8";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                while ($row = $stmt->fetch()) {
                    $Rating = $row['Rating'];
                    if ($Rating == 5) {
                        $Rating = '<i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i>';
                    } else if ($Rating == 4) {
                        $Rating = '<i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-regular fa-star"></i>';
                    } else if ($Rating == 3) {
                        $Rating = '<i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i>';
                    } else if ($Rating == 2) {
                        $Rating = '<i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i>';
                    } else if ($Rating == 1) {
                        $Rating = '<i class="fa-solid fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i>';
                    } else {
                        $Rating =  "-";
                    }
                    $img = $row['recipeImage'];
                    if (file_exists('upload/'.$img . '.jpg')) {
                        $img = $row['recipeImage'];;
                    } else {
                        $img = 'image-not-found';
                    }
                ?>
                    <div class="col">
                        <div class="cards">
                            <div class="card-headers">
                                <a href="view?url=<?php echo $row['url'] ?>"><img src="upload/<?php echo $img ?>.jpg" alt="<?php echo $row['recipeName'] ?>" class="card-img-top"></a>
                                <div class="box-title">
                                    <a href="view?url=<?php echo $row['url'] ?>">
                                        <h5 class="card-title"><?php echo $row['recipeName'] ?></h5>
                                    </a>
                                    <div class="card-rating">
                                        <?php echo $Rating ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>