<?php

namespace app\controllers;

use app\database\models\User;
use app\controllers\Controller;
use app\database\Filters;

class HomeController extends Controller
{
  public function index()
  {
    $user = new User();
    $userFound = $user->first('id', 'asc');

    dd($userFound);

    $this->view('home', [
      'title' => 'Home',
      'name' => 'safeno'
    ]);
  } //? HomeController
}
