<?php

namespace app\controllers;

use app\controllers\Controller;

class UserController extends Controller
{

  public function edit($params)
  {
    $this->view('user', [
      'name' => 'safeno',
      'title' => 'Página User'
    ]);
  } //? edit
}//! UserController
