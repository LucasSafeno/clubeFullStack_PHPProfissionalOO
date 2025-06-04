<?php

namespace app\core;

use app\support\Uri;
use app\routes\Routes;
use app\support\RequestType;

class RoutersFilter
{
  private string $uri;
  private string $method;
  private array $routesRegisted;


  public function __construct()
  {
    $this->uri = Uri::get();
    $this->method = RequestType::get();
    $this->routesRegisted = Routes::get();
  } //? __construct()

  private function simpleRouter()
  {
    if (array_key_exists($this->uri, $this->routesRegisted[$this->method])) {
      return $this->routesRegisted[$this->method][$this->uri];
    }

    return null;
  } //? simpleRouter()

  private function dynamicRouter()
  {
    foreach ($this->routesRegisted[$this->method] as $index => $router) {
      $regex = str_replace('/', '\/', ltrim($index, '/'));
      if ($index !== '/' && preg_match("/^$regex$/", trim($this->uri, '/'))) {
        $routerRegisterFound = $router;
        break;
      } else {
        $routerRegisterFound = null;
      }
    }
    return $routerRegisterFound;
  } //? dynamicRouter()

  public function get()
  {
    $router = $this->simpleRouter();
    if ($router) {
      return $router;
    }

    $router = $this->dynamicRouter();
    if ($router) {
      return $router;
    }

    return 'NotFoundController@index';
  } //? get();
}//* RoutersFilter
