<!DOCTYPE html>
<html lang="en">

<?php
include 'db_connect.php';
include 'php/url_generator.php';
session_start();


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
    <title>Recipe Keeper | Recipes</title>
    <link rel="stylesheet" href="css/addrecipe-style.css">
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
                        <a class="nav-link active" href="addrecipe"> <i class="fa-solid fa-plus"></i> Add Recipe</a>
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

    <div class="container-md add-recipe-container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center "> <i class="fa-solid fa-plus"></i> Add Recipe</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="addrecipe" method="POST" enctype="multipart/form-data">
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control" id="recipeName" name="recipeName" placeholder="Name" required>
                    </div>
                    <div class="form-group col-md-12 recipe-group">
                        <select class="form-control" id="recipeCategory" name="recipeCategory" required>
                            <option value="">Select a Category</option>
                            <option value="Breakfast">Breakfast</option>
                            <option value="Lunch">Lunch</option>
                            <option value="Dinner">Dinner</option>
                            <option value="Dessert">Dessert</option>
                            <option value="Snack">Snack</option>
                        </select>
                        <select class="form-control" id="averageDifficulty" name="averageDifficulty" required>
                            <option value="">Average Difficulty</option>
                            <option value="Easy">Easy</option>
                            <option value="Normal">Normal</option>
                            <option value="Difficult">Difficult</option>
                        </select>
                        <select class="form-control" id="Rating" name="Rating" required>
                            <option value="">Rating</option>
                            <option value="1">1 Ster</option>
                            <option value="2">2 Ster</option>
                            <option value="3">3 Ster</option>
                            <option value="4">4 Ster</option>
                            <option value="5">5 Ster</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12 recipe-group">
                        <input type="number" class="form-control" id="recipeCookTime" name="recipeCookTime" placeholder="Cook time in minutes">
                        <input type="number" class="form-control" id="recipePrepTime" name="recipePrepTime" placeholder="Prep time in minutes">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="recipeDescription" name="recipeDescription" rows="3" placeholder="Description"></textarea>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="recipeIngredients" name="recipeIngredients" rows="3" placeholder="Ingredients"></textarea>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="recipeInstructions" name="recipeInstructions" rows="3" placeholder="Instructions"></textarea>
                    </div>
                    <div class="form-group">
                        <h3 class="amount-per-serving">Amount per Serving</h3>
                        <div class="form-group col-md-12 recipe-group">
                            <input type="number" class="form-control" id="calories" name="calories" placeholder="Calories">
                            <input type="number" class="form-control" id="carbs" name="carbs" placeholder="Carbs">
                            <input type="number" class="form-control" id="protein" name="protein" placeholder="Protein">
                        </div>
                        <div class="form-group col-md-12 recipe-group">
                            <input type="number" class="form-control" id="fat" name="fat" placeholder="Fat">
                            <input type="number" class="form-control" id="sugar" name="sugar" placeholder="Sugar">
                            <input type="number" class="form-control" id="sodium" name="sodium" placeholder="Sodium">
                        </div>
                        <div class="form-group col-md-12 recipe-group">
                            <input type="number" class="form-control" id="fiber" name="fiber" placeholder="Fiber">
                            <input type="number" class="form-control" id="saturatedFat" name="saturatedFat" placeholder="Saturated Fat">
                            <input type="number" class="form-control" id="cholesterol" name="cholesterol" placeholder="Cholesterol">
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="file" class="form-control-file" id="recipeImage" name="recipeImage">
                    </div>

                    <input type="submit" class="btn btn-primary" name="recipeSubmit">
                </form>
                <?php
                if (isset($_POST["recipeSubmit"])) {
                    $file_img = $_FILES['recipeImage']['name'];
                    $file_tmp = $_FILES['recipeImage']['tmp_name'];
                    $url = generateUrl();
                    $file_dest = 'upload/' . $url . '.jpg';
                    move_uploaded_file($file_tmp, $file_dest);

                    // $path = "upload/" . $file_img;
                    // move_uploaded_file($file_tmp, $path);

                    $userNameCreated = $_SESSION["username"];

                    $recipeName = $_POST["recipeName"];
                    $averageDifficulty = $_POST["averageDifficulty"];
                    $Rating = $_POST["Rating"];
                    $recipeDescription = $_POST["recipeDescription"];
                    $recipeIngredients = $_POST["recipeIngredients"];
                    $recipeInstructions = $_POST["recipeInstructions"];
                    $recipeCategory = $_POST["recipeCategory"];
                    $recipePrepTime = $_POST["recipePrepTime"];
                    $recipeCookTime = $_POST["recipeCookTime"];
                    // $recipeImage = $_FILES["recipeImage"];
                    $datum = date("Y-m-d H:i:s", time());

                    $calories = $_POST["calories"];
                    $carbs = $_POST["carbs"];
                    $protein = $_POST["protein"];
                    $fat = $_POST["fat"];
                    $sugar = $_POST["sugar"];
                    $sodium = $_POST["sodium"];
                    $fiber = $_POST["fiber"];
                    $saturatedFat = $_POST["saturatedFat"];
                    $cholesterol = $_POST["cholesterol"];

                    $sql = "INSERT INTO recipe (userNameCreated, recipeName, Rating, averageDifficulty, recipeDescription, recipeIngredients, recipeInstructions, recipeCategory, recipePrepTime, recipeCookTime, recipeImage, timeStamp, url, calories, carbs, protein, fat, sugar, sodium, fiber, saturatedFat, cholesterol) VALUES (:userNameCreated, :recipeName, :Rating, :averageDifficulty, :recipeDescription, :recipeIngredients, :recipeInstructions, :recipeCategory, :recipePrepTime, :recipeCookTime, :recipeImage, :timeStamp, :url, :calories, :carbs, :protein, :fat, :sugar, :sodium, :fiber, :saturatedFat, :cholesterol)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':userNameCreated', $userNameCreated);
                    $stmt->bindParam(":recipeName", $recipeName);
                    $stmt->bindParam(":Rating", $Rating);
                    $stmt->bindParam(":averageDifficulty", $averageDifficulty);
                    $stmt->bindParam(":recipeDescription", $recipeDescription);
                    $stmt->bindParam(":recipeIngredients", $recipeIngredients);
                    $stmt->bindParam(":recipeInstructions", $recipeInstructions);
                    $stmt->bindParam(":recipeCategory", $recipeCategory);
                    $stmt->bindParam(":recipePrepTime", $recipePrepTime);
                    $stmt->bindParam(":recipeCookTime", $recipeCookTime);
                    $stmt->bindParam(":recipeImage", $url);
                    $stmt->bindParam(":timeStamp", $datum);
                    $stmt->bindParam(":url", $url);
                    $stmt->bindParam(":calories", $calories);
                    $stmt->bindParam(":carbs", $carbs);
                    $stmt->bindParam(":protein", $protein);
                    $stmt->bindParam(":fat", $fat);
                    $stmt->bindParam(":sugar", $sugar);
                    $stmt->bindParam(":sodium", $sodium);
                    $stmt->bindParam(":fiber", $fiber);
                    $stmt->bindParam(":saturatedFat", $saturatedFat);
                    $stmt->bindParam(":cholesterol", $cholesterol);


                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                ?>

                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Success!</h4>
                            <p>Your recipe has been added!</p>
                            <hr>
                            <p class="mb-0">
                                <a href="index" class="btn btn-primary">Go to homepage</a>
                            </p>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Error!</h4>
                            <p>Your recipe has not been added!</p>
                            <hr>
                            <p class="mb-0">
                                <a href="index" class="btn btn-primary">Go to homepage</a>
                            </p>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>