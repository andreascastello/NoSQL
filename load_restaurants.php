<?php
// Connexion à MongoDB et récupération des restaurants

require 'config.php';

$result = $collection->find([]);
$restaurants = json_decode(json_encode($result->toArray(),true), true);

// Vérifier si une propriété de filtrage a été spécifiée
if (isset($_GET['property'])) {

    $prop = $_GET['property'];
    $char = substr($prop, -1);

    if ($char == 1)
    {
        $prop = rtrim($prop, "1");
        // Filtrer les restaurants par la propriété spécifiée
        $restaurants = $collection->find(
            [],
            [
                'sort' => [$prop => -1],
            ]
        );
    }
    else {
        $restaurants = $collection->find(
            [],
            [
                'sort' => [$prop => 1],
            ]
        );
    }

}

// Afficher les restaurants filtrés
foreach ($restaurants as $restaurant) {
    echo '<tr>';
    echo '<td>' . $restaurant['restaurant_id'] . '</td>';
    echo '<td>' . $restaurant['cuisine'] . '</td>';
    echo '<td>' . $restaurant['arrondissement'] . '</td>';
    echo '<td>' . $restaurant['code_postal'] . '</td>';
    echo '</tr>';
}

?>
