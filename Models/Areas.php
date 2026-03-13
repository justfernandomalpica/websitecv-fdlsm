<?php

namespace Models;

class Areas extends ActiveRecord {
    public static $table = "areas";
    public static $columns = [
        "id",
        "name",
        "short_description",
        "long_description",
        "is_featured",
        "created_at",
        "updated_at"
    ];

    public $id;
    public $name; 
    public $short_description; 
    public $long_description; 
    public $is_featured; 
    public $created_at; 
    public $updated_at; 

    public function __construct($args=[]) {
        $this->id = $args["id"] ?? null;
        $this->name = $args["name"] ?? "";
        $this->short_description = $args["short_description"] ?? "";
        $this->long_description = $args["long_description"] ?? "";
        $this->is_featured = $args["is_featured"] ?? "";
        $this->created_at = $args["created_at"] ?? "";
        $this->updated_at = $args["updated_at"] ?? "";
    }

    public function validate() {
        if(!$this->name && !$this->short_description && !$this->long_description) { $this->setNewAlert("error", "No se puede crear con los campos vacíos");  return;}
        if(!$this->name) { $this->setNewAlert("error", "Nombre vacío!"); }
        if(!$this->short_description) { $this->setNewAlert("error", "Agrega un eslogan a tu area de conocimiento"); }
        if(strlen($this->short_description) > 100) {$this->setNewAlert("error", "El eslogan debe ser menor a 100 caracteres");}
        if(!$this->long_description) { $this->setNewAlert("error", "Describe de lo que trata tu area"); }
    }
}