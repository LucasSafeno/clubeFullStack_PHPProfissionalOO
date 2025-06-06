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
    $allPostData = self::all(); // Geralmente $_POST
    $filteredData = [];

    if (is_string($only)) {
      // Se $only for uma única string (nome da chave)
      if (array_key_exists($only, $allPostData)) {
        $filteredData[$only] = $allPostData[$only];
      }
    } elseif (is_array($only)) {
      // Se $only for um array de nomes de chaves
      foreach ($only as $keyName) {
        if (is_string($keyName) && array_key_exists($keyName, $allPostData)) {
          $filteredData[$keyName] = $allPostData[$keyName];
        }
      }
    }

    return $filteredData;
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
