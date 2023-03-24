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
    </tbody>
</table>
</body>
</html>