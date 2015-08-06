<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/car.php";

    session_start();
    if (empty($_SESSION['list_of_cars'])) {
      $_SESSION['list_of_cars'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

     $app['debug'] = true;

    $app->get("/", function() use ($app) {
      return $app['twig']->render('cars.html.twig', array('cars' => Car::getAll()));

    });

    $app->get("/buyer_results", function() use ($app) {
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

        return $app['twig']->render('buyer_results.html.twig', array('cars' => $cars_matching_search));
    });

    $app->post("/seller_results", function() use ($app) {
      $cars = new Car($_POST['model'], $_POST['mileage'], $_POST['cost'], $_POST['photo']);
      $list_of_cars = array($cars);
      $cars->save();
      return $app['twig']->render('seller_results.html.twig', array('cars' => Car::getAll());
    });

    return $app;
?>
