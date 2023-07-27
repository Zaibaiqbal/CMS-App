<?php

namespace App\Http\Controllers;

use App\Models\MaterialType;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {

        $transactions_list = Transaction::get();
        return view('transactions.manage_transactions',[
            'transaction_list'  =>  $transactions_list
        ]);
    }

    public function storeTransaction(Request $request)
    {
        try
        {
            $data = ['status' => false, 'message' => ''];

            if($request->isMethod('post'))
            {

                $form_data   =  $request->input();

                $form_data['material_type']   = decrypt($form_data['material_type']);
                // $form_data['user_id']   = decrypt($form_data['user_id']);
                // if(isset($form_data['truck_id']))
                // {
                // $form_data['truck_id']   = decrypt($form_data['truck_id']);


                // }
                // $form_data['client']   = decrypt($form_data['user_id']);

                $transaction = new Transaction;

                $transaction = $transaction->storeTransaction($form_data);

                if(isset($transaction->id))
                {
                    $data = ['status' => true, 'message' => 'Transaction successful'];
                 
                }


            }
            else
            {
                $material_type = new MaterialType;
                $user = new User;
                $transaction = new Transaction;

                $material_type_list = $material_type->getMaterialTypeList();
                $transaction_list = $transaction->getTransactionByAddedId();
                $user_list = $user->getUserListByType('Client')->where('is_verified',1);

                return view('transactions.create_transaction',[

                    'material_types'        => $material_type_list,
                    'user_list'             => $user_list,
                    'transaction_list'      => $transaction_list

                ]);
            }
            return $data;

        }
        catch(Exception $e)
        {

        }

    }
}
