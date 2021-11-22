<?php

namespace Modules\Ledger\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [];
    protected $table = 'review';
    protected static function newFactory()
    {
        return \Modules\Ledger\Database\factories\ReviewFactory::new();
    }
    
    public function reviewBy()
    {
        $this->belongsTo(User::class, 'review_by', 'id');
    }
}
