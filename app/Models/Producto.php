<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'productos';

    protected $fillable = ['nombre','precio','categoria_id','ficha_id','estado'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function categoriaproducto()
    {
        return $this->hasOne('App\Models\Categoriaproducto', 'id', 'categoria_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function fichatecnica()
    {
        return $this->hasOne('App\Models\Fichatecnica', 'id', 'ficha_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pedidos()
    {
        return $this->hasMany('App\Models\Pedido', 'producto_id', 'id');
    }
    
}
