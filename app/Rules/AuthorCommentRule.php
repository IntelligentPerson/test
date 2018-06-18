<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AuthorCommentRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (preg_match("/^\w{1,}\s\w{1,}$/iu", $value)) {
            return true;
        } else {
            return false;
        }
    }
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The author field must contain two words, with a capital letter. For example: Ivan Ivanov';
    }
}
