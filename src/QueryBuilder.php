<?php

namespace Utils;

use Exception;

class QueryBuilder {

    private $select = [];

    private $selectAliases = [];

    private $from = [];

    private $fromAliases = [];

    public function select(string $columnName, string $alias = null) {
        if (array_key_exists($columnName, $this->select)) {
            throw new Exception("Already define key $columnName");
        }

        $this->select[] = $columnName;

        if ($alias !== null) {
            $this->selectAliases[$columnName] = $alias;
        }

        return $this;
    }

    public function from(string $tableName, string $tableNameAlias = null) {
        if (array_key_exists($tableName, $this->from)) {
            throw new Exception("Already define key $tableName");
        }

        $this->from[] = $tableName;

        if ($tableNameAlias !== null) {
            $this->fromAliases[$tableName] = $tableNameAlias;
        }

        return $this;
    }

    public function generate() {
        $stringQuery = "SELECT ";
        foreach ($this->select as $col) {
            $stringQuery .= " $col";
            if (array_key_exists($col, $this->selectAliases)) {
                $stringQuery .= " AS " . $this->selectAliases[$col];
            }
        }

        $stringQuery .= " FROM ";
        foreach ($this->from as $table) {
            $stringQuery .= " $table";
            if (array_key_exists($table, $this->fromAliases)) {
                $stringQuery .= " " . $this->fromAliases[$table];
            }            
        }

        return $stringQuery;
    }

    public function getSelect() {
        return $this->select;
    }
    
    public function getSelectAliases() {
        return $this->selectAliases;
    }

    public function getFrom() {
        return $this->from;
    }

    public function getFromAliases() {
        return $this->fromAliases;
    }


}

