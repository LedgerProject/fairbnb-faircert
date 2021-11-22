<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['rules'];
	protected $table = 'listing_translation';

    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\ListingTranslationFactory::new();
    }
}
