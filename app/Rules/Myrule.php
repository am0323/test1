<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Myrule implements Rule
{
    public function __construct()
    {
        $this->num = $n;
    }

    public function passes($attribute, $value)
    {
        return $value % $this->num == 0;
    }

    public function message()
    {
        return 'The validation error message.';
    }
}
