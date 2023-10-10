

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

                <div class="col-md-12">
                @php($name = 'client')
                @php($label = 'Select Client')
                <div class="form-group">
                    <label for="">{{$label}} <span class="text-danger"> *</span> </label>

                    <small class="text-danger" id="{{$name}}_error"></small>

                    <select name="{{$name}}" id="" class="form-control fstdropdown-select" onchange="showClientTruckList(event,this)">
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
              <div class="form-group">
                  <label for="">{{$label}} <span class="text-danger"> *</span> </label>

                  <small class="text-danger" id="{{$name}}_error"></small>

                  <select name="{{$name}}[]" id="" class="form-control fstdropdown-select truck_list" multiple="true">
                      <option value="{{encrypt(0)}}">{{$label}}</option>
                 
                  </select>
              </div>

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

function showClientTruckList(event,obj)
{

    event.preventDefault();
    var route = "{{route('clienttrucklist')}}";



    $.get(route,{client_id:$(obj).val()},function(data){
     
        $('.truck_section').show();
        $('.client_section').show();
        $('.truck_list').html(data);
        document.querySelector('.truck_list').fstdropdown.rebind();

     
        
    });

}

</script>