<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoriaproveedore extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'categoriaproveedores';

    protected $fillable = ['nombre','estado'];
	
}
