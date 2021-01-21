<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StatusPedido extends Model
{
       protected $table = 'status_pedidos';

     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
     protected $fillable = [
         'status_id','tortas_id'
     ];

}
