<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoriaproducto extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'categoriaproductos';

    protected $fillable = ['nombre','estado'];
	
}
