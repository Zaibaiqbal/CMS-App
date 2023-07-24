<div class="row">
        <div class="col-md-12">
            <div class="form-group">
                @php($label = 'Plate No')
                @php($name = 'plate_no')
                <label for="">{{$label}} <span class="text-danger">*</span> </label>
                <small class="text-danger" id="{{$name}}_error"></small>
                <input type="text" name="{{$name}}"  placeholder="{{$label}}"  class="form-control auto_search" id="">
            </div>

        </div>
        <div class="col-md-6">
            <div class="form-group">
                @php($label = 'Client Name')
                @php($name = 'name')

                <label for="">{{$label}} <span class="text-danger">*</span> </label>
                <small class="text-danger" id="{{$name}}_error"></small>

                <input type="text" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">

            </div>
        </div>

        <div class="col-md-6 mb-2">

                @php($label = 'Contact')
                @php($name = 'contact_no')
                <label for="">{{$label}} <span class="text-danger">*</span> </label>
                <small class="text-danger" id="{{$name}}_error"></small>

                <input type="text" name="{{$name}}" class="form-control contact" id="" placeholder="0000-0000000" data-mask="0000-000000">


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
      
        <div class="col-md-4 mb-2">

            @php($label = 'Gross Weight')
                @php($name = 'gross_weight')
                <label id="gross_label" for="">{{$label}} <span class="text-danger">*</span> </label>
                <small class="text-danger" id="{{$name}}_error"></small>

                <input type="text" name="{{$name}}" class="form-control" id="gross_input" placeholder="{{$label}}">

        </div>
        <div class="col-md-4 mb-2">

            @php($label = 'Tare Weight')
            @php($name = 'tare_weight')
            <label for="" id="tare_label">{{$label}} <span class="text-danger">*</span> </label>
            <small class="text-danger" id="{{$name}}_error"></small>

            <input type="text" name="{{$name}}" class="form-control" id="tare_input" placeholder="{{$label}}">


        </div>

        <div class="col-md-4 mb-2">

            @php($label = 'Net-weight')
            @php($name = 'net_weight')
            <label for="">{{$label}} <span class="text-danger"></span> </label>
            <small class="text-danger" id="{{$name}}_error"></small>

            <input type="text" readonly name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">


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
        <button type="submit" onclick="submitModalForm(event,this,'#form_add_truck_info','#modal_add_truck')" class="btn btn-primary my-3" style="float: right;">Submit</button>

    </div>

</div>


<script>


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

    }
    else
    {

        $("#tare_label").text("Tare Weight");
        $("#tare_input").attr("name", "tare_weight");
        $("#tare_input").attr("placeholder", "Tare Weight");

        $("#gross_label").text("Gross Weight:");
        $("#gross_input").attr("name", "gross_weight");
        $("#gross_input").attr("placeholder", "Gross Weight");

    }
}

</script>