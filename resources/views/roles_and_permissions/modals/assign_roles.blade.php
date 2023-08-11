

<!-- Modal -->
<div class="modal fade" id="modal_assign_role" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      {{ Form::open(array('route' => 'assign.roles', 'class' => '', 'id' => 'form_add_role')) }}

      <div class="modal-body">
               
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                @php($name = 'role[]')
                                @php($label = 'Select Role')
                                <div class="form-group">
                                    <label >{{$label}}</label>
                                    <select name="{{$name}}" class="form-control fstdropdown-select">

                                    @foreach($role_list as $rows)

                                    <option @if($user->hasRole($rows->id)) selected value="{{encrypt($rows->id)}}" @endif value="{{encrypt($rows->id)}}">{{$rows->name}}</option>

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
        <input type="hidden" name="user" value="{{encrypt($user->id)}}">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" onclick="submitModalForm(event,this,'#form_add_role','#modal_add_role')">Submit</button>
      </div>

      {{ Form::close() }}

    </div>
  </div>
</div>


<script>


  setFstDropdown();
</script>