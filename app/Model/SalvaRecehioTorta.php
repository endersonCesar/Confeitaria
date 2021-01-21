<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SalvaRecehioTorta extends Model
{
      protected $table = 'salva_recehio_tortas';

     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
     protected $fillable = [
         'recheios_id','tortas_id'
     ];
}
