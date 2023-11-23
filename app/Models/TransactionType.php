<?php
// php artisan make:model TransactionType
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    use HasFactory;

    const LIKE = 1;
    const WANTS = 2;
    const GRANTED = 3;
    const GIVEN_AWAY = 4;
}
