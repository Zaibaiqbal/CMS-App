

<!-- Modal -->
<div class="modal fade" id="modal_add_account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Account Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
     
      {{ Form::open(array('route' => 'store.account', 'class' => '', 'id' => 'form_add_account')) }}


      <div class="modal-body">
               
                <div class="card">

                    <div class="card-body">
                        <div class="row">

                      
                            <div class="col-md-6">

                                @php($label = 'Title')
                                @php($name = 'title')
                                <label for="">{{$label}} <span class="text-danger">*</span></label>
                                <small class="text-danger" id="{{$name}}_error"></small>

                                <input type="text" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">

                            </div>

                            <div class="col-md-6">

                                @php($label = 'Account No')
                                @php($name = 'account_no')
                                <label for="">{{$label}} <span class="text-danger">*</span></label>
                                <small class="text-danger" id="{{$name}}_error"></small>

                                <input type="text" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">

                            </div>

                 

                        
                    </div>

                    </div>
                    <!-- /.card-body -->

                
                </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" onclick="submitModalForm(event,this,'#form_add_account','#modal_add_account')">Submit</button>
      </div>

      {{ Form::close() }}

    </div>
  </div>
</div>

<script>
  setFstDropdown();
</script>