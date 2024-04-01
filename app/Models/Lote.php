<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Lote
 *
 * @property $id
 * @property $producto_id
 * @property $proveedor_id
 * @property $fecha_ingreso
 * @property $fecha_caducidad
 * @property $cantidad
 * @property $created_at
 * @property $updated_at
 *
 * @property Producto $producto
 * @property Proveedore $proveedore
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Lote extends Model
{

    static $rules = [
		'producto_id' => 'required',
		'proveedor_id' => 'required',
		'fecha_ingreso' => 'required',
		'fecha_caducidad' => 'required',
		'cantidad' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['producto_id','proveedor_id','fecha_ingreso','fecha_caducidad','cantidad'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function producto()
    {
        return $this->hasOne('App\Models\Producto', 'id', 'producto_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function proveedore()
    {
        return $this->hasOne('App\Models\Proveedore', 'id', 'proveedor_id');
    }


}
