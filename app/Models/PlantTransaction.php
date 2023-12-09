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

    /**
     * these are the messages that will be displayed on the plant page when 
     * a user is checking plants from other owners
     */
    public static function returnTransactionTypeDictionary(){
        return $transactionTypesArray = [
            self::LIKE => 'Me gusta',
            self::WANTS => 'La pedí',
            self::GRANTED => 'Me eligieron como dueñ@' ,
            self::GIVEN_AWAY => 'Soy el nuevo dueñ@'
        ];
    }

    /**
     * these are the messages that will be displayed on the plant Owner page when 
     * an owner is checking their plants
     */
    public static function returnTransactionTypeDictionaryPlantOwner(){
        return $transactionTypesArray = [
            self::LIKE => 'Le gusta',
            self::WANTS => 'La pidieron',
            self::GRANTED => 'Ese el elegido' ,
            self::GIVEN_AWAY => 'Éste es el nuev@ dueñ@'
        ];
    }
}
