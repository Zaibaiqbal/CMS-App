

<!-- Modal -->
<div class="modal fade" id="modal_request_contact_person" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Contact</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'request.contactperson', 'class' => '', 'id' => 'form_add_request_contact_person')) }}

      <div class="modal-body">
               
        <div class="card">

            <div class="card-body">
                
                <div class="row">
                
                    <div class="col-md-6">
                        <div class="form-group">
                            @php($label = 'Name')
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

                        @php($label = 'Email')
                            @php($name = 'email')
                            <label for="exampleInputEmail1">{{$label}} <span class="text-danger">*</span> </label>
                            <small class="text-danger" id="{{$name}}_error"></small>

                            <input type="email" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">


                    </div>

                    <div class="col-sm-6 mt-2">
                            @php($label = 'Select Account Type')
                            @php($name = 'account_type')
                        <label for="">{{$label}} <span class="text-danger">*</span> </label>
                        <small class="text-danger" id="{{$name}}_error"></small>
                        
                        <div class="form-group">

                        <input type="radio" name="{{$name}}" value="New Account" aria-label="Radio button for following text input" onclick="getAccountList(this)">
                        <label for="exampleInputEmail1">For New Account <span class="text-danger"></span> 

                        </label>

                        <input type="radio" name="{{$name}}" value="Existing Account" onclick="getAccountList(this)" aria-label="Radio button for following text input">
                        <label for="exampleInputEmail1">For Existing Account <span class="text-danger"></span> 

                        </label>
                        </div>

                    </div>
                    <div class="col-md-12 mb-2 user_account" style="display: none;">
                        @php($label = 'Select Account')
                        @php($name = 'account')
                        <label for="exampleInputEmail1">{{$label}} <span class="text-danger">*</span> </label>
                        <small class="text-danger" id="{{$name}}_error"></small>

                          <select name="{{$name}}[]" multiple="true" class="form-control fstdropdown-select" id="">

                              @foreach($account_list as $rows)


                              <option value="{{encrypt($rows->id)}}">{{$rows->account_no}}</option>

                              @endforeach

                          </select>


                    </div>

                    <div class="col-md-12">
                        @php($label = 'Note')
                        @php($name = 'note')
                        <div class="form-group">
                            <label for="">{{$label}}:</label>
                            <textarea type="text" name="{{$name}}" class="form-control" cols="40" rows="3" placeholder="{{$label}}">
                                </textarea>
                        </div>
                    </div>
                
                
                </div>
            </div>
            <!-- /.card-body -->

        
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" onclick="submitModalForm(event,this,'#form_add_request_contact_person','#modal_request_contact_person')">Submit</button>
      </div>
      {{ Form::close() }}


    </div>
  </div>
</div>

<script type="text/javascript">
$('.cnic').mask("00000-0000000-0");
$('.contact').mask("0000-0000000");

setFstDropdown();
function getAccountList(obj)
{

  var type  = $(obj).val();

  if(type == "Existing Account")
  {
    $('.user_account').show();
  }
  else
  {
    $('.user_account').hide();


  }

}


</script>
