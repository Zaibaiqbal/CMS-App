<?php

namespace App\Http\Controllers;

use App\Mail\WeeklyInvoiceReportMail;
use App\Models\SurchargeHstPercentage;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
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

    

    public function viewDailyCustomerReport(Request $request)
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
            $transaction_list = $transaction->viewDailyCustomerReport($condition);

            // dd($transaction_list);
            $pdf = PDF::loadView('reports.view_daily_customer_report', [

                'transaction_list'  =>   $transaction_list,
             
            ]);
         
            return $pdf->setPaper('a4', 'landscape')->stream('Daily Customer Report.pdf');
            // return redirect('users');

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
                    \Mail::to($user->email)->send(new \App\Mail\WeeklyInvoiceReportMail($weekly_pdf_report));

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
