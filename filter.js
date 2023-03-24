$(document).ready(function() {
    $('#restaurant-table th').click(function() {
        let prop = $(this).data('property');
        if (localStorage.getItem('prop') === prop)
        {
            localStorage.setItem('prop', `${prop}1`);
            prop = `${prop}1`;
        }
        else {
            localStorage.setItem('prop', `${prop}`);
        }

        $.ajax({
            url: 'load_restaurants.php',
            data: { property: prop },
            success: function(html) {
                $('#restaurant-table tbody').html(html);
            }
        });
    });
});
