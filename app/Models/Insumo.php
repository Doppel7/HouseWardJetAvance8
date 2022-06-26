<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'insumos';

    protected $fillable = ['nombre','cantidad','unidad_id','categoria_id','estado'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function categoriainsumo()
    {
        return $this->hasOne('App\Models\Categoriainsumo', 'id', 'categoria_id');
    }
    public function unidade()
    {
        return $this->hasOne('App\Models\Unidade', 'id', 'unidad_id');
    }
    
}
