<?php

namespace App\Http\Controllers;

use App\Mail\WeeklyInvoiceReportMail;
use App\Models\SurchargeHstPercentage;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class ReportController extends Controller
{

    public function index()
    {
        try{
            return view('reports.manage_reports');
        }
        catch(Exception $e)
        {

        }

    }

    public function viewWeeklyCustomerReport(Request $request)
    {
        try
        {
            $condition = [];

            if($request->type == 'TOPPS')
            {
                $condition += ['Numbered Clients','TSC','Cash Account'];
            }
          
            if($request->type == 'GFL')
            {
                $condition += ['GFL'];
            }
            $transaction = new Transaction;
            $client_list = $transaction->getTransactionsClientList();
            // $transaction_list = $transaction->viewWeeklyCustomerReport($condition);

            // dd($transaction_list);
            $start_date = now()->startOfWeek(); 
            $end_date = now()->endOfWeek(); 

            $pdf = PDF::loadView('reports.view_weekly_customer_report', [

                'client_list'       =>   $client_list,
                'start_date'        =>   $start_date,
                'end_date'          =>   $end_date,
                'transaction'       =>  $transaction
            ]);
         
            return $pdf->setPaper('a4', 'landscape')->stream('Weekly Customer Report.pdf');
            // return redirect('users');

        }
 
        catch(Exception $e)
        {
dd($e);
        }
    }

    public function viewDailyCustomerReport(Request $request)
    {
        try
        {
            $client_group_condition = [];
            if($request->type == 'TOPPS')
            {
                $client_group_condition += ['Numbered Clients','TSC','Cash Account'];
            }
          
            if($request->type == 'GFL')
            {
                $client_group_condition += ['GFL'];
            }
            $transaction = new Transaction;
            $transaction_list = $transaction->viewDailyCustomerReport($client_group_condition);
            $material_wise_list = $transaction->getMaterialWiseStats($client_group_condition);

            
            $pdf = PDF::loadView('reports.view_daily_customer_report', [

                'transaction_list'    =>   $transaction_list,
                'material_wise_list'  =>   $material_wise_list,
             
            ]);
         
            return $pdf->setPaper('a4', 'landscape')->stream('Daily Customer Report.pdf');
            // return redirect('users');

        }
 
        catch(Exception $e)
        {
            dd($e);
        }
    }


    public function clientGroupReport(Request $request)
    {
        try
        {

            if($request->isMethod('post'))
            {
                $form_data = $request->input();

                $client_group = $form_data['client_group'];

                if(Auth::user()->hasRole('Super Admin'))
                {
                    $condition = [];
                }
                else
                {
                    $condition = ['added_id' => Auth::user()->id];
                }

                $transaction = new Transaction;
                $transaction_list = $transaction->viewClientGroupWiseTransactions($client_group,$condition);

                $pdf = PDF::loadView('reports.view_daily_customer_report', [
    
                    'transaction_list'    =>   $transaction_list,
                 
                ]);
             
                return $pdf->setPaper('a4', 'landscape')->stream('Daily Customer Report.pdf');
                // return redirect('users');
            }
            else
            {
                $user = new User;

                $group_list = $user->getDistinctClientGroupList()->pluck('client_group')->toArray();

                return view('reports.modals.client_group_report',[

                    'group_list'        =>   $group_list
                
                ])->render();
            }
    

        }
 
        catch(Exception $e)
        {
            dd($e);
        }
    }

    

    public function generateWeeklyInvoice(Request $request)
    {
        try
        {
            if($request->isMethod('post'))
            {
                if(isset($request->pdf))
                {

                    $user_id = $request->id;

                    $user = new User;
                    $user = $user->getUserById($user_id);
                    
                    $transaction = new Transaction;
                    $transaction_list = $transaction->getTransactionsByClientId($user->id);
        
                    $transaction = new Transaction;
                    $transaction = $transaction->getTransactionById($request->transaction);
                    $surcharge_hst = new SurchargeHstPercentage;
                    $surcharge_hst = $surcharge_hst->getSurchargeHstPer();
                    
                    $pdf = PDF::loadView('transactions.documents.weekly_invoice', [
    
                        'transaction_list'  =>   $transaction_list,
                        'user'              =>   $user,
                        'format'            =>    false,
                        'surcharge_hst'     =>   $surcharge_hst

        
                    ]);
                    $weekly_pdf_report = $pdf->output();

                    // Send the email with the PDF attached
                    // \Mail::to($user->email)->send(new \App\Mail\WeeklyInvoiceReportMail($weekly_pdf_report));

                    return $pdf->setPaper('a4', 'landscape')->stream($user->name.' Weekly Invoice Report.pdf');
                    // return redirect('users');

                }
           

            }
            else
            {
                $user_id = $request->id;

                $user = new User;
                $user = $user->getUserById($user_id);
                
                $transaction = new Transaction;
                $transaction_list = $transaction->getTransactionsByClientId($user->id);
    
                $surcharge_hst = new SurchargeHstPercentage;
                $surcharge_hst = $surcharge_hst->getSurchargeHstPer();
        
    
                return view('transactions.documents.weekly_invoice', [
    
                    'transaction_list'  =>   $transaction_list,
                    'user'              =>   $user,
                    'format'            =>    true,
                    'surcharge_hst'     =>   $surcharge_hst

    
                ])->render();
            }
       


        }
        catch(Exception $e)
        {

        }
    }
}
