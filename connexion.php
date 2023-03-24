<?php
session_start();
if(isset($_POST['submit'])){
    require 'config.php';
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = $collection_users->findOne(['email' => $email]);
    if($user && password_verify($password, $user['password'])){
        $_SESSION['user_id'] = $user['user_id'];
        header("Location: index.php");
    } else {
        $_SESSION['error'] = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Connexion</h1>
    <?php if(isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger"><?php echo $_SESSION['error']; ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php } ?>
    <form method="POST">
        <div class="form-group">
            <strong>Email :</strong>
            <input type="email" name="email" required="" class="form-control" placeholder="Email">
        </div>
        <div class="form-group">
            <strong>Password :</strong>
            <input type="password" name="password" required="" class="form-control" placeholder="Password">
        </div>
        <div class="form-group">
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
        </div>
    </form>
</div>
</body>
</html> 