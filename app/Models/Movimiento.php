<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Movimiento
 *
 * @property $id
 * @property $lote_id
 * @property $tipo
 * @property $cantidad
 * @property $fecha
 * @property $descripcion
 * @property $created_at
 * @property $updated_at
 *
 * @property Lote $lote
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Movimiento extends Model
{
    
    static $rules = [
		'lote_id' => 'required',
		'tipo' => 'required',
		'cantidad' => 'required',
		'fecha' => 'required',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['lote_id','tipo','cantidad','fecha','descripcion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lote()
    {
        return $this->hasOne('App\Models\Lote', 'id', 'lote_id');
    }
    

}
