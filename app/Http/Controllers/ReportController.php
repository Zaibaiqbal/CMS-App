<?php

namespace App\Http\Controllers;

use App\Mail\WeeklyInvoiceReportMail;
use App\Models\Transaction;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
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
                 
                    $pdf = PDF::loadView('transactions.documents.weekly_invoice', [
    
                        'transaction_list'  =>   $transaction_list,
                        'user'              =>   $user,
                        'format'            =>    false
        
                    ]);
                    $weekly_pdf_report = $pdf->output();

                    // Send the email with the PDF attached
                    \Mail::to($user->email)->send(new \App\Mail\WeeklyInvoiceReportMail($weekly_pdf_report));

                    // return $pdf->setPaper('a4', 'landscape')->download($user->name.' Weekly Invoice Report.pdf');
                }
           

            }
            else
            {
                $user_id = $request->id;

                $user = new User;
                $user = $user->getUserById($user_id);
                
                $transaction = new Transaction;
                $transaction_list = $transaction->getTransactionsByClientId($user->id);
    
    
                return view('transactions.documents.weekly_invoice', [
    
                    'transaction_list'  =>   $transaction_list,
                    'user'              =>   $user,
                    'format'            =>    true
    
                ])->render();
            }
       


        }
        catch(Exception $e)
        {

        }
    }
}
