<?php

namespace CorkTech\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Estoque extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'estoques';

    protected $fillable = [
        'lote',
        'valor',
        'centrodistribuicao_id',
        'produto_id',
        'quantidade'
    ];

    public function centroDistribuicoes()
    {
        return $this->belongsTo(CentroDistribuicao::class, 'centrodistribuicao_id', 'id');
    }
    public function produtos()
    {
        //return $this->hasMany(Produto::class, 'produto_id', 'id');
        return $this->belongsTo(Produto::class, 'produto_id', 'id');
    }

}
