<?php

namespace app\routes;

class Routes
{
  public static function get()
  {
    return [
      'get' => [
        '/' => 'HomeController@index',
        '/user/[0-9]+' => 'UserController@edit',
        '/register' => 'RegisterController@store',
      ],
      'post' => [
        '/user/update/[0-9]+' => 'UserController@update'
      ],
    ];
  } //? get
} //*  Routes
