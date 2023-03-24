<?php


session_start();


if(isset($_POST['submit'])){
    require 'config.php';

    $last_restaurant = $collection->findOne(
        [],
        [
            'limit' => 1,
            'sort' => ['restaurant_id' => -1],
        ]
    );

    $new_id = intval($last_restaurant['restaurant_id']) + 1;

    $insertOneResult = $collection->insertOne([
        'restaurant_id' => $new_id,
        'cuisine' => $_POST['cuisine'],
        'arrondissement' => $_POST['arrondissement'],
        'code_postal' => $_POST['code_postal'],
    ]);

    $_SESSION['success'] = "Resto created successfully";

    header("Location: index.php");
}


?>


<!DOCTYPE html>

<html>

<head>

    <title>PHP & MongoDB - CRUD Operation Tutorials - ItSolutionStuff.com</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

</head>

<body>


<div class="container">

    <h1>Create Resto</h1>

    <a href="index2.php" class="btn btn-primary">Back</a>


    <form method="POST">

        <div class="form-group">

            <strong>Cuisine :</strong>

            <input type="text" name="cuisine" required="" class="form-control" placeholder="Cuisine">

        </div>

        <div class="form-group">

            <strong>Arrondissement :</strong>

            <textarea class="form-control" name="arrondissement" placeholder="Arrondissement"></textarea>

        </div>

        <div class="form-group">

            <strong>Code Postal :</strong>

            <textarea class="form-control" name="code_postal" placeholder="Code Postal"></textarea>

        </div>


        <div class="form-group">

            <button type="submit" name="submit" class="btn btn-success">Submit</button>

        </div>

    </form>

</div>


</body>

</html>