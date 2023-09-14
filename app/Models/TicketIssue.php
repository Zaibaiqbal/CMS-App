<?php

namespace App\Models;

use DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketIssue extends Model
{
    use HasFactory;

    public function getPendingIssues()
    {
        return TicketIssue::where('status','Pending')->get();
    }
    public function storeTicketIssue($object)
    {
        return DB::transaction(function() use ($object){

            $ticket_issue = new TicketIssue;

            $ticket_issue->transaction_id   = $object['transaction_id'];

            $ticket_issue->ticket_number   = $object['ticket_number'];

            $ticket_issue->issue   = $object['issue'];

            $ticket_issue->save();

            return with($ticket_issue);

        });
    }
}
