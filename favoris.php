<?php

session_start();

if(isset($_POST['submit'])){
    require 'config.php';

//    $result = $collection_users->find(['user_id' => (int)$_POST['user_id']]);
//    $result = $collection_users->find(['user_id' => '1']);
    $result = $collection_users->find(['user_id' => $_SESSION['user_id']]);
    $favoris = json_decode(json_encode($result->toArray(),true), true);

    // Afficher les favoris filtrés
    foreach ($favoris[0]['favoris'] as $restaurant) {
        echo '<tr>';
        echo '<td>' . $restaurant['restaurant_id'] . '</td>';
        echo '<td>' . $restaurant['cuisine'] . '</td>';
        echo '<td>' . $restaurant['arrondissement'] . '</td>';
        echo '<td>' . $restaurant['code_postal'] . '</td>';
        echo '</tr>';
    }

    $deleteResult = $collection_users->updateOne(
//        array('user_id' => $_POST['user_id']),
//        array('user_id' => '1'),
        array('user_id' => $_SESSION['user_id']),
        array('$pull' => array('favoris' => array('restaurant_id' => $_POST['restaurant_id'])))
    );

    $_SESSION['success'] = "Favoris deleted";

    header("Location: favoris.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des restaurants</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!--    <script src="filter.js"></script>-->
</head>
<body>
<h1>Liste des favoris</h1>
<table id="restaurant-table">
    <thead>
    <tr>
        <th data-property="restaurant_id">restaurant_id</th>
        <th data-property="cuisine">Cuisine</th>
        <th data-property="arrondissement">Arrondissement</th>
        <th data-property="code_postal">Code postal</th>
        <th data-property="code_postal"></th>
    </tr>
    </thead>
    <tbody>
        <?php include('load_favoris.php'); ?>
        <form method="POST">
            <span>Delete a favorite</span><br>
<!--            <input type="number" name="user_id" class="form-control" placeholder="user_id">-->
            <input type="number" name="restaurant_id" class="form-control" placeholder="restaurant_id">
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
        </form>
        <a href="index.php">Return to index</a>
    </tbody>
</table>
</body>
</html>