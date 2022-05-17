<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'municipios';

    protected $fillable = ['nombre'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function empleados()
    {
        return $this->hasMany('App\Models\Empleado', 'municipio', 'id');
    }
    
}
