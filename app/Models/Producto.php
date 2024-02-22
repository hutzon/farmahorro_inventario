<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 *
 * @property $id
 * @property $nombre
 * @property $principio_activo
 * @property $categoria_id
 * @property $presentacion
 * @property $miligramos
 * @property $stock
 * @property $created_at
 * @property $updated_at
 *
 * @property Categoria $categoria
 * @property Lote[] $lotes
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Producto extends Model
{
    
    static $rules = [
		'nombre' => 'required',
		'principio_activo' => 'required',
		'categoria_id' => 'required',
		'presentacion' => 'required',
		'miligramos' => 'required',
		'stock' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','principio_activo','categoria_id','presentacion','miligramos','stock'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function categoria()
    {
        return $this->hasOne('App\Models\Categoria', 'id', 'categoria_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lotes()
    {
        return $this->hasMany('App\Models\Lote', 'producto_id', 'id');
    }
    

}
