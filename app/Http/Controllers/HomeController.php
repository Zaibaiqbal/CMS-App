<?php

namespace App\Http\Controllers;

use App\Models\SurchargeHstPercentage;
use App\Models\TicketIssue;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = new User;
        $transaction = new Transaction;
        $user_list = $user->getUserListByCondition(['user_type'=>'Client']);
        $condition = [];
        if(!Auth::user()->hasRole(['Super Admin']))
        {
            $condition =['added_id'    =>   Auth::user()->id];
        }
        $total_transactions = $transaction->getTransactionsByCondition($condition+['status'=>'Processed']);


        return view('home',[
            'client_count'          =>   $user_list->count(),
            'total_transactions'    =>   $total_transactions->count(),
            'inbound_count'          =>   $total_transactions->where('operation_type','Inbound')->count(),
            'outbound_count'          =>   $total_transactions->where('operation_type','Outbound')->count(),
        ]);
    }

    public function viewSetting()
    {

        $user = new User;
        $surcharge_hst = new SurchargeHstPercentage;
        $user_list = $user->getUserListByCondition(['user_type'=>'Client']);
        $surcharge_hst = $surcharge_hst->getSurchargeHstPer();

        return view('user_settings',[
            'user'          => Auth::user()->id,
            'user_list'     =>    $user_list,
            'surcharge_hst'     =>   $surcharge_hst
        ]);

    }


    public function storeSurcharge(Request $request)
    {

        $data = ['status' => false, 'message' => ''];

        $request->validate([
    
            // 'client'                     => 'required',
            'hst_per'                     => 'required|gte:0',
            'surcharge'                   => 'required|gte:0',
        
            ]);

           $form_data = $request->input();
           
           $surcharge_hst = new SurchargeHstPercentage;
           $surcharge_hst = $surcharge_hst->storeSurcharge($form_data);

           if(isset($surcharge_hst->id))
           {
              return redirect()->back()->with('Percentage added successfully');
           }

           return redirect()->back();
    }
    
    public function getMaterialWiseStats(Request $request)
    {

        $transaction = new Transaction;
        $condition = [];

        if(!Auth::user()->hasRole(['Super Admin']))
        {
            $condition =['added_id'    =>   Auth::user()->id];
        }
        $material_wise_transaction_list = $transaction->getDailyMaterialWiseStats($condition);
// dd($material_wise_transaction_list);
        $data['transaction_view'] =  view('dashboard.components.material_wise_stats',[
        
            'material_wise_transaction_list'          =>      $material_wise_transaction_list
        
            ])->render();
        
        return $data;

    }

    public function showLatestDashboardStats(Request $request)
    {

        $user = new User;
        $transaction = new Transaction;
        $user_list = $user->getUserListByCondition(['user_type'=>'Client']);
        $condition = [];
        if(!Auth::user()->hasRole(['Super Admin']))
        {
            $condition =['added_id'    =>   Auth::user()->id];
        }

        $transactions_list = $transaction->getDashboardTransactionsByCondition($condition+['status'=>'Processed'],$request->from,$request->to);
        $material_wise_transaction_list = $transaction->getDailyMaterialWiseStats($condition,$request->from,$request->to);

// dd($transactions_list);
        $data['total_clients' ]        =   $user_list->count();
        $data['total_tickets']    =   $transactions_list->count();
        $data['inbound_count' ]        =   $transactions_list->where('operation_type','Inbound')->count();
        $data['outbound_count']        =   $transactions_list->where('operation_type','Outbound')->count();
        $data['transaction_view'] =  view('dashboard.components.material_wise_stats',[
        
            'material_wise_transaction_list'          =>      $material_wise_transaction_list
        
            ])->render();

        return $data;

    }

    public function storeTicketIssue(Request $request)
    {
        try
            {
                $data = ['status' => false, 'message' => ''];

                if($request->isMethod('post'))
                {

                    // dd($request->input());
                   
                    $request->validate([

                        'transaction_id'                  => 'required',
                        'ticket_number'                   => 'required',
                        'issue'                           => 'required',                    
                    ]);

                    $form_data   =  $request->input();

                    $ticket_issue = new TicketIssue;

                    $ticket_issue = $ticket_issue->storeTicketIssue($form_data);


                    if(isset($ticket_issue->id))
                    {

                        // dd($ticket_issue->id);

                        $user = new User;

                        $user_ids = $user->getUserIdsByPermissions(['All','View Ticket Issues']);
            
                        $user = $user->getUserById(Auth::user()->id);
                        

                        $message = 'An issue has been reported against Ticket Number '.$form_data['ticket_number'];

                        event(new \App\Events\SendNotification($user->id, $user_ids, '', 'viewticketissues', 0 , $message, now() ));

                        return ['status' => true, 'message' => 'Issue reported successfully.'];
  

                    }

                }
               
            }

        
        catch(Exception $e)
            {

            }

        
        return redirect()->back();

    }

    public function viewTicketIssues(Request $request)
    {
        try
        {
            $ticket_issue = new TicketIssue;
            $ticket_issue_list = $ticket_issue->getPendingIssues();

            return view('ticket_issues.view_ticket_issues',[
            
                'ticket_issue_list'   =>  $ticket_issue_list
            ]);

        }
        catch(Exception $e)
        {

        }

    }

}
