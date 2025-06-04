<?php

namespace app\controllers;

use app\controllers\Controller;

class UserController extends Controller
{

  public function edit($params)
  {
    $this->view('user', [

      'title' => 'Editar User'
    ]);
  } //? edit

  public function update($params)
  {
    dd($params);
  } //? update
}//! UserController
