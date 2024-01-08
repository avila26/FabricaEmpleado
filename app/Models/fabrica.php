<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fabrica extends Model
{
    use HasFactory;

    protected $table='fabricas';
    public $timestamps=false;

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'fabri_id');
    }
}
