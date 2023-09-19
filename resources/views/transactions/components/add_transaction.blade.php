{{ Form::open(array('route' => 'store.transaction', 'class' => '', 'id' => 'form_create_transaction')) }}
<div class="row">
        <div class="col-md-6">
            @php($label = 'License No')
            @php($name = 'plate_no')
            <label for="">{{$label}} <span class="text-danger">*</span> </label>
            <small class="text-danger" id="{{$name}}_error"></small>
            <div class="input-group">

                <input type="hidden" name="truck_id" class="truck_id">

                <input type="text" name="{{$name}}"  placeholder="{{$label}}" onkeyup="autoSearchPlateNo(event,'plate_no_tag')" class="form-control auto_search_plate_no" id="">
            </div>
        </div>
      
        <div class="col-md-6">
            @php($label = 'Vehicle Desc.')
            @php($name = 'vehicle_descp')
            <div class="form-group">
                <label for="">{{$label}}</label>
                <textarea type="text" name="{{$name}}" class="form-control" cols="40" rows="2" placeholder="{{$label}}"></textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <input type="checkbox" name="is_identified" value="1" id="">
                <label for="">Not Identified Yet</label>

            </div>
        </div>
        <div class="col-md-6">
                @php($label = 'Client')
                @php($name = 'client')

                <label for="">{{$label}} <span class="text-danger"></span> </label>
                <small class="text-danger" id="{{$name}}_error"></small>
                <div class="input-group">
                    <input type="text" name="{{$name}}" class="form-control client_name auto_search_client_name" onkeyup="autoSearchClientName(event,'client_name_tag')" id="" placeholder="{{$label}}">
                <input type="hidden" value="" name="user_id"  class="user_id">


            </div>
        </div>

        <div class="col-md-6 mb-2">

                @php($label = 'Contact')
                @php($name = 'contact_no')
                <label for="">{{$label}} <span class="text-danger"></span> </label>
                <small class="text-danger" id="{{$name}}_error"></small>

                <input type="text" name="{{$name}}" class="form-control contact" id="" placeholder="0000-0000000" data-mask="0000-000000">


        </div>

        
        {{--

        <div class="col-md-6">
                @php($label = 'Select Account')
                @php($name = 'account')

                <label for="">{{$label}} <span class="text-danger">*</span> </label>
                <small class="text-danger" id="{{$name}}_error"></small>
                <div class="input-group">

                <select name="{{$name}}" id="" class="form-control fstdropdown-select account_list">

                <option value="{{encrypt(0)}}">Select Account</option>

                </select>



            </div>
        </div>

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

        <div class="col-md-6 mb-2">

            @php($label = 'Operation')
            @php($name = 'operation_type')
            @php($operation_types = ['Inbound','Outbound'])
            <label for="">{{$label}} <span class="text-danger"></span> </label>
            <small class="text-danger" id="{{$name}}_error"></small>

            <select name="{{$name}}" id="" class="form-control operation_type" >
                @foreach($operation_types as $rows)
                    <option value="{{$rows}}">{{$rows}}</option>
                @endforeach
            </select>

        </div>
        --}}

        <div class="col-md-12 mb-2">

            @php($label = 'In-weight')
                @php($name = 'inweight')
                <label id="gross_label" for="">{{$label}} <span class="text-danger">*</span> </label>
                <small class="text-danger" id="{{$name}}_error"></small>

                <input type="text" name="{{$name}}" class="form-control" id="gross_input" placeholder="{{$label}}">

        </div>
        {{--
        <div class="col-md-6 mb-2">

            @php($label = 'Tare Weight')
            @php($name = 'tare_weight')
            <label for="" id="tare_label">{{$label}} <span class="text-danger">*</span> </label>
            <small class="text-danger" id="{{$name}}_error"></small>

            <input type="text" name="{{$name}}" class="form-control" onkeyup="calculateNetWeight(event,this)" id="tare_input" placeholder="{{$label}}">


        </div>

        <div class="col-md-6 mb-2">

            @php($label = 'Net-weight')
            @php($name = 'net_weight')
            <label for="">{{$label}} <span class="text-danger"></span> </label>
            <small class="text-danger" id="{{$name}}_error"></small>

            <input type="text" readonly name="{{$name}}" class="form-control net_weight" id="" placeholder="{{$label}}">


        </div>

        --}}

        

    
</div>


<div class="row">
    <div class="col-md-12">
        <input type="hidden" value="" name="client_group" class="client_group">
        <button onclick="resetForm(event,this)" class="btn btn-danger my-3" style="float: right;">Reset</button>
        <button type="submit" onclick="submitModalForm(event,this,'#form_create_transaction','')" class="btn btn-primary my-3 mx-2" style="float: right;">Queue</button>

    </div>

</div>
{{ Form::close() }}


@include('transactions.modals.add_truck')
@include('users.modals.add_client')

<script>
    function resetForm(event,obj)
    {
        event.preventDefault();
        $('#form_create_transaction').trigger('reset');
        $('.truck_id').val('');
        $('.client_group').val('');
    }

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