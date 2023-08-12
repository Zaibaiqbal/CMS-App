<?php

namespace App\Http\Controllers;

use App\Models\MaterialType;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {

        $transactions_list = Transaction::get();
        return view('transactions.manage_transactions',[
            'transaction_list'  =>  $transactions_list
        ]);
    }

    public function clientTransactionList()
    {

        $transaction = new Transaction;

        $transaction_list = $transaction->getTransactionsByUserId(Auth::user()->id);

        return view('clients.client_transactions.manage_client_transactions',[
            'transaction_list'  =>  $transaction_list
        ]);
    }

    
    public function storeTransaction(Request $request)
    {
        try
        {
            $data = ['status' => false, 'message' => ''];

            if($request->isMethod('post'))
            {

                if($request->operation_type == "Inbound")
                {
                    $validation = [
                        'gross_weight'   =>   'required|gt:0'
                    ];

                }
                if($request->operation_type == "Outbound")
                {
                    $validation = [
                        'tare_weight'   =>   'required|gt:0'
                    ];
                }


                $request->validate($validation+[

                    'user_id'                  => 'required|exists:users,id',
                    'account'                 => 'required',
                    'driver_name'                   => 'required|max:255|min:0',
                    'plate_no'                => 'required|max:255|min:0',
                    'operation_type'                => 'required',
                   
                ]);
                $form_data   =  $request->input();

                // $form_data['material_type']   = decrypt($form_data['material_type']);
                // $form_data['user_id']   = decrypt($form_data['user_id']);

                // if(isset($form_data['truck_id']))
                // {
                //     $form_data['truck_id']   = decrypt($form_data['truck_id']);


                // }

                $form_data['account_id']   = decrypt($form_data['account']);

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
                    'transaction_list'      => $transaction_list->where('status','Open')

                ]);
            }
            return $data;

        }
        catch(Exception $e)
        {

        }

    }

    public function updateTransaction(Request $request)
    {
        try
        {
            $data = ['status' => false, 'message' => ''];

            if($request->isMethod('post'))
            {

                $request->validate([

                    'transaction_id'                  => 'required',
                    'material_type'                     => 'required',
                   
                ]);

                $form_data   =  $request->input();
// dd($form_data);
                $form_data['material_type']   = decrypt($form_data['material_type']);
               
                $form_data['transaction_id']   = decrypt($form_data['transaction_id']);

                $transaction = new Transaction;

                $transaction = $transaction->updateTransaction($form_data);

                if(isset($transaction->id))
                {
                    $data = ['status' => true, 'message' => 'Transaction updated successfully'];
                 
                }


            }
            else
            {
                $material_type = new MaterialType;
                $user = new User;
                $transaction = new Transaction;

                $material_type_list = $material_type->getMaterialTypeList();
                $transaction_list = $transaction->getTransactionByAddedId();

                $transaction = $transaction->getTransactionById(decrypt($request->id));
                
                return view('transactions.modals.update_transaction',[

                    'material_types'        => $material_type_list,
                    'transaction'      => $transaction

                ]);
            }
            return $data;

        }
        catch(Exception $e)
        {

        }

    }


}


