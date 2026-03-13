<?php

namespace Models;

class Experiences extends ActiveRecord {
    public static $table = "experiences";
    public static $columns = [
        "id",
        "name",
        "short_description",
        "long_description",
        "type",
        "start_date",
        "end_date",
        "is_featured",
        "created_at",
        "updated_at"
    ];

    public $id;
    public $name;
    public $short_description;
    public $long_description;
    public $type;
    public $start_date;
    public $end_date;
    public $is_featured;
    public $created_at;
    public $updated_at;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->name = $args["name"] ?? "";
        $this->short_description = $args["short_description"] ?? "";
        $this->long_description = $args["long_description"] ?? "";
        $this->type = $args["type"] ?? "";
        $this->start_date = $args["start_date"] ?? "";
        $this->end_date = $args["end_date"] ?? null;
        $this->is_featured = $args["is_featured"] ?? "";
        $this->created_at = $args["created_at"] ?? "";
        $this->updated_at = $args["updated_a"] ?? "";
    }

    public function validate() {
        if(!$this->name) { $this->setNewAlert("error", "EL nombre no debe ir vacío"); }
        if(!$this->short_description) { $this->setNewAlert("error", "Agrega un eslogan a tu experiencia"); }
        if(strlen($this->short_description) > 100) { $this->setNewAlert("error", "El eslogan debe ser menor a 100 caracteres"); }
        if(!$this->long_description) { $this->setNewAlert("error", "Describe tu experiencia"); }
        if(!$this->type) { $this->setNewAlert("error", "Selecciona un tipo de experiencia"); }
        if(!$this->start_date) { $this->setNewAlert("error", "La fecha de inicio no puede ir vacía"); }

        return $this->getAlerts();
    }
}