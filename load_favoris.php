<?php
// Connexion à MongoDB et récupération des favoris

require 'config.php';

//$result = $collection_users->find(['user_id' => '1']);
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
?>