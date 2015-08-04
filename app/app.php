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
            <form action='/car'>
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

    $app->get("/car", function() {
        $first_car = new Car("Toyota Camry", 5500, 160000, "img/camry.jpg");
        $second_car = new Car("Honda CRV", 7500, 140000, "img/crv.jpg");
        $third_car = new Car("Suburu Legacy", 7900, 130000, "img/legacy.jpg");
        $fourth_car = new Car("Tesla Model S", 200000, 5000, "img/tesla.jpg");

        $cars = array($first_car, $second_car, $third_car, $fourth_car);

        $cars_matching_search = array();
        foreach ($cars as $car) {
          $car_price = $car->getPrice();
          $car_miles = $car->getMiles();
          if (empty($_GET["price"])) {
            if ($car_miles < $_GET["miles"]) {
              array_push($cars_matching_search, $car);
            }
          } elseif (empty($_GET["miles"])) {
              if ($car_price < $_GET["price"]) {
                array_push($cars_matching_search, $car);
              }
          } elseif ($car_price < $_GET["price"] && $car_miles < $_GET["miles"]) {
            array_push($cars_matching_search, $car);
              }
          }

          $output = "";


          if (empty($cars_matching_search)) {
                  echo "<h1>Uh oh! No cars available for you.<h1>";
              } else {
                foreach ($cars_matching_search as $car) {
                    $car_make = $car->getMake();
                    $car_price = $car->getPrice();
                    $car_miles = $car->getMiles();
                    $car_image = $car->getImage();

                    $output = $output . "

                    <h3>" . $car_make . "<h3>
                   <img src=" . $car_image .">
                    <ul>
                         <li> $" . $car_price . "</li>
                         <li> Miles: " . $car_miles . "</li>
                     </ul>";
                  }
              }
              return $output;

    });

    return $app;
?>
