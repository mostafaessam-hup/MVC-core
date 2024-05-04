<?php

namespace App\Base\Models;

use Core\Marketer\Marketer\Models\Marketer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_name', 'provider_id'
    ];

    // User
    public function marketer()
    {
        return $this->morphedByMany(Marketer::class, 'social_accountable');
    }
}
