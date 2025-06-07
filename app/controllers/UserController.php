<?php

namespace app\controllers;

use app\core\Request;
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
    $response = Request::only(['firstName', 'lastName']);

    dd($response);
  } //? update
}//! UserController
