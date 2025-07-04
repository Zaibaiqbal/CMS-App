<?php

namespace App\Http\Controllers;

use App\Models\UserAccount;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    public function getClientAccountList(Request $request)
    {
        try
        {
            $client_id = $request->client_id;

            $option = '';

            $user_account = new UserAccount;
            $account_list = $user_account->getAccountListByClientId($client_id);

            foreach($account_list as $rows)
            {
                  
                $option .= '<option value="'.encrypt($rows->id).'">'.$rows->account_no.'</option>';
            }

            return $option;

        }
        catch(Exception $e)
        {

        }
    }
}
