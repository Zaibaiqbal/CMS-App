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
            $account_list = $user_account->getUserAccountListByClientId($client_id);

            foreach($account_list as $rows)
            {
                  
                $option .= '<option value="'.encrypt($rows->id).'">'.$rows->account->account_no.' - '.$rows->title.'</option>';
            }

            return $option;

        }
        catch(Exception $e)
        {

        }
    }
}
