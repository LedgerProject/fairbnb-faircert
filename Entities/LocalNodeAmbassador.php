<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LocalNodeAmbassador extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [];
	protected $table = 'local_node_ambassadors';
    
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\LocalNodeAmbassadorFactory::new();
    }

    
}


