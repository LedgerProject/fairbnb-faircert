<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rules extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [];
	protected $table = 'local_node_rule';
    
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\RulesFactory::new();
    }

    public function rule_translation()
    {

        return $this->hasMany(RuleTranslation::class,'translatable_id','id');
    }
}


