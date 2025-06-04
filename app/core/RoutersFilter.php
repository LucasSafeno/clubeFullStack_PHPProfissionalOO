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

    return 'NotFoundController@index';
  } //? simpleRouter()

  private function dynasmicRouter() {} //? dynamicRouter()

  public function get()
  {
    return $this->simpleRouter();
  } //? get();
}//* RoutersFilter
