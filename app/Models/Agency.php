<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    protected $fillable = ['ragione_sociale', 'indirizzo', 'codice_postale', 'città', 'provincia', 'regione', 'email'];
}
