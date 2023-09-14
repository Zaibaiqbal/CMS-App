<?php

namespace App\Rules;

use App\Models\Account;
use Illuminate\Contracts\Validation\Rule;

class AccountNoRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

     private $account_no;
     private $message;
 
    public function __construct($account_no)
    {
        $this->account_no = $account_no;
        $this->message    = 'Required Validation.';
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
        try 
        {

            $account = new Account;
            $account = $account->getAccountByAccountNo($value);
            
            if(isset($account->id))
            {
                $this->setMessage("This Account No already added by ".$account->user->name);
                return false;
            }

        } 
        catch (Exception $e) 
        {
            dd($e);
        }
        return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
      public function setMessage($msg)
    {
        $this->message = $msg;
    }

    // RETURN CUSTOM ERROR MESSAGE
    public function message()
    {
        return $this->message;
    }
}
