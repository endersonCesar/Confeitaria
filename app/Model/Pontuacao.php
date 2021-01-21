<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pontuacao extends Model
{
   protected $table = 'pontuacaos';

     /**
      * The attributes that are mass assignable.
      *
      * @var array
      */
     protected $fillable = [
          'cliente','cpf','valor','pontos'
     ];
}
