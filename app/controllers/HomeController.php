<?php

namespace app\controllers;

use app\database\models\User;
use app\controllers\Controller;
use app\database\Filters;

class HomeController extends Controller
{
  public function index()
  {
    $filters = new Filters;
    $filters->where('id', '>', 0);

    $user = new User;
    $user->setFilters($filters);
    $userFound = $user->findBy();

    dd($userFound);
    $this->view('home', [
      'title' => 'Home',
      'name' => 'safeno'
    ]);
  } //? HomeController
}
