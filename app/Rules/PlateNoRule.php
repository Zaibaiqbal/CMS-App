<?php

namespace App\Rules;

use App\Models\Truck;
use Illuminate\Contracts\Validation\Rule;

class PlateNoRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    private $client_id;
    private $message;
    private $plate_no;

   public function __construct($client_id,$plate_no)
   {
       $this->client_id = $client_id;
       $this->plate_no = $plate_no;
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

            $truck = new Truck;
            $truck = $truck->getTruckByCondition($value,$this->client_id);

            if(isset($truck->id))
            {
                $this->setMessage("This Plate No already exist against ".$truck->user->name);
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
