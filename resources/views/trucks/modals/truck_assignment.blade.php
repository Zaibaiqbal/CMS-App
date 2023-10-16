
<style>
  span.multiselect-native-select {
	/* position: relative */
}
span.multiselect-native-select select {
	border: 0!important;
	clip: rect(0 0 0 0)!important;
	height: 1px!important;
	margin: -1px -1px -1px -3px!important;
	overflow: scroll!important;
	padding: 0!important;
	position: absolute!important;
	width: 1px!important;
	/* left: 50%;
	top: 30px */
}
.multiselect-container {
	list-style-type: none;
	margin: 0;
	padding: 0;
    transform: translate3d(15px, -217px, 0px);
    left: 0px;
    will-change: transform;
	overflow: scroll!important;
  height: 220px !important;

}
.multiselect-container .input-group {
	margin: 0px
}
.multiselect-container>li {
	padding: 0
}
.multiselect-container>li>a.multiselect-all label {
	font-weight: 700
}
.multiselect-container>li.multiselect-group label {
	margin: 0;
	padding: 3px 20px 3px 20px;
	height: 100%;
	font-weight: 700
}
.multiselect-container>li.multiselect-group-clickable label {
	cursor: pointer
}
.multiselect-container>li>a {
	padding: 0
}
.multiselect-container>li>a>label {
	margin: 0;
	/* height: 100%; */
	cursor: pointer;
	font-weight: 400;
	padding: 3px 0 3px 30px
}
.multiselect-container>li>a>label.radio, .multiselect-container>li>a>label.checkbox {
	margin: 0
}
.multiselect-container>li>a>label>input[type=checkbox] {
	/* margin-bottom: 5px */
}
.btn-group>.btn-group:nth-child(2)>.multiselect.btn {
	border-top-left-radius: 4px;
	border-bottom-left-radius: 4px
}
.form-inline .multiselect-container label.checkbox, .form-inline .multiselect-container label.radio {
	padding: 3px 20px 3px 40px
}
.form-inline .multiselect-container li a label.checkbox input[type=checkbox], .form-inline .multiselect-container li a label.radio input[type=radio] {
	margin-left: -20px;
	margin-right: 0
}
</style>
<!-- Modal -->
<div class="modal fade" id="modal_truck_asignment"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Truck Assignment to Client</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'trucks.assignment', 'class' => '', 'id' => 'form_truck_asignment')) }}


      <div class="modal-body">
               
        <div class="card">

          <div class="card-body">
            <div class="row">
              @php($uniqid = uniqid())
                <div class="col-md-12">
                @php($name = 'client')
                @php($label = 'Select Client')
                <div class="form-group">
                    <label for="">{{$label}} <span class="text-danger"> *</span> </label>

                    <small class="text-danger" id="{{$name}}_error"></small>

                    <select name="{{$name}}" id="" class="form-control fstdropdown-select" onchange="showClientTruckList(event,this,'{{$uniqid}}')">
                        <option value="{{encrypt(0)}}">{{$label}}</option>
                    @foreach($client_list as $rows)
                        <option value="{{encrypt($rows->id)}}">{{$rows->name}}</option>
                    @endforeach
                    </select>
                </div>

                </div>

            <div class="col-md-6 truck_section" style="display: none;">
              @php($name = 'truck')
              @php($label = 'Select Trucks')
              {{--
              <div class="form-group">
                  <label for="">{{$label}} <span class="text-danger"> *</span> </label>

                  <small class="text-danger" id="{{$name}}_error"></small>

                  <select name="{{$name}}[]" id="" class="form-control fstdropdown-select truck_list_{{$uniqid}}" multiple="true">
                      <option value="{{encrypt(0)}}">{{$label}}</option>
                 
                  </select>
              </div>
              --}}
                <label for="">{{$label}} <span class="text-danger"> *</span> </label>

                <small class="text-danger" id="{{$name}}_error"></small>

                <select name="{{$name}}[]" class="multiselect-ui form-control truck_list_{{$uniqid}}" multiple="multiple">
                  <option value="{{encrypt(0)}}">{{$label}}</option>

                </select>

            </div>

            <div class="col-md-6 client_section" style="display: none;">
              @php($name = 'assign_client')
              @php($label = 'Select Client to Assign')
              <div class="form-group">
                  <label for="">{{$label}} <span class="text-danger"> *</span> </label>

                  <small class="text-danger" id="{{$name}}_error"></small>

                  <select name="{{$name}}" id="" class="form-control fstdropdown-select">
                      <option value="{{encrypt(0)}}">{{$label}}</option>
                  @foreach($client_list as $rows)
                      <option value="{{encrypt($rows->id)}}">{{$rows->name}}</option>
                  @endforeach
                  </select>
              </div>

            </div>
              
        
              
            </div>

          </div>
            <!-- /.card-body -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" onclick="submitModalForm(event,this,'#form_truck_asignment','#modal_truck_asignment')" class="btn btn-primary">Submit</button>
      </div>
      {{ Form::close() }}

    </div>
  </div>
</div>

<div  class="loading-overlay overlay">
        <div class="spinner"></div>
    </div>

<script>


setFstDropdown();

function showClientTruckList(event,obj,key_pair)
{

    event.preventDefault();
    var route = "{{route('clienttrucklist')}}";

    $.get(route,{client_id:$(obj).val()},function(data){

        $('.truck_section').show();
        $('.client_section').show();
        $('.truck_list_' + key_pair).multiselect('destroy');
        $('.truck_list_'+key_pair).html('');
        
        $('.truck_list_'+key_pair).html(data);

        $('.truck_list_'+key_pair).multiselect({
        includeSelectAllOption: true
    });

    });

}

</script>