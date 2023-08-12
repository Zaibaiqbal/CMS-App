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

            foreach($account_list->unique('account_id') as $rows)
            {
                    $account = $rows->getAccountById($rows->account_id);
                $option .= '<option value="'.encrypt($account->id).'">'.$account->account_no.'</option>';
            }

            return $option;

        }
        catch(Exception $e)
        {

        }
    }
}
