<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use DB;

class ListingCertificate extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'listing_certificate';

    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\ListingCertificateFactory::new();
    }
}


