<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Expense extends Model
{
    /** @use HasFactory<\Database\Factories\ExpenseFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'amount',
        'category',
        'date',
        'receipt_path',
        'notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
