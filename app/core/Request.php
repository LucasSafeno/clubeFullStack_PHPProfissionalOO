<?php

namespace app\core;

use Exception;

class Request
{

  public static function input(string $name)
  {
    if (isset($_POST[$name])) {
      return $_POST[$name];
    }
    throw new Exception("O campo {$name} não existe");
  } //? input
  public static function all()
  {
    return $_POST;
  } //? all

  public static function only(string|array $only)
  {
    $fieldsPost = self::all();
    $fieldsPostKeys = array_keys($fieldsPost);

    foreach ($fieldsPostKeys as $index => $value) {
      if ($value != (is_string($only) ? $only : ((isset($only[$index])) ? $only[$index] : null))) {
        unset($fieldsPost[$value]);
      }
    }

    return $fieldsPost;
  } //? only

  public static function execepts(string|array $except)
  {
    $fieldsPost = self::all();

    if (is_array($except)) {
      foreach ($except as $index => $value) {
        unset($fieldsPost[$value]);
      }
    }
    if (is_string($except)) {
      unset($fieldsPost[$except]);
    }
    return $fieldsPost;
  } //? excepts

  public static function query($name)
  {
    if (!isset($_GET[$name])) {
      throw new Exception("não existe a query string {$name}");
    }
    return $_GET[$name];
  } //? query

  public static function toJson(array $data)
  {
    return json_encode(($data));
  } //? toJson

  public static function toArray(string $data)
  {
    if (isJson($data)) {
      return json_decode($data);
    }
  } //? toArray
}//! Request
