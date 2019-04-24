<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Phone implements Rule
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
    	
		$phone = str_replace("-", "", $value);
		
		if(!is_numeric($phone))
		{
			return false;
		}
		if(floor($phone) != $phone)
		{
			return false;
		}
		
		$count = strlen($phone);
		
		if($count < 10 || $count > 11)
		{
			return false;
		}
		
		return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
    	return ':attribute: 半角数字10or11桁の形式で入力してください（ハイフンあり・なし、どちらでも入力可能です）';
    }
}