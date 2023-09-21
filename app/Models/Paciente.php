<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Paciente
 *
 * @property $id
 * @property $nombre
 * @property $apellido
 * @property $correo
 * @property $telefono
 * @property $direccion
 * @property $ciudad
 * @property $documento
 * @property $idContrato
 * @property $created_at
 * @property $updated_at
 *
 * @property Agenda[] $agendas
 * @property Ep $ep
 * @property Historia[] $historias
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Paciente extends Model
{ 
    
    static $rules = [
		'nombre' => 'required',
		'apellido' => 'required',
		'correo' => 'required',
		'telefono' => 'required',
		'direccion' => 'required',
		'ciudad' => 'required',
		'documento' => 'required',
		'idContrato' => 'required',
        'ejecucion' => 'required',

        
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre','apellido','correo','telefono','direccion','ciudad','documento','estado','idContrato','ejecucion'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function agendas()
    {
        return $this->hasMany('App\Models\Agenda', 'id_pacientes', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function ep()
    {   
        return $this->belongsTo(Ep::class, 'idEps');
        return $this->hasOne('App\Models\Ep', 'id', 'idContrato');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function historias()
    {
        return $this->hasMany('App\Models\Historia', 'pacientes_id', 'id');
    }
    public function eps()
    {
        return $this->belongsTo(Ep::class, 'idEps');
    }
    public function contrato(){
        return $this->belongsTo(Contrato::class, 'idContrato');
    }
    

}
