<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psy\Readline\Transient;

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
        $total_transactions = $transaction->getTransactionsByCondition(['status'=>'Processed']);

        return view('home',[
            'client_count'          =>   $user_list->count(),
            'total_transactions'    =>   $total_transactions->count(),
            'inbound_count'          =>   $total_transactions->where('operation_type','Inbound')->count(),
            'outbound_count'          =>   $total_transactions->where('operation_type','Outbound')->count(),
        ]);
    }

    public function getMaterialWiseStats(Request $request)
    {

        $transaction = new Transaction();
        $daily_transaction_list = $transaction->getDailyMaterialWiseStats();
        $monthly_transaction_list = $transaction->getMonthlyMaterialWiseStats();

        $data['daily_view'] =  view('dashboard.components.material_wise_stats',[
        
            'transaction_list'          =>      $daily_transaction_list
        
            ])->render();
        
        $data['monthly_view'] =  view('dashboard.components.material_wise_stats',[
        
            'transaction_list'          =>      $monthly_transaction_list
        
            ])->render();
        
        return $data;

    }
}
