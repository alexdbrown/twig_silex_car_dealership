<?php
    class Car
    {
        private $make_model;
        private $price;
        private $miles;
        private $image;

  //The below propoerties are for the "post" function

        private $model;
        private $mileage;
        private $cost;
        private $photo;

        function __construct($make, $price, $miles, $image, $model, $mileage, $cost, $photo)
        {
            $this->make_model = $make;
            $this->price = $price;
            $this->miles = $miles;
            $this->image = $image;
            $this->model = $model;
            $this->mileage = $mileage;
            $this->cost = $cost;
            $this->photo = $photo;
        }

        function setMake($new_make)
        {
            $this->make_model = $new_make;
        }

        function getMake()
        {
            return $this->make_model;
        }

        function setPrice($new_price)
        {
            $float_price = (float) $new_price;
            if ($float_price != 0) {
                $this->price = $float_price;
            }
        }

        function getPrice()
        {
            return $this->price;
        }

        function setMiles($new_miles)
        {
            $this->miles = $new_miles;
        }

        function getMiles()
        {
            return $this->miles;
        }

        function setImage($new_image)
        {
            $this->image = $new_image;
        }

        function getImage()
        {
            return $this->image;
        }

        function setModel($new_model)
        {
          $this->model = $new_model;
        }

        function getModel()
        {
          return $this->model;
        }

        function setMileage($new_mileage)
        {
          $this->mileage = $new_mileage;
        }

        function getMileage()
        {
          return $this->mileage;
        }

        function setCost($new_cost)
        {
          $this->cost = $new_cost;
        }

        function getCost()
        {
          return $this->cost;
        }

        function setPhoto($new_photo)
        {
          $this->photo = $new_photo;
        }

        function getPhoto()
        {
          return $this->photo;
        }

        function worthBuying($user_price, $user_miles)
        {
           if ($this->price < $user_price && $this->miles < $user_miles) {
              return true;
           } else {
              return false;
           }
        }

        static function getAll()
        {
          return $_SESSION['list_of_cars'];
        }

        function save()
        {
          array_push($_SESSION['list_of_cars'], $this);
        }


    }
?>
