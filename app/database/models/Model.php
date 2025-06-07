<?php

namespace app\database\models;

use PDOException;
use app\database\Filters;

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

      dd($sql);
    } catch (PDOException $e) {
      dd($e->getMessage());
    } //catch
  } //? fetchAll
}//! Model
