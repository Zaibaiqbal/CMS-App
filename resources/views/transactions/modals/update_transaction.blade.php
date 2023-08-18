

<!-- Modal -->
<div class="modal fade" id="modal_update_transaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Transaction</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'update.transaction', 'class' => '', 'id' => 'form_update_transaction')) }}


      <div class="modal-body">
               
        <div class="card">

          <div class="card-body">
            <div class="row">
            @if($transaction->operation_type == "Inbound")
                <div class="col-md-6">
                        @php($label = 'Job Id / PO Number')
                        @php($name = 'job_id')
                        <label for="">{{$label}} <span class="text-danger"></span> </label>
                        <small class="text-danger" id="{{$name}}_error"></small>
                    <div class="input-group">

                        <input type="text" value="" name="{{$name}}"  placeholder="{{$label}}"  class="form-control auto_search_plate_no" id="">
                    </div>


                </div>
                @endif
                <div @if($transaction->operation_type == "Inbound") class="col-md-6" @else class="col-md-12"  @endif>
                        @php($label = 'License Plate No')
                        @php($name = 'plate_no')
                        <label for="">{{$label}} <span class="text-danger">*</span> </label>
                        <small class="text-danger" id="{{$name}}_error"></small>
                    <div class="input-group">

                        <input type="hidden" name="truck_id" value="{{$transaction->truck_id}}" class="truck_id">

                        <input type="text" value="{{$transaction->plate_no}}" name="{{$name}}"  placeholder="{{$label}}" onkeyup="autoSearchPlateNo(event,'plate_no_tag')" class="form-control auto_search_plate_no" id="" readonly>
                    </div>


                </div>
            
                <div class="col-md-4">
                    @php($label = 'Select Account')
                    @php($name = 'account')

                    <label for="">{{$label}} <span class="text-danger">*</span> </label>
                    <small class="text-danger" id="{{$name}}_error"></small>
                    <div class="input-group">

                    <select name="{{$name}}" id="" class="form-control" @if($transaction->client_type == 'Cash Account') disabled @else class="form-control fstdropdown-select" @endif>
                    @foreach($account_list as $rows)
                        <option value="{{encrypt($rows->id)}}">{{$rows->account_no}} - {{$rows->title}}</option>
                    @endforeach
                    </select>



                    </div>
                </div>
                <div class="col-md-4">
                        @php($label = 'Client Name')
                        @php($name = 'client')

                        <label for="">{{$label}} <span class="text-danger">*</span> </label>
                        <small class="text-danger" id="{{$name}}_error"></small>
                        <div class="input-group">
                        <input type="text" readonly name="{{$name}}" class="form-control name auto_search_client_name" value="{{$transaction->client_name}}" id="" placeholder="{{$label}}">
                        <input type="hidden"  value="{{$transaction->client_id}}" name="user_id"  class="user_id">

                    </div>
                </div>

                <div class="col-md-4 mb-2">

                        @php($label = 'Contact')
                        @php($name = 'contact_no')
                        <label for="">{{$label}} <span class="text-danger">*</span> </label>
                        <small class="text-danger" id="{{$name}}_error"></small>

                        <input type="text" name="{{$name}}" value="{{$transaction->contact_no}}" readonly class="form-control contact" id="" placeholder="0000-0000000" data-mask="0000-000000">


                </div>
            
                <div class="col-md-4 mb-2">

                        @php($label = 'Select Material Type')
                        @php($name = 'material_type')
                        <label for="">{{$label}} <span class="text-danger">*</span> </label>
                        <small class="text-danger" id="{{$name}}_error"></small>

                        <select name="{{$name}}" id="" class="form-control fstdropdown-select" onchange="getMaterialRate(event,this)">

                            <option value="{{encrypt(0)}}">{{$label}}</option>
                            @foreach($material_types as $rows)
                                <option  value="{{encrypt($rows->id)}}" >{{$rows->name}}</option>
                            @endforeach
                        </select>

                </div>

                <div class="col-md-4 mb-2">

                    @php($label = 'Select Operation Type')
                    @php($name = 'operation_type')
                    @php($operation_types = ['Inbound','Outbound'])
                    <label for="">{{$label}} <span class="text-danger"></span> </label>
                    <small class="text-danger" id="{{$name}}_error"></small>

                    <select name="{{$name}}" id="" class="form-control operation_type" onchange="getWeightType(event,this)" disabled>
                        @foreach($operation_types as $rows)
                            <option @if($transaction->operation_type == $rows) selected value="{{$rows}}" @endif>{{$rows}}</option>
                        @endforeach
                    </select>

                </div>

                <div class="col-md-4 mb-2">

                @php($label = 'Material Rate')
                    @php($name = 'material_rate')
                    <label id="gross_label" for="">{{$label}} <span class="text-danger">*</span> </label>
                    <small class="text-danger" id="{{$name}}_error"></small>

                    <input type="text" readonly name="{{$name}}" class="form-control material_rate"  placeholder="{{$label}}" >

                </div>
            
                <div class="col-md-4 mb-2">

                    @php($label = 'Gross Weight')
                        @php($name = 'gross_weight')
                        <label id="gross_label" for="">{{$label}} <span class="text-danger">*</span> </label>
                        <small class="text-danger" id="{{$name}}_error"></small>

                        <input type="text" onkeyup="calculateNetWeight(event,this)" name="{{$name}}" class="form-control" id="gross_input" placeholder="{{$label}}" value="{{$transaction->gross_weight}}">

                </div>
                <div class="col-md-4 mb-2">

                    @php($label = 'Tare Weight')
                    @php($name = 'tare_weight')
                    <label for="" id="tare_label">{{$label}} <span class="text-danger">*</span> </label>
                    <small class="text-danger" id="{{$name}}_error"></small>

                    <input type="text" name="{{$name}}" class="form-control" onkeyup="calculateNetWeight(event,this)" id="tare_input" placeholder="{{$label}}" value="{{$transaction->tare_weight}}">


                </div>

                <div class="col-md-4 mb-2">

                    @php($label = 'Net-weight')
                    @php($name = 'net_weight')
                    <label for="">{{$label}} <span class="text-danger"></span> </label>
                    <small class="text-danger" id="{{$name}}_error"></small>

                    <input type="text" readonly name="{{$name}}" value="{{$transaction->net_weight}}" class="form-control net_weight" id="" placeholder="{{$label}}">


                </div>


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
                        <textarea type="text" name="{{$name}}" class="form-control" cols="40" rows="3" placeholder="{{$label}}">
                            {{$transaction->note}}
                            </textarea>
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
        <button type="submit" class="btn btn-primary">Processed</button>
      </div>
      {{ Form::close() }}

    </div>
  </div>
</div>

<script>
    setFstDropdown();

function calculateNetWeight(event,obj)
    {
        event.preventDefault();

        var opertaion_type = $('.operation_type').val();
        var gross_weight =  $("input[name=gross_weight]").val();
        var tare_weight =  $("input[name=tare_weight]").val();

        var net_weight = 0;

        if(opertaion_type == "Outbound")
        {
            if(tare_weight > 0)
            {
                net_weight = tare_weight - gross_weight;
            }
        
        }
        else
        {
            if(gross_weight > 0)
            {
                net_weight =  gross_weight - tare_weight;
            
            }
        }
            $('.net_weight').val(net_weight);

    }

    function getMaterialRate(event,obj)
    {
        event.preventDefault();

        var material = $(obj).val();
        var client_type = "{{$transaction->client_type}}";
        var user_id = "{{$transaction->client_id}}";
  
        $.get("{{route('materialinfo')}}",{material:material,client_type,client_type,user_id,user_id},function(data){

            $('.material_rate').val(data.rate);


        });

    }
    

</script>