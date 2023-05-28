<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = [
        'poll_creator',
        'poll_name',
        'options',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'poll_creator');
    }
}
