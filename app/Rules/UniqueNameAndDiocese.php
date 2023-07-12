<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueNameAndDiocese implements Rule
{
    public function passes($attribute, $value)
    {
        // Extract the name and diocese values from the input
        $name = request()->input('name');
        $diocese = request()->input('diocese');

        // Query the database to check for existing records with the same name and diocese
        $count = DB::table('vicariates')
            ->where('name', $name)
            ->where('diocese', $diocese)
            ->count();

        // If the count is greater than 0, it means a matching record exists
        // Return false to indicate validation failure, otherwise return true
        return $count === 0;
    }

    public function message()
    {
        return 'The combination of name and diocese already exists.';
    }
}
