<?php

namespace App\Http\Controllers;

use App\Models\MaterialType;
use App\Models\Transaction;
use App\Models\Truck;
use App\Models\User;
use App\Models\UserAccount;
use Dompdf\Dompdf;
use Dompdf\Options;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class TransactionController extends Controller
{
    public function index()
    {

        $transaction = new Transaction;
        if(!Auth::user()->hasRole(['Super Admin']))
        {
            $transactions_list =  $transaction->getTransactionsByCondition(['added_id' => Auth::user()->id]);

        }
        else
        {
            $transactions_list =  $transaction->getTransactionsByCondition();

        }


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


    public function autoSearchByClientName(Request $request)
    {

        try
        {

            $data = Transaction::selectRaw("client_name,contact_no")
                    ->where('client_name', 'LIKE', '%'. $request->search. '%')
                    ->whereNull('client_id')
                    ->get();
        return json_encode($data);

        }
        catch(Exception $e)
        {

        }

    }
    
    public function storeTransaction(Request $request)
    {
        try
        {
            $data = ['status' => false, 'message' => ''];

            if($request->isMethod('post'))
            {
                $validation = [];
                // $client_group = ['Cash Account','Numbered Account','Partner Account'];

                // $validation = [
                //     'client_group'  =>  'in:'.implode(',',$client_group)
                // ];

                if(!isset($request->is_identified))
                {
                    if(!isset($request->user_id) && !isset($request->truck_id))
                    {

                        $validation += [
                            'client'        =>   'nullable|max:255',
                            'contact_no'   =>   'nullable|max:255'
                        ]; 
                    }
                    else
                    {
                         $validation += [
                            'client'        =>   'required|max:255',
                            'contact_no'   =>   'required|max:255'
                        ]; 
                    }
                
                
                }
       
// dd($validation);
                $request->validate($validation+[

                 
                    // 'account'                 => 'required',
                    'plate_no'                => 'required|max:255|min:0',
                    // 'operation_type'                => 'required',
                    'inweight'                =>   'required|gte:0',
                    'vehicle_descp'           =>    'nullable|max:255'

                   
                ]);
                $form_data   =  $request->input();

                if(!isset($request->is_identified))
                {
                    if(!isset($request->user_id))
                    {
                       $form_data['client_group'] = 'Cash Account';
                    }
                  
                }
                else
                {
                    $form_data['client_group'] = 'Numbered Clients';

                }

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
                // dd($transaction_list);
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
            dd($e);
        }

    }



    public function printTransactionInvoice(Request $request)
        {
            try {


                    if(isset($request->pdf)){

                        $transaction = new Transaction;
                        $transaction = $transaction->getTransactionById($request->transaction);

                        if($transaction->client_group == 'Numbered Clients')
                        {
 
                            $pdf = PDF::loadView('transactions.documents.numbered_clients_invoice', [
                                'format'        => false,
                                'transaction'     =>   $transaction
                                ]);

                            return $pdf->setPaper('a4', 'portrait')->stream('Invoice.pdf');

                        }
                        elseif($transaction->client_group == 'Cash Account' && $transaction->payment->mode_of_payment == 'Cash')
                        {

                            $pdf = PDF::loadView('transactions.documents.cash_payment_invoice', [
                                'format'        => false,
                                'transaction'     =>   $transaction
                                ]);

                            return $pdf->setPaper('a4', 'portrait')->stream('Cash Payment Invoice.pdf');
 
                        }
                        elseif($transaction->client_group == 'Cash Account' && $transaction->payment->mode_of_payment == 'Cash + Pass')
                        {
                           

                                $pdf = PDF::loadView('transactions.documents.cash_pass_payment_invoice', [
                                    'format'            => false,
                                    'transaction'       =>   $transaction
                                    ]);
    
                                return $pdf->setPaper('a4', 'portrait')->stream('Cash Pass Payment .pdf');
     
                        }
                        elseif($transaction->client_group == 'Cash Account' && $transaction->payment->mode_of_payment == 'Pass')
                        {
                            $pdf = PDF::loadView('transactions.documents.pass_payment_invoice', [
                                'format'            => false,
                                'transaction'       =>   $transaction
                                ]);

                            return $pdf->setPaper('a4', 'portrait')->stream('Pass Payment .pdf');
 
                        
                        }
                    
                    }
               

            }
            catch (DecryptException $e)
            {
                parent::errorMessage('No such record found.');

                return redirect()->back();
            }

        }

        

        public function processTransaction(Request $request)
        {
           
                $data = ['status' => false, 'message' => ''];
    
                if($request->isMethod('post'))
                {
                    $payment_mode_list = implode(',', ['Cash','Pass','Debit/Credit','Cash + Pass']);

                    $transaction = new Transaction;
                    $transaction = $transaction->getTransactionById(decrypt($request->transaction_id));
                    
                    $validation = [];

                    if($transaction->client_group == "Numbered Clients")
                    {
                        $validation += [
                            'account'    => 'required'
                        ];

                    }
                    if($transaction->client_group == "Cash Account")
                    { 
                        $validation += [
                            'mode_of_payment'    => 'required|In:'.$payment_mode_list,
                         
                        ];

                        if($request->mode_of_payment == 'Cash' || $request->mode_of_payment == 'Cash + Pass')
                        {
                            $validation += [
                                'received_amount'             =>   'required|gt:0|lte:'.$request->total_amount,
                            ];
                        }


                    }
                    if($request->mode_of_payment == 'Pass' || $request->mode_of_payment == 'Cash + Pass')
                    {
                        $validation += [
                            'pass_no'                   => 'required|min:0|max:15',
                            'optional_pass_no'          => 'nullable|min:0|max:15',
                        ];

                    }

                    if($transaction->is_identified > 0)
                    {
                        $validation += [
                            'truck'    => 'required'
                        ];
                    }
                    $request->validate($validation+[
    
                        'transaction_id'                    => 'required',
                        'material'                          => 'required',
                        'driver_name'                       => 'required|max:255|min:0',

                       
                    ]);
    
                    $form_data   =  $request->input();
    
                    $form_data['material_type']   = decrypt($form_data['material']);
                   
                    $form_data['transaction_id']   = decrypt($form_data['transaction_id']);

                    if(isset($form_data['account']))
                    {
                        $form_data['account']   = decrypt($form_data['account']);

                    }

                    if(isset($form_data['truck']))
                    {
                        $form_data['truck_id']   = $form_data['truck'];

                    }
                    $transaction = new Transaction;
    
                    $transaction = $transaction->processTransaction($form_data);
    
                    if(isset($transaction->id))
                    {
                       
                       if(isset($transaction->client->id) && $transaction->client->client_group == 'GFL')
                       {
                            return redirect()->back()->with('success','Transaction closed successfully');

                       }
                       elseif(isset($transaction->client->id) && $transaction->client->client_group == 'Numbered Clients')
                       {

                            return view('transactions.documents.numbered_clients_invoice', [

                                'transaction'  =>   $transaction,
                                'format'    =>    true

                            ])->render();

                       }
                       elseif($transaction->client_group == 'Cash Account' && $transaction->payment->mode_of_payment == 'Cash')
                       {


                            return view('transactions.documents.cash_payment_invoice', [

                                'transaction'  =>   $transaction,
                                'format'    =>    true

                            ])->render();
                       }
                       elseif($transaction->client_group == 'Cash Account' && $transaction->payment->mode_of_payment == 'Pass')
                       {
                                
                        return view('transactions.documents.pass_payment_invoice', [
                            'format'            => true,
                            'transaction'       =>   $transaction
                        ]);
    
     
                           
                       }
                       elseif($transaction->client_group == 'Cash Account' && $transaction->payment->mode_of_payment == 'Cash + Pass')
                       {
                        return view('transactions.documents.cash_pass_payment_invoice', [

                            'transaction'  =>   $transaction,
                            'format'    =>    true

                        ])->render();
                       }
    
    
                    }

                    return redirect()->back()->with('success','Transaction closed successfully');

                }
                else
                {
                    $material_type = new MaterialType;
                    $user = new User;
                    $transaction_obj = new Transaction;
                    $truck = new Truck;
    
                    // $transaction_list = $transaction->getTransactionByAddedId();
                    $transaction = $transaction_obj->getTransactionById(decrypt($request->id));
                    $truck_list = $truck->getTruckListByPlateNo($transaction->plate_no);
                    $user_account = new UserAccount;
                    $account_list = $user_account->getAccountListByClientId($transaction->client_id);

                    $material_type_list = $material_type->getMaterialTypeList();
    
    
                    
                    return view('transactions.modals.process_transaction',[
    
                        'material_types'        => $material_type_list,
                        'transaction'           => $transaction,
                        'account_list'          =>   $account_list,
                        'truck_list'            =>   $truck_list,

    
                    ]);
                }
       
    
        
        return redirect()->back();
    
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
                    
                    // dd($transaction);
                    $validation = [];

                    if($transaction->client_group == "Numbered Clients")
                    {
                        $validation += [
                            'account'    => 'required'
                        ];

                    }
                    if($transaction->is_identified > 0)
                    {
                        $validation += [
                            'truck'    => 'required'
                        ];
                    }
                    $request->validate($validation+[
    
                        'transaction_id'                  => 'required',
                        'material'                        => 'required',
                        'driver_name'                     => 'required|max:255|min:0',
                    ]);
    
                    $form_data   =  $request->input();
    // dd($form_data);
                    $form_data['material_type']   = decrypt($form_data['material']);
                   
                    $form_data['transaction_id']   = decrypt($form_data['transaction_id']);

                    if(isset($form_data['account']))
                    {
                        $form_data['account']   = decrypt($form_data['account']);

                    }

                    if(isset($form_data['truck']))
                    {
                        $form_data['truck_id']   = decrypt($form_data['truck']);

                    }
    
                    $transaction = new Transaction;
    
                    $transaction = $transaction->updateTransaction($form_data);
    
                    // if(isset($transaction->id))
                    // {
                       
                          
                    //     return view('transactions.documents.invoice', [

                    //         'transaction'  =>   $transaction,
                    //         'format'    =>    true

                    //     ])->render();
        
    
    
                    // }


                    $data = ['status' => true, 'message' => 'Transaction updated successfully'];
                    return $data;
                }
                else
                {
                    $material_type = new MaterialType;
                    $user = new User;
                    $transaction_obj = new Transaction;
                    $truck = new Truck;
    
                    $transaction = $transaction_obj->getTransactionById(decrypt($request->id));
                    $truck_list = $truck->getTruckListByPlateNo($transaction->plate_no);

                    $user_account = new UserAccount;
                    $account_list = $user_account->getAccountListByClientId($transaction->client_id);
    
                    $material_type_list = $material_type->getMaterialTypeList();
                        
                    return view('transactions.modals.update_transaction',[
    
                        'material_types'        => $material_type_list,
                        'transaction'           => $transaction,
                        'account_list'          =>   $account_list,
                        'truck_list'            =>   $truck_list,

    
                    ]);
                }
            }
    
        
        catch(Exception $e)
            {
    dd($e);
            }
    
        
        return redirect()->back();
    
    }

    public function autoSearchTicketNumber(Request $request)
    {

        try
        {
            $data = Transaction::where('transactions.ticket_no', 'LIKE', '%'. $request->search. '%')
                    ->get();
     
        return json_encode($data);

        }
        catch(Exception $e)
        {

        }

    }

    public function tableViewSession(Request $request)
    {
      
        $request->session()->put('change_view',$request->change_view);

        return $request->change_view;
    }

    public function voidTransaction(Request $request)
    {
        try
        {
            $transaction = new Transaction;
            $transaction = $transaction->getTransactionById(decrypt($request->id));

            if(isset($transaction->id) && $transaction->is_void == 0)
            {
                $transaction->is_void = 1;
                $transaction->update();

            }
        return redirect()->back()->with('Transaction updated successfully');


        }
        catch(Exception $e)
        {

        }

    }

}