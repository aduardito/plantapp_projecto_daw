<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TransactionType;

class TransactionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $TrasactionType1 = new TransactionType;
        $TrasactionType1->name = 'Likes';
        $TrasactionType1->description = 'The user likes the plant of other owner';
        $TrasactionType1->active = true;
        $TrasactionType1->save();

        $TrasactionType2 = new TransactionType;
        $TrasactionType2->name = 'Wants';
        $TrasactionType2->description = 'The user request the plant of other owner';
        $TrasactionType2->active = true;
        $TrasactionType2->save();

        $TrasactionType3 = new TransactionType;
        $TrasactionType3->name = 'Granted';
        $TrasactionType3->description = 'The plant owner has decided the new owner';
        $TrasactionType3->active = true;
        $TrasactionType3->save();

        $TrasactionType4 = new TransactionType;
        $TrasactionType4->name = 'Given away';
        $TrasactionType4->description = 'The plant owner has decided other owner for their plant';
        $TrasactionType4->active = true;
        $TrasactionType4->save();
           
    }
}