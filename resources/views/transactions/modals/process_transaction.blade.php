

<!-- Modal -->
<div class="modal fade" id="modal_process_transaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Process Transaction</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'process.transaction', 'class' => '', 'id' => 'form_process_transaction')) }}


      <div class="modal-body">
               
        <div class="card">

          <div class="card-body">
            <div class="row">
                <div class="col-md-12 job_id" style="display: none;">
                        @php($label = 'Job Id / PO Number')
                        @php($name = 'job_id')
                        <label for="">{{$label}} <span class="text-danger"></span> </label>
                        <small class="text-danger" id="{{$name}}_error"></small>
                    <div class="input-group">

                        <input type="text" value="" name="{{$name}}"  placeholder="{{$label}}"  class="form-control" id="">
                    </div>


                </div>
                <div @if($transaction->is_identified > 0) class="col-md-6" @else class="col-md-6" @endif>
                        @php($label = 'License No')
                        @php($name = 'plate_no')
                        <label for="">{{$label}} <span class="text-danger">*</span> </label>
                        <small class="text-danger" id="{{$name}}_error"></small>
                    <div class="input-group">

                        <input type="text" value="{{$transaction->plate_no}}" name="{{$name}}"  placeholder="{{$label}}" onkeyup="autoSearchPlateNo(event,'plate_no_tag')" class="form-control auto_search_plate_no" id="" readonly>
                    </div>


                </div>
                @if($transaction->is_identified > 0)
                    <div class="col-md-6">
                            @php($label = 'Select Client')
                            @php($name = 'truck')
                            <label for="">{{$label}} <span class="text-danger">*</span> </label>
                            <small class="text-danger" id="{{$name}}_error"></small>
                            <div class="input-group">

                                <select name="{{$name}}" id="" class="form-control fstdropdown-select" onchange="getClientAccountList(event,this)" >
                                <option value="">{{$label}}</option>
                                
                                @foreach($truck_list as $rows)
                                    <option value="{{$rows->id}}">{{$rows->identifier}}</option>
                                @endforeach
                                </select>
                            </div>

                    </div>
                @endif
                @if($transaction->client_group != 'Cash Account')
                <div class="col-md-6">
                    @php($label = 'Select Account')
                    @php($name = 'account')

                    <label for="">{{$label}} <span class="text-danger">*</span> </label>
                    <small class="text-danger" id="{{$name}}_error"></small>
                    <div class="input-group">

                    <select name="{{$name}}" id="" class="form-control fstdropdown-select account_list" onchange="getAccountInfo(event)" @if($transaction->client_group== 'Cash Account') disabled @else class="form-control fstdropdown-select" @endif>
                   <option value="">{{$label}}</option>
                    @foreach($account_list as $rows)
                        <option value="{{encrypt($rows->id)}}">{{$rows->account_no}} - {{$rows->title}}</option>
                    @endforeach
                    </select>



                    </div>
                </div>
                @endif
                <div class="col-md-4">
                        @php($label = 'Client')
                        @php($name = 'client')

                        <label for="">{{$label}} <span class="text-danger">*</span> </label>
                        <small class="text-danger" id="{{$name}}_error"></small>
                        <div class="input-group">
                        <input type="text" name="{{$name}}" class="form-control name auto_search_client_name client" onkeyup="autoSearchClientName(event,'client_name_tag')" value="{{$transaction->client_name}}" id="" placeholder="{{$label}}">
                        <input type="hidden"  value="{{$transaction->client_id}}" name="user_id"  class="user_id">

                    </div>
                </div>

                <div class="col-md-4 mb-2">

                        @php($label = 'Contact')
                        @php($name = 'contact_no')
                        <label for="">{{$label}} <span class="text-danger">*</span> </label>
                        <small class="text-danger" id="{{$name}}_error"></small>

                        <input type="text" name="{{$name}}" value="{{$transaction->contact_no}}" class="form-control contact_no" id="" placeholder="0000-0000000" data-mask="0000-000000">


                </div>

                <div class="col-md-4 mb-2">

                @php($label = 'Group Type')
                @php($name = 'client_group')
                <label for="">{{$label}} <span class="text-danger">*</span> </label>
                <small class="text-danger" id="{{$name}}_error"></small>

                <input type="text" name="{{$name}}" value="{{$transaction->client_group}}" class="form-control client_group" id="" readonly >


                </div>
            
                <div class="col-md-4 mb-2">

                    @php($label = 'Select Material')
                    @php($name = 'material')
                    <label for="">{{$label}} <span class="text-danger">*</span> </label>
                    <small class="text-danger" id="{{$name}}_error"></small>

                    <select name="{{$name}}" id="" class="form-control material_list" onchange="getMaterialRate(event,this)">

                        <option value="">{{$label}}</option>
                        @foreach($material_types as $rows)
                            <option  value="{{encrypt($rows->id)}}" >{{$rows->name}}</option>
                        @endforeach
                    </select>

                </div>


                @if($transaction->client_group == "Cash Account")
                <div class="col-md-4 mb-2">

                @php($label = 'Material Rate')
                    @php($name = 'material_rate')
                    <label id="gross_label" for="">{{$label}} <span class="text-danger">*</span> </label>
                    <small class="text-danger" id="{{$name}}_error"></small>

                    <input type="text" readonly name="{{$name}}" class="form-control material_rate"  placeholder="{{$label}}" >

                </div>
                @endif

                <div class="col-md-4 mb-2">

                    @php($label = 'Operation')
                    @php($name = 'operation_type')
                    <label for="">{{$label}} <span class="text-danger"></span> </label>
                    <small class="text-danger" id="{{$name}}_error"></small>

                    <input type="text" value="" readonly class="form-control operation_type">
                   

                </div>

            
                <div class="col-md-4 mb-2">

                    @php($label = 'In-Weight')
                        @php($name = 'inweight')
                        <label id="gross_label" for="">{{$label}} <span class="text-danger">*</span> </label>
                        <small class="text-danger" id="{{$name}}_error"></small>

                        <input type="text" onchange="calculateNetWeight(event,this)" name="{{$name}}" class="form-control" id="gross_input" placeholder="{{$label}}" value="{{$transaction->gross_weight}}">

                </div>
                <div class="col-md-4 mb-2">

                    @php($label = 'Out-Weight')
                    @php($name = 'outweight')
                    <label for="" id="tare_label">{{$label}} <span class="text-danger">*</span> </label>
                    <small class="text-danger" id="{{$name}}_error"></small>

                    <input type="text" name="{{$name}}" class="form-control" onchange="calculateNetWeight(event,this)" id="tare_input" placeholder="{{$label}}" value="{{$transaction->tare_weight}}">


                </div>

                <div class="col-md-4 mb-2">

                    @php($label = 'Net-weight')
                    @php($name = 'net_weight')
                    <label for="">{{$label}} <span class="text-danger"></span> </label>
                    <small class="text-danger" id="{{$name}}_error"></small>

                    <input type="text" readonly name="{{$name}}" value="{{$transaction->net_weight}}" class="form-control net_weight" id="" placeholder="{{$label}}">


                </div>
                @if($transaction->client_group == "Cash Account")

                <div class="col-md-4 mb-2">

                    @php($label = 'Mode of Payment')
                    @php($name = 'mode_of_payment')
                    <label for="">{{$label}} <span class="text-danger"></span> </label>
                    <small class="text-danger" id="{{$name}}_error"></small>

                   <select name="{{$name}}" class="form-control form-control-sm" id="" onchange="showModeofPayment(event,this)">
                        
                        <option value="0">{{$label}}</option>

                        @foreach(['Cash','Passes','Debit/Credit'] as $rows)
                        <option value="{{$rows}}">{{$rows}}</option>
                        @endforeach
                   </select>


                </div>

                <div class="col-md-6 mb-2 pass_no_section" style="display: none;">

                @php($label = 'Pass No.')
                @php($name = 'pass_no')
                <label for="">{{$label}} <span class="text-danger">*</span> </label>
                <small class="text-danger" id="{{$name}}_error"></small>

                    <input type="text" value="" name="{{$name}}" class="form-control" placeholder="{{$label}}">
                </div>
                
                <div class="col-md-6 mb-2 pass_no_section" style="display: none;">

                @php($label = 'No. of Passes Used:')
                @php($name = 'no_of_passes')
                <label for="">{{$label}} <span class="text-danger">*</span> </label>
                <small class="text-danger" id="{{$name}}_error"></small>

                    <input type="text" value="" name="{{$name}}" class="form-control" placeholder="{{$label}}">
                </div>
                @endif

                <div class="col-md-12">
                    @php($label = 'Driver Name')
                    @php($name = 'driver_name')
                    <div class="form-group">
                        <label for="">{{$label}}</label>
                        <span><i class="text-danger"></i></span>
                        <small id="{{$name}}_error" class="text-danger">*</small>

                        <input type="text" value="" name="{{$name}}" class="form-control" placeholder="{{$label}}">
                    </div>
                </div>

                <div class="col-md-12">
                    @php($label = 'Note')
                    @php($name = 'note')
                    <div class="form-group">
                        <label for="">{{$label}}</label>
                        <textarea type="text" name="{{$name}}" class="form-control" cols="40" rows="3" placeholder="{{$label}}"></textarea>
                    </div>
                </div>

            
        </div>

          </div>
            <!-- /.card-body -->
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="transaction_id" value="{{encrypt($transaction->id)}}">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Process</button>
      </div>
      {{ Form::close() }}

    </div>
  </div>
</div>

<script>
    setFstDropdown();

    function autoSearchClientName(event,tag)
    {
        event.preventDefault();

        var route = "{{ route('searchclientbyname') }}";

        $('input.auto_search_client_name').autocomplete({
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
                                label: item.client_name,
                                label1: item.contact_no,

                              
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
              
                $('.auto_search_client_name').val(i.item.label).attr('readonly',true);
                $('.contact_no').val(i.item.label1).attr('readonly',true);
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


function calculateNetWeight(event,obj)
    {
        event.preventDefault();

        var inweight =  $("input[name=inweight]").val();
        var outweight =  $("input[name=outweight]").val();

        var net_weight = 0;

      
        net_weight =  inweight - outweight;
            

        if(net_weight < 0)
        {
            $('.operation_type').val('Outbound');
            $('.job_id').hide();

        }
        if(net_weight > 0)
        {
            $('.operation_type').val('Inbound');
            $('.job_id').show();
        }
            $('.net_weight').val(net_weight);

    }

    function getMaterialRate(event,obj)
    {
        event.preventDefault();

        var material = $(obj).val();
        var client_type = "{{$transaction->client_group}}";
        var account_id = $('select[name=account]').val();
        addThemeLoader();

        $.get("{{route('materialinfo')}}",{material:material,client_type,client_type,account_id,account_id},function(data){

            $('.material_rate').val(data.rate);

            removeThemeLoader();

        });

    }

    function getAccountInfo(event)
    {
        event.preventDefault();

        var account = $('select[name=account]').val();
        addThemeLoader();
    
        $.get("{{route('accountinfo')}}",{account:account},function(data){

            $('.client_group').val(data.client_group);
            $('.material_list').html(data.view);

            removeThemeLoader();

        });

    }
    
    function getClientAccountList(event,obj)
    {
        event.preventDefault();

        
        var truck = "{{$transaction->truck_id}}";

        if(truck > 0)
        {
            var truck_id = truck;
        }
        else
        {
            var truck_id   = $(obj).val();
        }

        addThemeLoader();
    
        $.get("{{route('clientaccountlist')}}",{truck_id:truck_id},function(data){

            $('.client').val(data.client_name).attr('readonly',true);
            $('.contact_no').val(data.contact).attr('readonly',true);
            $('.account_list').html(data.view);

            setFstDropdown();


            document.querySelector('.account_list').fstdropdown.rebind();
            removeThemeLoader();

        });

    }



    function showModeofPayment(event,obj)
    {
        event.preventDefault();

        var mode_of_payment = $(obj).val();

        if(mode_of_payment == 'Passes')
        {
            $('.pass_no_section').show();
        }
       else
       {
        $('.pass_no_section').hide();

       }

    }
    
    

</script>