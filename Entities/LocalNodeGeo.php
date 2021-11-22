<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LocalNodeGeo extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'local_node_geo';
    
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\LocalNodeGeonFactory::new();
    }
}
