<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/car.php";

    session_start();
    if (empty($_SESSION['list_of_cars'])) {
      $_SESSION['list_of_car'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    // $app['debug'] = true;

    $app->get("/", function() use ($app) {
      // $cars = new Car($_GET["price"],$_GET["mileags"]);
      return $app['twig']->render('cars.html.twig'); //array('cars' => $cars));

    });

    $app->get("/buyer_results", function() {
        $first_car = new Car("Toyota Camry", 5500, 160000, "img/camry.jpg");
        $second_car = new Car("Honda CRV", 7500, 140000, "img/crv.jpg");
        $third_car = new Car("Suburu Legacy", 7900, 130000, "img/legacy.jpg");
        $fourth_car = new Car("Tesla Model S", 200000, 5000, "img/tesla.jpg");
        $cars = array($first_car, $second_car, $third_car, $fourth_car);

        $cars_matching_search = array();
          foreach ($cars as $car) {
              if ($car->worthBuying ($_GET["price"],$_GET["miles"])) {
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
