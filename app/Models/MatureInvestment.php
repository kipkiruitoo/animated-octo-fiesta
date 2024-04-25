<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatureInvestment extends Model
{
    use HasFactory;


    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'mature_investment_id');
    }
}
