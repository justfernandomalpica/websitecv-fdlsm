<?php

namespace Models;

/**
 * @property int|null $id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $password
 * @property int|string $insert_id
 */
class ActiveRecord {
    //Variables
    protected static $db;
    public static $table = "";
    public static $columns = [];

    public $alerts = [];

    // DB Instance
    public static function setDB($database) {
        self::$db = $database;
    }

    // Alerts management
    public function setNewAlert(string $type, string $alert) {
        $this->alerts[$type][] = $alert;
        return $this->alerts;
    }
    public function getAlerts() {
        return $this->alerts;
    }

    // Validation will be proper of each individual model.

    // Save object to DB (Create or Update)
    public function save() {
        $hasCreated = in_array("created_at", static::$columns, true);
        $hasUpdated = in_array("updated_at", static::$columns, true);

        if (!isset($this->id)) {
            if ($hasCreated) $this->created_at = date("Y-m-d H:i:s");
            if ($hasUpdated) $this->updated_at = date("Y-m-d H:i:s");
            return $this->create();
        } else {
            if ($hasUpdated) $this->updated_at = date("Y-m-d H:i:s");
            return $this->update();
        }
    }
    // Create DB register
    public function create() {
        $table = static::$table;
        $atributes = $this->getAtributes();
        $columns = implode(", ", array_keys($atributes));
        $values = implode(", ", array_values(self::sntz($atributes)));

        $query = "INSERT INTO $table ($columns) VALUES ($values);";
        $result = static::$db->query($query);
        if($result) $this->id = self::$db->insert_id;

        return $this;
    }

    // Read DB Register
    // Returns all entries of a table as an array fulled of object
    public static function all() {
        $table = static::$table;
        $query = "SELECT * FROM $table";

        $result = static::dbQuery($query);

        return $result;
    }
    // Returns a single entry as an object
    public static function find($id) {
        $id = (int) $id;
        $table = static::$table;
        $query = "SELECT * FROM $table WHERE id = $id LIMIT 1";

        $result = static::dbQuery($query);

        return $result[0] ?? null;
    }
    
    public static function where($col, $val, bool $lim = true) {
        if(!in_array($col, static::$columns, true)) return null;
        
        $value = static::format($val);
        $table = static::$table;
        
        $query = "SELECT * FROM $table WHERE $col = $value";
        $query .= $lim ? " LIMIT 1;" : ";";
        $result = static::dbQuery($query);
        if (!$result) return null;
        if (count($result) > 1) { return $result; } else {return $result[0];} 
    }
    // Returns the value of an specific column of an entry as the original datatype
    public function getColById($id, $col) {
        if(!in_array($col, static::$columns, true)) return null;

        $id = (int) $id;
        $table = static::$table;

        $query = "SELECT $col FROM $table WHERE id = $id LIMIT 1";
        $result = static::$db->query($query);

        if(!$result) return null;
        $result = $result->fetch_assoc()[$col];

        return $result;
    }

    // Update DB register
    public function update() {
        $id = (int) $this->id;
        $table = static::$table;
        $atributes = self::sntz($this->getAtributes());
        $set = [];
        foreach ($atributes as $key => $val){
            $set[] = "$key = $val";
        }
        $set = implode(", ", $set);

        $query = "UPDATE $table SET $set WHERE id = $id LIMIT 1;";
        $result = static::$db->query($query);

        return $this;
    }
    // Delete DB register
    public function delete() {
        if (!isset($this->id)) return false;

        $table = static::$table;
        $id = (int) $this->id;
        
        $query = "DELETE FROM $table WHERE id = $id LIMIT 1";
        $result = static::$db->query($query);
        if($result) unset($this->id);

        return $result;
    }

    // Get instance atributes
    public function getAtributes() {
        $atributes = [];
        foreach (static::$columns as $column) {
            if ($column === "id") continue;
            $atributes[$column] = property_exists($this, $column) ? $this->$column : null;
        } 
        return $atributes;
    }

    // Object Sync
    public function sync($data) {
        foreach ($data as $key => $val) {
            if(!in_array($key, static::$columns)) continue;
            $this->$key = $val;
        }
        return $this;
    }

    // Execute a SQL Query
    protected static function dbQuery($query) {
        $result = static::$db->query($query);
        if(!$result) return null;

        $objects = [];
        while ($row = $result->fetch_assoc()) {
            $objects[] = static::objectifyArray($row);
        }

        $result->free();
        return $objects;
    }
    // Turn an array into an object
    protected static function objectifyArray($array) {
        $obj = new static;
        foreach ($array as $key => $val) {
            $obj->$key = $val;
        }
        return $obj;
    }
    //Gives ideal format for SQL Queries to a single value.
    protected static function format($val) : string {
        if($val === null) return "NULL";
        if(is_bool($val)) return $val ? "1" : "0";
        if(is_int($val) || is_float($val)) return (string) $val;
        
        $escaped = self::$db->escape_string((string) $val);
        return "'" . $escaped . "'";
    }
    // Applies format to all elements of an array
    protected static function sntz(array $array){
        $sanitized = [];
        foreach ($array as $key => $val) {
            $sanitized[$key] = self::format($val);
        }
        return $sanitized;
    }
}