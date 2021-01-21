<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Torta extends Model
{
    protected $table = 'tortas';

     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
     protected $fillable = [
         'nome','telefone','kg','data','massa','papelArroz','cores','escrever'
     ];
}
