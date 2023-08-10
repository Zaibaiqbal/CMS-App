{{ Form::open(array('route' => 'store.transaction', 'class' => '', 'id' => 'form_create_transaction')) }}
<div class="row">
        <div class="col-md-12">
                @php($label = 'Plate No')
                @php($name = 'plate_no')
                <label for="">{{$label}} <span class="text-danger">*</span> </label>
                <small class="text-danger" id="{{$name}}_error"></small>
            <div class="input-group">

                <input type="hidden" name="truck_id" class="truck_id">

                <input type="text" name="{{$name}}"  placeholder="{{$label}}" onkeyup="autoSearchPlateNo(event,'plate_no_tag')" class="form-control auto_search_plate_no" id="">

                <div class="input-group-append">
                    @if(Auth::user()->hasAnyPermission(['All','Add Truck']))
            
                    <a data-target="#modal_add_transaction_truck" data-toggle="modal" class="btn  btn-primary text-white font-weight-bolder p-2" style="float: right;">
                    Add</a>
                    @endif

                </div>
            </div>


        </div>
        <div class="col-md-6">
                @php($label = 'Client Name')
                @php($name = 'client')

                <label for="">{{$label}} <span class="text-danger">*</span> </label>
                <small class="text-danger" id="{{$name}}_error"></small>
                <div class="input-group">

                {{-- 
                <select name="{{$name}}" id="" class="form-control fstdropdown-select">

                <option value="{{encrypt(0)}}">{{$label}}</option>

                @foreach($user_list as $rows)

                <option value="{{encrypt($rows->id)}}">{{$rows->name}}</option>

                @endforeach

                </select>

                <div class="input-group-append">
                    @if(Auth::user()->hasAnyPermission(['All','Add Clients']))
            
                    <a data-target="#modal_add_client" data-toggle="modal" class="btn  btn-primary text-white font-weight-bolder p-2" style="float: right;">
                    Add</a>
                    @endif

                </div>
                --}}

              <input type="text" name="{{$name}}" class="form-control client_name auto_search_client_name" id="" placeholder="{{$label}}">
                <input type="hidden" value="" name="user_id"  class="user_id">


            </div>
        </div>

        <div class="col-md-6 mb-2">

                @php($label = 'Contact')
                @php($name = 'contact_no')
                <label for="">{{$label}} <span class="text-danger">*</span> </label>
                <small class="text-danger" id="{{$name}}_error"></small>

                <input type="text" name="{{$name}}" readonly class="form-control contact" id="" placeholder="0000-0000000" data-mask="0000-000000">


        </div>

        <div class="col-md-6">
                @php($label = 'Select Account')
                @php($name = 'account')

                <label for="">{{$label}} <span class="text-danger">*</span> </label>
                <small class="text-danger" id="{{$name}}_error"></small>
                <div class="input-group">

                <select name="{{$name}}" id="" class="form-control fstdropdown-select account_list">


                </select>



            </div>
        </div>
        {{--

        <div class="col-md-6 mb-2">

                @php($label = 'Select Material Type')
                @php($name = 'material_type')
                <label for="">{{$label}} <span class="text-danger">*</span> </label>
                <small class="text-danger" id="{{$name}}_error"></small>

                <select name="{{$name}}" id="" class="form-control">
                    <option value="{{encrypt(0)}}">{{$label}}</option>
                    @foreach($material_types as $rows)
                        <option value="{{encrypt($rows->id)}}">{{$rows->name}}</option>
                    @endforeach
                </select>

        </div>
        --}}

        <div class="col-md-6 mb-2">

            @php($label = 'Select Operation Type')
            @php($name = 'operation_type')
            @php($operation_types = ['Inbound','Outbound'])
            <label for="">{{$label}} <span class="text-danger"></span> </label>
            <small class="text-danger" id="{{$name}}_error"></small>

            <select name="{{$name}}" id="" class="form-control operation_type" onchange="getWeightType(event,this)">
                @foreach($operation_types as $rows)
                    <option value="{{$rows}}">{{$rows}}</option>
                @endforeach
            </select>

        </div>
        <div class="col-md-6 mb-2">

            @php($label = 'Gross Weight')
                @php($name = 'gross_weight')
                <label id="gross_label" for="">{{$label}} <span class="text-danger">*</span> </label>
                <small class="text-danger" id="{{$name}}_error"></small>

                <input type="text" onkeyup="calculateNetWeight(event,this)" name="{{$name}}" class="form-control" id="gross_input" placeholder="{{$label}}">

        </div>
        {{--
        <div class="col-md-4 mb-2">

            @php($label = 'Tare Weight')
            @php($name = 'tare_weight')
            <label for="" id="tare_label">{{$label}} <span class="text-danger">*</span> </label>
            <small class="text-danger" id="{{$name}}_error"></small>

            <input type="text" name="{{$name}}" class="form-control" onkeyup="calculateNetWeight(event,this)" id="tare_input" placeholder="{{$label}}">


        </div>

        <div class="col-md-4 mb-2">

            @php($label = 'Net-weight')
            @php($name = 'net_weight')
            <label for="">{{$label}} <span class="text-danger"></span> </label>
            <small class="text-danger" id="{{$name}}_error"></small>

            <input type="text" readonly name="{{$name}}" class="form-control net_weight" id="" placeholder="{{$label}}">


        </div>

        --}}


        <div class="col-md-6">
            @php($label = 'Driver Name')
            @php($name = 'driver_name')
            <div class="form-group">
                <label for="">{{$label}} <span class="text-danger">*</span></label>
                <small id="{{$name}}_error" class="text-danger"></small>

                <input type="text" name="{{$name}}" class="form-control" placeholder="{{$label}}">
            </div>
        </div>

        <div class="col-md-12">
            @php($label = 'Note')
            @php($name = 'note')
            <div class="form-group">
                <label for="">{{$label}}</label>
                <textarea type="text" name="{{$name}}" class="form-control" cols="40" rows="3" placeholder="{{$label}}">
                    </textarea>
            </div>
        </div>

    
</div>


<div class="row">
    <div class="col-md-12">
        <button type="submit" onclick="submitModalForm(event,this,'#form_create_transaction','')" class="btn btn-primary my-3" style="float: right;">Submit</button>

    </div>

</div>
{{ Form::close() }}


@include('transactions.modals.add_truck')
@include('users.modals.add_client')

<script>

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


function getWeightType(event,obj)
{
    var opertaion_type = $(obj).val();

    if(opertaion_type == "Outbound")
    {
        
        $("#gross_label").text("Tare Weight");
        $("#gross_input").attr("name", "tare_weight");
        $("#gross_input").attr("placeholder", "Tare Weight");

        $("#tare_label").text("Gross Weight:");
        $("#tare_input").attr("name", "gross_weight");
        $("#tare_input").attr("placeholder", "Gross Weight");
        $("#gross_input").val('');
          $("#tare_input").val('');
         $(".net_weight").val('');
    }
    else
    {

        $("#tare_label").text("Tare Weight");
        $("#tare_input").attr("name", "tare_weight");
        $("#tare_input").attr("placeholder", "Tare Weight");

        $("#gross_label").text("Gross Weight:");
        $("#gross_input").attr("name", "gross_weight");
        $("#gross_input").attr("placeholder", "Gross Weight");

        $("#gross_input").val('');
          $("#tare_input").val('');
         $(".net_weight").val('');
    }
}

</script>