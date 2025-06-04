<?php

namespace app\core;

class Router
{
  public static function run()
  {
    try {
      $routerRegisted = new RoutersFilter;
      $router = $routerRegisted->get();

      $controller = new Controller;
      $controller->execute($router);

      // dd($router);
    } catch (\Throwable $e) {
      echo $e->getMessage();
    }
  } //? run()
} //* Router
