<?php
session_start();
if(isset($_POST['submit'])){
    require 'config.php';
    $user_restaurant = $collection_user->findOne(
        [],
        [
            'limit' => 1,
            'sort' => ['user_id' => -1],
        ]
    );
    $new_id = intval($user_restaurant['user_id']) + 1;
    $insertOneResult = $collection_user->insertOne([

        'user_id' => $new_id,

        'name' => $_POST['name'],

        'email' => $_POST['email'],

        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),

    ]);
    $_SESSION['success'] = "user created successfully";
    header("Location: connexion.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

</head>

<body>


<div class="container">
    <h1>Inscrition</h1>
    <form method="POST">
        <div class="form-group">
            <strong>name</strong>
            <input type="text" name="name" required="" class="form-control" placeholder="Name">
        </div>
        <div class="form-group">
            <strong>Email :</strong>
            <textarea class="form-control" name="email" placeholder="Email"></textarea>
        </div>
        <div class="form-group">
            <strong>Password :</strong>
            <textarea class="form-control" name="password" placeholder="Password"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
        </div>
    </form>
</div>
</body>
</html>