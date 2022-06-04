<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;

    public function endereco()
    {
        return $this->hasMany(Endereco::class,'id_contato','id');
    }

    public function telefone()
    {
        return $this->hasMany(Telefone::class,'id_contato','id');
    }

    public function email()
    {
        return $this->hasMany(Email::class,'id_contato','id');
    }

}
