<?php

namespace app\core;

use app\support\Uri;
use app\routes\Routes;
use app\support\RequestType;

class ControllerParams
{
  private function filterParams(string $router)
  {

    $uri = Uri::get();

    $explodeUri = explode('/', $uri);
    $explodeRoute = explode('/', $router);

    $params = [];
    foreach ($explodeRoute as $index => $routerSegment) {
      if ($routerSegment !== $explodeUri[$index]) {
        $params[$index] = $explodeUri[$index];
      }
    }

    return $params;
  } //? filterParams()

  public function get(string $router)
  {

    $routes = Routes::get();
    $requestMethod = RequestType::get();

    $router = array_search($router, $routes[$requestMethod]);

    $params = $this->filterParams($router);

    return array_values($params);
  } //? get
}//! ControllerParams
