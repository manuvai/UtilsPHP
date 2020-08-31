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

