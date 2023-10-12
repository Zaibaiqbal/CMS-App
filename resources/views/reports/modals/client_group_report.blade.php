

<!-- Modal -->
<div class="modal fade" id="md_client_group_report"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" >
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Client Group Wise Transaction Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'clientgroupreport', 'class' => '', 'id' => 'form_client_group_report')) }}


      <div class="modal-body">
               
        <div class="card">

          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                @php($label = 'Select Client Group')

                @php($name = 'client_group')
                <div class="form-group">
                    <label for="">{{$label}} <span class="text-danger"> </span> </label>

                    <small class="text-danger" id="{{$name}}_error"></small>

                    <select name="{{$name}}" id="" class="form-control fstdropdown-select">
                        <option value="">{{$label}}</option>
                        <option value="Cash Account">Cash Account</option>

                    @foreach($group_list as $rows)
                        <option value="{{$rows}}">{{$rows}}</option>
                    @endforeach
                    </select>
                </div>

              </div>

              <div class="col-md-6">
                @php($label = 'From')
                @php($name = 'from')
                  <div class="form-group">
                      <label for="">{{$label}}</label>
                      <span><i class="text-danger"></i></span>
                      <small id="{{$name}}_error" class="text-danger"></small>

                      <input type="date" name="{{$name}}" class="form-control" id="">
                  </div>

              </div>
              <div class="col-md-6">
                @php($label = 'To')
                @php($name = 'to')
                  <div class="form-group">
                      <label for="">{{$label}}</label>
                      <span><i class="text-danger"></i></span>
                      <small id="{{$name}}_error" class="text-danger"></small>

                      <input type="date" name="{{$name}}" class="form-control" id="">
                  </div>

              </div>

            
           
              
            </div>

          </div>
            <!-- /.card-body -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      {{ Form::close() }}

    </div>
  </div>
</div>


<script>
  setFstDropdown();
</script>