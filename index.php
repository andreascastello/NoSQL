<?php

session_start();

if(isset($_POST['submit'])){
    require 'config.php';

    $result = $collection->find(['restaurant_id' => (int)$_POST['restaurant_id']]);
    $restaurants = json_decode(json_encode($result->toArray(),true), true);

//    $check = $collection_users->find(['user_id' => (int)$_POST['user_id']]);
//    $check = $collection_users->find(['user_id' => '1']);
    $check = $collection_users->find(['user_id' => $_SESSION['user_id']]);
    $check_fav = json_decode(json_encode($check->toArray(),true), true);

    $can_add = true;

// Afficher les favoris filtrés
    foreach ($check_fav[0]['favoris'] as $restaurant) {
        if($restaurant['restaurant_id'] == $_POST['restaurant_id'])
        {
            $can_add = false;
        }
    }

    if($can_add)
    {
        $new_favorite = array(
            'restaurant_id' => $_POST['restaurant_id'],
            'cuisine' => $restaurants[0]['cuisine'],
            'arrondissement' => $restaurants[0]['arrondissement'],
            'code_postal' => $restaurants[0]['code_postal']
        );

        $collection_users->updateOne(
//            array('user_id' => $_POST['user_id']),
//            array('user_id' => '1'),
            array('user_id' => $_SESSION['user_id']),
            array('$push' => array("favoris" => $new_favorite))
        );

        echo ("Restaurant added to favorite");
        $_SESSION['success'] = "Restaurant added to favorite";
    }
    else{
        echo ("Restaurant already exist in favorite");
        $_SESSION['success'] = "Restaurant already exist in favorite";
    }

    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des restaurants</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="filter.js"></script>
</head>
<body>
<h1>Liste des restaurants</h1>
<table id="restaurant-table">
    <thead>
    <tr>
        <th data-property="restaurant_id">restaurant_id</th>
        <th data-property="cuisine">Cuisine</th>
        <th data-property="arrondissement">Arrondissement</th>
        <th data-property="code_postal">Code postal</th>
    </tr>
    </thead>
    <tbody>
        <?php include('load_restaurants.php'); ?>
        <form method="POST">
            <span>Add a restaurant to favorite</span><br>
<!--            <input type="number" name="user_id" class="form-control" placeholder="user_id">-->
            <input type="number" name="restaurant_id" required="" class="form-control" placeholder="restaurant_id">
            <button type="submit" name="submit" class="btn btn-success">Submit</button>
        </form>
    </tbody>
</table>
</body>
</html>