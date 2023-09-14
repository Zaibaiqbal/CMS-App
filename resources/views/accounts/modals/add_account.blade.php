

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

                        @if(Auth::user()->hasRole(['Super Admin']))
                        <div class="col-md-6">
                          @php($name = 'client')
                          @php($label = 'Select Client')
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

                        <div class="col-md-6 mb-2">

                        @php($label = 'Client Group')
                        @php($name = 'client_group')
                        <label for="">{{$label}} <span class="text-danger">*</span></label>
                        <small class="text-danger" id="{{$name}}_error"></small>

                        <select name="{{$name}}" id="" class="form-control fstdropdown-select">

                        @foreach($group_list as $rows)
                              <option value="{{$rows}}">{{$rows}}</option>
                          @endforeach
                        </select>
                        </div>

                          @endif

                      
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