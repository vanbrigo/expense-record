<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pay_Method extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];
    protected $table = 'pay_method';

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }
}
