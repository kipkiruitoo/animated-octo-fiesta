<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    use HasFactory;

    public function investor()
    {
        return $this->belongsTo(User::class, 'payee_id');
    }

    public function investment()
    {
        return $this->belongsTo(Investment::class, 'investment_id');
    }

}
