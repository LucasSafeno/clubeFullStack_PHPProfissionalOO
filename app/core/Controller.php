<?php

namespace app\core;

use Exception;

class Controller
{

  public function execute(string $router)
  {
    if (!str_contains($router, '@')) {
      throw new Exception("A rota está registrada com formato errado");
    }

    list($controller, $method) =  explode('@', $router);

    $namespace = "app\controllers\\";

    $controllerNamespace = $namespace . $controller;

    // verifidca se o controller(class) existe
    if (!class_exists($controllerNamespace)) {
      throw new Exception("O controller {$controllerNamespace} não existe");
    }

    $controller = new $controllerNamespace;

    // verifica se o method existe
    if (!method_exists($controller, $method)) {
      throw new Exception("O método {$method} não existe no controller {$controllerNamespace}");
    }

    $params = new ControllerParams;
    $params = $params->get($router);

    $controller->$method($params);
  } //? execute
} //! Controller
