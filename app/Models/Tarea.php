<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    public $table = "tareas";
    protected $fillable =[
        'nombre',
        'descripcion',
        'estado',
        'id'
    ];
    
    public function empleados(){
        return $this->belongsToMany(Empleado::class, "empleado_tarea");
    }
}
