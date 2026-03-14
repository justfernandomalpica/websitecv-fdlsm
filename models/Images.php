<?php

namespace Models;

class Images extends ActiveRecord {
    public static $table = "images";
    public static $columns = ["id","projectId", "name", "role", "created_at", "updated_at"];

    public $id;
    public $projectId;
    public $name;
    public $role;
    public $created_at;
    public $updated_at;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->projectId = $args["projectId"] ?? null;
        $this->name = $args["name"] ?? null;
        $this->role = $args["role"] ?? "";
        $this->created_at = $args["created_at"] ?? "";
        $this->updated_at = $args["updated_at"] ?? "";
    }
}