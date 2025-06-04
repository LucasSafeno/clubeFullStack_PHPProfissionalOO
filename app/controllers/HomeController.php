<?php

namespace app\controllers;

use app\controllers\Controller;

class HomeController extends Controller
{
  public function index()
  {
    $this->view('home', [
      'title' => 'Home',
      'name' => 'safeno'
    ]);
  } //? HomeController
}
