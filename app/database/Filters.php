<?php

namespace app\database;

class Filters
{
  private array $filters = [];

  public function where(string $field, string $operator, mixed $value, string $logic = '')
  {
    $formatter = '';
    if (is_array($value)) {
      $formatter = "('" . implode("','", $value) . "')";
    } else if (is_string($value)) {
      $formatter = "'{$value}'";
    } else if (is_bool($value)) {
      $formatter = $value ? 1 : 0;
    } else {
      $formatter = $value;
    }

    $value = strip_tags($formatter);

    $this->filters['where'][] = "{$field} {$operator} {$value} {$logic}";
  } //? where

  public function limit(int $limit)
  {
    if ($limit > 0) {
      $this->filters['limit'] = " LIMIT {$limit}";
    }
  } //? limit

  public function orderBy(string $field, string $order = 'asc')
  {
    $field = trim(strip_tags($field));
    $order = strtoupper(trim(strip_tags($order)));

    if (empty($field)) {
      return;
    }

    if (!in_array($order, ['ASC', 'DESC'])) {
      $order = 'ASC';
    }
    $this->filters['orderBy'] = " ORDER BY {$field} {$order}";
  } //? orderBy

  public function dump()
  {
    $filterParts = [];

    // WHERE clause
    if (!empty($this->filters['where'])) {
      $whereContent = implode(' ', $this->filters['where']);
      // Remove trailing 'and' or 'or' (case-insensitive) and any surrounding spaces
      $processedWhereContent = preg_replace('/\s+(AND|OR)\s*$/i', '', trim($whereContent));
      if (!empty($processedWhereContent)) {
        $filterParts[] = 'WHERE ' . $processedWhereContent;
      }
    }

    // ORDER BY clause (already includes leading space and "ORDER BY" keyword)
    if (isset($this->filters['orderBy'])) {
      $filterParts[] = trim($this->filters['orderBy']); // Trim to ensure it joins well if it's the first part
    }

    // LIMIT clause (already includes leading space and "LIMIT" keyword)
    if (isset($this->filters['limit'])) {
      $filterParts[] = trim($this->filters['limit']); // Trim to ensure it joins well
    }

    return implode(' ', $filterParts);
  } //?dump

} //! Filters
