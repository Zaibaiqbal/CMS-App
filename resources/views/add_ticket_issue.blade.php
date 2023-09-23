@extends('layouts.master')
@section('page_style')

<style>

ul .ui-menu .ui-widget .ui-widget-content .ui-autocomplete .ui-front{
    width: auto !important;
    background-color: #eaeaf2 !important;

}

.custom-autocomplete-list {
    /* Add your custom styles here */
    /* For example: */
    background-color: #f2f2f2;
    border: 1px solid #ccc;
    list-style: none;
    padding: 0;
    width: 16% !important;
  }

  .custom-autocomplete-list li {
    /* Add your custom styles for each list item here */
    /* For example: */
    padding: 5px;
    cursor: pointer;
  }

  .custom-autocomplete-list li:hover {
    background-color: #ddd;
  }

</style>
@endsection

@section('page_breadcrumbs')

@endsection


@section('page_body')

<div class="row">
<div class="col-md-5 col-xl-12">

            <div class="card">
                <div class="card-header">
                <h5 class="card-title">Report Ticket Issue</h5>

                </div>
                <div class="card-body">
                {{ Form::open(array('route' => 'ticketissue', 'class' => '', 'id' => 'form_ticket_issue')) }}

                    <div class="row">

                        <div class="col-md-12">
                            @php($label = 'Ticket Number')
                            @php($name = 'ticket_number')
                            <label for="">{{$label}} <span class="text-danger">*</span> </label>
                            <small class="text-danger" id="{{$name}}_error"></small>
                            <div class="input-group">
                                <input type="text" name="{{$name}}"  placeholder="{{$label}}" onkeyup="autoSearchTicketNumber(event,'ticket_number_tag')" class="form-control auto_search_ticket_number" id="">
                            </div>
                        </div>
      
                    </div>

                    <div class="row">
                        <div class="col-md-12">
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

  
</div>
</div>


@endsection

@section('page_script')


<script>
      function autoSearchTicketNumber(event,tag)
    {
        event.preventDefault();

        var route = "{{ route('autosearchticketnumber') }}";

        $('input.auto_search_ticket_number').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: route,
                    type: "GET",
                    data: {
                        search: request.term,
                    },
                    contentType: "json",
                    success: function (data) {

                        response($.map(JSON.parse(data), function (item) {

                            return {
                                label: item.ticket_no,  
                                val:    item.id,                           
                            }
                        }))
                    },
                    error: function (response) {
                        alert(response.responseText);
                    },
                    failure: function (response) {
                        alert(response.responseText);
                    }
                });
            },
            select: function (e, i) {
              
                $('.auto_search_ticket_number').val(i.item.label).attr('readonly',true);
                $('.transaction_id').val(i.item.val);

            },
            open: function() {
        // Get the autocomplete list element
                var autocompleteList = $(this).autocomplete("widget");

                // Add custom CSS class to the list element
                autocompleteList.addClass("custom-autocomplete-list");
            },
            minLength: 1
        });
    }

</script>
@endsection