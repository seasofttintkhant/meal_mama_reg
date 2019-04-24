<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Password implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $uppercase = preg_match('@[A-Z]@', $value);
        $lowercase = preg_match('@[a-z]@', $value);
        $number    = preg_match('@[0-9]@', $value);
        $special   = preg_match('/[^a-zA-Z\d]/', $value);

        if(strlen($value) < 6 || strlen($value) > 32)
        {
            return false;
        }

        if($uppercase && ($lowercase || $number || $special))
        {
            return true;
        }
        elseif(($uppercase || $lowercase || $number) && $special){
            return true;
        }
        elseif(($uppercase || $lowercase || $special) && $number)
        {
            return true;
        }

        return false;

   
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
    	return ':attribute: パスワードは6文字以上から32文字以下で、アルファベットの大文字・小文字、
    数字、記号（-_+$!#%）から最低2種類の文字を含んでいる必要があります。';
    }
}