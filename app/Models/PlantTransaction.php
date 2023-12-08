<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantTransaction extends Model
{
    use HasFactory;

    const LIKE = 1;
    const WANTS = 2;
    const GRANTED = 3;
    const GIVEN_AWAY = 4;

    public static function returnTransactionTypeDictionary(){
        return $transactionTypesArray = [
            self::LIKE => 'Me gusta',
            self::WANTS => 'La pedí',
            self::GRANTED => 'Me eligieron como dueñ@' ,
            self::GIVEN_AWAY => 'Soy el nuevo dueñ@'
        ];
    }
}
