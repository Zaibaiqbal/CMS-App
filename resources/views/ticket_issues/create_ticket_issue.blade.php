<div class="tab-pane fade" id="ticket_issue" role="tabpanel">

<div class="card">
    <div class="card-header">
    <h5 class="card-title">Ticket Issue</h5>

    </div>
    <div class="card-body">
    {{ Form::open(array('route' => 'ticketissue', 'class' => '', 'id' => 'form_ticket_issue')) }}

        <div class="row">

            <div class="col-md-6">
                @php($label = 'Ticket Number')
                @php($name = 'ticket_number')
                <label for="">{{$label}} <span class="text-danger">*</span> </label>
                <small class="text-danger" id="{{$name}}_error"></small>
                <div class="input-group">
                    <input type="text" name="{{$name}}"  placeholder="{{$label}}" onkeyup="autoSearchTicketNumber(event,'ticket_number_tag')" class="form-control auto_search_ticket_number" id="">
                </div>
            </div>

            <div class="col-md-6">
                @php($label = 'Issue.')
                @php($name = 'issue')
                <div class="form-group">
                    <label for="">{{$label}}</label>
                    <textarea type="text" name="{{$name}}" class="form-control" cols="40" rows="2" placeholder="{{$label}}"></textarea>
                </div>
            </div>

            <input type="hidden" value="" name="transaction_id" class="transaction_id">
            
            
        </div>

        <div class="row">
            <div class="col-md-12">
            <button type="submit" onclick="submitModalForm(event,this,'#form_ticket_issue','')" class="btn btn-primary  my-3">Submit</button>
            </div>
        </div>

        {{ Form::close() }}

    </form>
    </div>
</div>
</div>