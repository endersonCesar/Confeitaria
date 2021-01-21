<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Recheios extends Model
{
   protected $table = 'recheios';

     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
     protected $fillable = [
          'recheio'
     ];
}
