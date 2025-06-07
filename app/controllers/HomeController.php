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
    $filters->where('id', '>', 50, 'and');
    $filters->limit(5);
    $filters->orderBy('id', 'desc');

    $user = new User;
    $user->setFilters($filters);
    $user->fetchAll();


    $this->view('home', [
      'title' => 'Home',
      'name' => 'safeno'
    ]);
  } //? HomeController
}
