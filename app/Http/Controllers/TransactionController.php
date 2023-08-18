<?php

namespace App\Http\Controllers;

use App\Models\MaterialType;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

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
                if($request->client_type == "Cash Account")
                {
                    $validation = [
                        'client'        =>   'required|max:255',
                        'contact_no'   =>   'required|max:255'
                    ]; 
                }
                else
                {
                    $validation = [
                        'user_id'                  => 'required|exists:users,id',
                    ]; 
                }

                if($request->operation_type == "Inbound")
                {
                    $validation += [
                        'gross_weight'   =>   'required|gt:0'
                    ];

                }
                if($request->operation_type == "Outbound")
                {
                    $validation += [
                        'tare_weight'   =>   'required|gt:0'
                    ];
                }
// dd($validation);
                $request->validate($validation+[

                 
                    // 'account'                 => 'required',
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

                // $form_data['account_id']   = decrypt($form_data['account']);

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
                    'transaction_list'      => $transaction_list->where('status','Queued')

                ]);
            }
            return $data;

        }
        catch(Exception $e)
        {

        }

    }



    public function printTransactionInvoice(Request $request)
        {
            try {


                    if(isset($request->pdf)){

                        $transaction = new Transaction;
                        $transaction = $transaction->getTransactionById($request->transaction);
                        
                        $pdf = PDF::loadView('transactions.documents.invoice', [
                        'format'        => false,
                        'transaction'     =>   $transaction
                        ]);

                        return $pdf->setPaper('a4', 'landscape')->stream('Invoice.pdf');
                    }
               

            }
            catch (DecryptException $e)
            {
                parent::errorMessage('No such record found.');

                return redirect()->back();
            }

        }

        public function updateTransaction(Request $request)
        {
            try
            {
                $data = ['status' => false, 'message' => ''];
    
                if($request->isMethod('post'))
                {
                    $transaction = new Transaction;
                    $transaction = $transaction->getTransactionById(decrypt($request->transaction_id));
                    
                    $validation = [];
                    if($transaction->client_type == 'Numbered Client')
                    {

                        $validation = [
                            'account'    => 'required'
                        ];

                    }
                    // if($transaction->operation_type == "Inbound")
                    // {
                    //     $validation += [
                    //         'job_id'    => 'required|max:255'
                    //     ];
                    // }
    
                    $request->validate($validation+[
    
                        'transaction_id'                  => 'required',
                        'material_type'                     => 'required',
                        'driver_name'                   => 'required|max:255|min:0',

                       
                    ]);
// dd($validation);
    
                    $form_data   =  $request->input();
    
                    $form_data['material_type']   = decrypt($form_data['material_type']);
                   
                    $form_data['transaction_id']   = decrypt($form_data['transaction_id']);

                    if(isset($form_data['account']))
                    {
                        $form_data['account']   = decrypt($form_data['account']);

                    }
    
                    $transaction = new Transaction;
    
                    $transaction = $transaction->updateTransaction($form_data);
    
                    if(isset($transaction->id))
                    {
                       
                          
                        return view('transactions.documents.invoice', [

                            'transaction'  =>   $transaction,
                            'format'    =>    true

                        ])->render();
        
    
    
                    }
                }
                else
                {
                    $material_type = new MaterialType;
                    $user = new User;
                    $transaction = new Transaction;
    
                    $transaction_list = $transaction->getTransactionByAddedId();
                    $transaction = $transaction->getTransactionById(decrypt($request->id));
    
                    $user_account = new UserAccount;
                    $account_list = $user_account->getAccountListByClientId($transaction->client_id);
    
                    $material_type_list = $material_type->getMaterialTypeList();
    
    
                    
                    return view('transactions.modals.update_transaction',[
    
                        'material_types'        => $material_type_list,
                        'transaction'      => $transaction,
                        'account_list'     =>   $account_list
    
                    ]);
                }
            }
    
        
        catch(Exception $e)
            {
    
            }
    
        
    
    
    }


}