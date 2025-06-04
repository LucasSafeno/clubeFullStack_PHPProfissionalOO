<?php

namespace app\core;

class Router
{
  public static function run()
  {
    $routerRegisted = new RoutersFilter;
    $router = $routerRegisted->get();

    dd($router);
  } //? run()
} //* Router
