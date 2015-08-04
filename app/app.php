<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/car.php";

    $app = new Silex\Application();

    $app->get("/", function() {
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css'>
            <title>Cars!!</title>
        </head>
        <body>
          <h1>Find YOUR new car...</h1>
          <div class='container'>
            <form action='car.php'>
              <div class='form-group'>
                <label for='price'>Enter your max price: $</label>
                <input id='price' name='price' class='form-control' type='number'>
              </div>
              <div class='form-group'>
                <label for='miles'>Enter your desired mileage</label>
                <input id='miles' name='miles' class='form-control' type='number'>
              </div>
              <button type='submit' class='btn-danger'>Search now!</button>
            </form>
          </div>
        </body>
        </html>
            ";
    });

    return $app;
?>
