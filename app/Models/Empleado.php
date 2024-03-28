<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    public $table ="empleados";
    protected $fillable = [
        "nombre", 
        "apellido",
        "id",
        "email",
        "password",
    ];
    protected $hidden = [
        'password',
        
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
    public function tareas(){
        return $this->belongsToMany(Tarea::class, "empleado_tarea");
    }
}
