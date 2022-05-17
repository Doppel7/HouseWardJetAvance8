<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'empleados';

    protected $fillable = ['tipodoc_id','documento','nombre','email','direccion','municipio','fechadenacimiento','telefono','celular','estado'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function municipio()
    {
        return $this->hasOne('App\Models\Municipio', 'id', 'municipio');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pedidos()
    {
        return $this->hasMany('App\Models\Pedido', 'empleado_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipodocumento()
    {
        return $this->hasOne('App\Models\Tipodocumento', 'id', 'tipodoc_id');
    }
    
}
