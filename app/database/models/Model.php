<?php

namespace app\database\models;

use PDOException;
use app\database\Filters;
use app\database\Connection;

abstract class Model
{
  private string $fields = '*';
  private string $filters = '';

  protected string $table;

  public function setFields($fields)
  {
    $this->fields = $fields;
  } //? setFields

  public function setFilters(Filters $filters)
  {
    $this->filters = $filters->dump();
  } //? setFilters

  public function fetchAll()
  {
    try {
      $sql = "SELECT {$this->fields} FROM {$this->table} {$this->filters}";

      $connection  = Connection::connect();
      $query = $connection->query($sql);

      return $query->fetchAll(\PDO::FETCH_CLASS, get_called_class());
    } catch (PDOException $e) {
      dd($e->getMessage());
    } //catch
  } //? fetchAll

  public function findBy(string $field = '', string $value = '')
  {
    try {
      $sql = (empty($this->filters)) ?
        "SELECT {$this->fields} FROM {$this->table} WHERE {$field} = :{$field}" :
        "SELECT {$this->fields} FROM {$this->table} {$this->filters}";

      $connection = Connection::connect();

      $prepare = $connection->prepare($sql);

      $prepare->execute(!$this->filters ? [$field => $value] : []);

      return $prepare->fetchObject(get_called_class());
    } catch (PDOException $e) {
      dd($e->getMessage());
    } //catch
  } // findBy

  public function first($field = 'id', $order = 'asc')
  {
    try {
      $sql = "SELECT {$this->fields} FROM {$this->table} ORDER BY {$field} {$order} ";
      $connection = Connection::connect();

      $query = $connection->query($sql);

      return $query->fetchObject(get_called_class());
    } catch (PDOException $e) {
      dd($e->getMessage());
    }
  } //?first

  public function delete(string $field = '', string |int $value = '')
  {
    try {
      $sql = (!empty($this->filters)) ?
        "DELETE FROM  {$this->table}  {$this->filters}" :
        "DELETE FROM  {$this->table}  WHERE {$field} = :{$field}";

      $connection = Connection::connect();

      $prepare = $connection->prepare($sql);

      $prepare->execute(empty($this->filters) ? [$field => $value] : []);

      return $prepare->execute();
    } catch (PDOException $e) {
      dd($e->getMessage());
    } //catch
  } //delete
}//! Model
