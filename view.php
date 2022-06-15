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
    <title>Recipe Keeper | View</title>
    <link rel="stylesheet" href="css/view-style.css">
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

    <div class="container-xl">
        <div class="row">
            <div class="col-md-12">
                <div class="recipe">
                    <div class="recipe-body">
                        <?php
                        $stmt = $conn->query("SELECT * FROM `recipe` WHERE url = '" . $_GET['url'] . "'");
                        $row = $stmt->fetch();
                        $Date = $row['timeStamp'];
                        $changeDate = date("d-m-Y", strtotime($Date));
                        $Rating = $row['Rating'];
                        if ($Rating == 5) {
                            $Rating = '<i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i>' ;
                        } else if ($Rating == 4) {
                            $Rating = '<i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-regular fa-star"></i>' ;
                        } else if ($Rating == 3) {
                            $Rating = '<i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i>' ;
                        } else if ($Rating == 2) {
                            $Rating = '<i class="fa-solid fa-star"></i> <i class="fa-solid fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i>' ;
                        } else if ($Rating == 1) {
                            $Rating = '<i class="fa-solid fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i> <i class="fa-regular fa-star"></i>' ;
                        } else {
                            $Rating =  "-";
                        }
                        $img = $row['recipeImage'];
                        if (file_exists('upload/'.$img . '.jpg')) {
                            $img = $row['recipeImage'];;
                        } else {
                            $img = 'image-not-found-view';
                        }
                        if ($row['url'] == $_GET['url']) {
                        ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <img class="recipe-img " src="upload/<?php echo $img ?>.jpg" alt="" srcset="">
                                </div>
                                <div class="col-md-9">
                                    <h2 class="recipe-title"><?php echo $row['recipeName'] ?></h2>
                                    <h5 class="recipe-category"><?php echo $row['recipeCategory'] ?></h5>
                                    <div class="recipe-attribute">
                                        <div class="col-md-4">
                                            <table class="table">
                                                <tbody class="recipe-attributes">
                                                    <tr>
                                                        <th scope="row">Source: </th>
                                                        <td><strong><?php echo $row['userNameCreated'] ?></strong></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Cooking Time: </th>
                                                        <td><?php echo $row['recipeCookTime'] ?> m</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Preparing Time: </th>
                                                        <td><?php echo $row['recipePrepTime'] ?> m</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Difficulty: </th>
                                                        <td><?php echo $row['averageDifficulty'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Time Created: </th>
                                                        <td><?php echo $changeDate ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Rating: </th>
                                                        <td><?php echo $Rating ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-4">
                                            <table class="table">
                                                <tbody class="recipe-attributes">
                                                    <tr>
                                                        <th scope="row"></th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"> </th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"></th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"></th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"></th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row"> </th>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-3">
                                            <table class="table recipe-attributes-2">
                                                <tbody class="recipe-attributes">
                                                    <tr>
                                                        <th scope="row">Calories: </th>
                                                        <td><?php echo $row['calories'] ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Carbs: </th>
                                                        <td><?php echo $row['carbs'] ?> g</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Protein: </th>
                                                        <td><?php echo $row['protein'] ?> g</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Fat: </th>
                                                        <td><?php echo $row['fat'] ?> g</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Sugar: </th>
                                                        <td><?php echo $row['sugar'] ?> g</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Sodium: </th>
                                                        <td><?php echo $row['sodium'] ?> mg</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Cholesterol: </th>
                                                        <td><?php echo $row['cholesterol'] ?> mg</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <h3 class="recipe-description">Description</h3>
                                    <p class="recipe-description-text"><?php echo nl2br($row['recipeDescription']) ?></p>
                                </div>
                                <div class="col-md-12">
                                    <h3 class="recipe-ingredients">Ingredients</h3>
                                    <p class="recipe-ingredients-text"><?php echo nl2br($row['recipeIngredients']) ?></p>
                                </div>
                                <div class="col-md-12">
                                    <h3 class="recipe-instructions">Instructions</h3>
                                    <p class="recipe-instructions-text"><?php echo nl2br($row['recipeInstructions']) ?></p>
                                </div>
                            </div>
                        <?php
                        } else {
                            echo "Recipe not found";
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>