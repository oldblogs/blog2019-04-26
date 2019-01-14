<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Checkbox implements Rule
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
        if( $isset( $value ) ){
            if($value){
                // Checked
                return true;
            }
            else{
                // Unintended value
                return false;
            }
        }
        else{
            // TODO: Check . attribute does not used.
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Unintended value.';
    }
}
