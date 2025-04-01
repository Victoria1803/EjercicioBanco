<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use  App\Models\Cuenta;


class Cliente extends Model
{
    /*public function cuentas(): HasMany
    {
        return $this->hasMany(Cuenta::class)->chaperone();
    }*/


    public function nombreApellidos(){
        
        return "{$this->nombre} {$this->apellidos}";

    }


    public function cuentas(): HasMany
    {
        return $this->hasMany(Cuenta::class);
    }


    protected function casts(): array
{
    return [
        'fechaN' => 'datetime:Y-m-d',
    ];
}
}
