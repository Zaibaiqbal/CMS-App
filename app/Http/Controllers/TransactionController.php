<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {

        $transactions_list = Transaction::get();
        return view('transactions.manage_transactions',[
            'transactions_list'  =>  $transactions_list
        ]);
    }
}
