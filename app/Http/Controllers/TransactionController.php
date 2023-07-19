<?php

namespace App\Http\Controllers;

use App\Models\MaterialType;
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

    public function storeTransaction(Request $request)
    {
        try
        {
            if($request->isMethod('post'))
            {

            }
            else
            {
                $material_type = new MaterialType;

                $material_type_list = $material_type->getMaterialTypeList();

                return view('transactions.create_transaction',[
                    'material_types'  => $material_type_list
                ]);
            }

        }
        catch(Exception $e)
        {

        }

    }
}
