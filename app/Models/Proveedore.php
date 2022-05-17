<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedore extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'proveedores';

    protected $fillable = ['tipodoc_id','documento','nombre','email','direccion','celular','categoria_id','estado'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function categoriaproveedore()
    {
        return $this->hasOne('App\Models\Categoriaproveedore', 'id', 'categoria_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function tipodocumento()
    {
        return $this->hasOne('App\Models\Tipodocumento', 'id', 'tipodoc_id');
    }
    
}
