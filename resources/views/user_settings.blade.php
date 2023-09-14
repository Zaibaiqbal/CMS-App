@extends('layouts.master')
@section('page_style')

<style>

ul .ui-menu .ui-widget .ui-widget-content .ui-autocomplete .ui-front{
    width: auto !important;
    background-color: #eaeaf2 !important;

}

.custom-autocomplete-list {
    /* Add your custom styles here */
    /* For example: */
    background-color: #f2f2f2;
    border: 1px solid #ccc;
    list-style: none;
    padding: 0;
    width: 16% !important;
  }

  .custom-autocomplete-list li {
    /* Add your custom styles for each list item here */
    /* For example: */
    padding: 5px;
    cursor: pointer;
  }

  .custom-autocomplete-list li:hover {
    background-color: #ddd;
  }

</style>
@endsection
@section('page_body')

<div class="row">
<div class="col-md-5 col-xl-4">
<div class="card">
<div class="card-header">
<h5 class="card-title mb-0">Profile Settings</h5>
</div>
<div class="list-group list-group-flush" role="tablist">

<a class="list-group-item list-group-item-action" data-toggle="list" href="#change_password" role="tab">
Password
</a>

<a class="list-group-item list-group-item-action" data-toggle="list" href="#surcharge" role="tab">
Surcharge / HST 
</a>
@if(Auth::user()->hasAnyPermission(['All','Report Ticket Issue']))

<a class="list-group-item list-group-item-action" data-toggle="list" href="#ticket_issue" role="tabpaneltwo">
Ticket Issue
</a>

@endif
    {{--
<a class="list-group-item list-group-item-action active" data-toggle="list" href="#account" role="tab">
Account
</a>
<a class="list-group-item list-group-item-action" data-toggle="list" href="#password" role="tab">
Password
</a>
<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
Privacy and safety
</a>
<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
Email notifications
</a>
<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
Web notifications
</a>
<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
Widgets
</a>
<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
Your data
</a>
<a class="list-group-item list-group-item-action" data-toggle="list" href="#" role="tab">
Delete account
</a>
--}}
</div>
</div>
</div>
<div class="col-md-7 col-xl-8">
    <div class="tab-content">
            <!-- <div class="tab-pane fade show active" id="account" role="tabpanel">
            <div class="card">
            <div class="card-header">
            <div class="card-actions float-right">
            <div class="dropdown show">
            <a href="#" data-toggle="dropdown" data-display="static">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle">
            <circle cx="12" cy="12" r="1"></circle>
            <circle cx="19" cy="12" r="1"></circle>
            <circle cx="5" cy="12" r="1"></circle>
            </svg>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
            </div>
            </div>
            </div>
            <h5 class="card-title mb-0">Public info</h5>
            </div>
            <div class="card-body">
            <form>
            <div class="row">
            <div class="col-md-8">
            <div class="form-group">
            <label for="inputUsername">Username</label>
            <input type="text" class="form-control" id="inputUsername" placeholder="Username">
            </div>
            <div class="form-group">
            <label for="inputUsername">Biography</label>
            <textarea rows="2" class="form-control" id="inputBio" placeholder="Tell something about yourself"></textarea>
            </div>
            </div>
            <div class="col-md-4">
            <div class="text-center">
            <img alt="Andrew Jones" src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle img-responsive mt-2" width="128" height="128">
            <div class="mt-2">
            <span class="btn btn-primary"><i class="fa fa-upload"></i></span>
            </div>
            <small>For best results, use an image at least 128px by 128px in .jpg format</small>
            </div>
            </div>
            </div>
            <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
            </div>
            </div>
            <div class="card">
            <div class="card-header">
            <div class="card-actions float-right">
            <div class="dropdown show">
            <a href="#" data-toggle="dropdown" data-display="static">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal align-middle">
            <circle cx="12" cy="12" r="1"></circle>
            <circle cx="19" cy="12" r="1"></circle>
            <circle cx="5" cy="12" r="1"></circle>
            </svg>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
            </div>
            </div>
            </div>
            <h5 class="card-title mb-0">Private info</h5>
            </div>
            <div class="card-body">
            <form>
            <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputFirstName">First name</label>
            <input type="text" class="form-control" id="inputFirstName" placeholder="First name">
            </div>
            <div class="form-group col-md-6">
            <label for="inputLastName">Last name</label>
            <input type="text" class="form-control" id="inputLastName" placeholder="Last name">
            </div>
            </div>
            <div class="form-group">
            <label for="inputEmail4">Email</label>
            <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
            </div>
            <div class="form-group">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
            </div>
            <div class="form-group">
            <label for="inputAddress2">Address 2</label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputCity">City</label>
            <input type="text" class="form-control" id="inputCity">
            </div>
            <div class="form-group col-md-4">
            <label for="inputState">State</label>
            <select id="inputState" class="form-control">
            <option selected>Choose...</option>
            <option>...</option>
            </select>
            </div>
            <div class="form-group col-md-2">
            <label for="inputZip">Zip</label>
            <input type="text" class="form-control" id="inputZip">
            </div>
            </div>
            <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
            </div>
            </div>
            </div> -->
            
        <div class="tab-pane fade show active" id="change_password" role="tabpanel">
            <div class="card">
                <div class="card-header">
                <h5 class="card-title">Password</h5>

                </div>
                <div class="card-body">
                {{ Form::open(array('route' => 'change.password', 'class' => '', 'id' => 'form_change_password')) }}

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                @php($label = 'Old Password')
                                @php($name = 'old_password')
                                <label for="">{{$label}} <span class="text-danger">*</span> </label>
                                <small class="text-danger" id="{{$name}}_error"></small>
                                <input type="password" name="{{$name}}"  placeholder="{{$label}}"  class="form-control" id="">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                @php($label = 'New Password')
                                @php($name = 'new_password')

                                <label for="">{{$label}} <span class="text-danger">*</span> </label>
                                <small class="text-danger" id="{{$name}}_error"></small>

                                <input type="password" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">

                            </div>
                        </div>

                        <div class="col-md-6">

                            @php($label = 'Confirm Password')
                            @php($name = 'confirm_password')
                            <label for="exampleInputEmail1">{{$label}} </label>
                            <small class="text-danger" id="{{$name}}_error"></small>

                            <input type="password" name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">


                        </div>
                        <div class="col-md-12">

                            <button type="submit" onclick="updatePassword(event,this,'#form_change_password')" class="btn btn-primary">Submit</button>
                         </div>
                        
                    </div>

                    {{ Form::close() }}

                </form>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="surcharge" role="tabpanel">
            <div class="card">
                <div class="card-header">
                <h5 class="card-title">Surcharge / HST %</h5>

                </div>
                <div class="card-body">
                {{ Form::open(array('route' => 'store.surcharge', 'class' => '', 'id' => 'form_store_surcharge')) }}

                    <div class="row">
                {{--
                    <div class="col-md-12">
                          @php($name = 'client')
                          @php($label = 'Select Client')
                          <div class="form-group">
                              <label for="">{{$label}} <span class="text-danger"> *</span> </label>

                              <small class="text-danger" id="{{$name}}_error"></small>

                              <select name="{{$name}}" id="" class="form-control fstdropdown-select" onclick="getSurchargeInfo(event,this)">
                              @foreach($user_list as $rows)
                                  <option value="{{encrypt($rows->id)}}">{{$rows->name}}</option>
                              @endforeach
                              </select>
                          </div>

                    </div>

                    --}}

                        <div class="col-md-6">
                            <div class="form-group">
                                @php($label = 'Surcharge %')
                                @php($name = 'surcharge')

                                <label for="">{{$label}} <span class="text-danger">*</span> </label>
                                <small class="text-danger" id="{{$name}}_error"></small>

                                <input type="text" @if(isset($surcharge_hst->id)) value="{{$surcharge_hst->surcharge_per}}" @endif name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">

                            </div>
                        </div>

                        <div class="col-md-6">

                            @php($label = 'HST %')
                            @php($name = 'hst_per')
                            <label for="exampleInputEmail1">{{$label}} </label>
                            <small class="text-danger" id="{{$name}}_error"></small>

                            <input type="text" @if(isset($surcharge_hst->id)) value="{{$surcharge_hst->hst_per}}" @endif  name="{{$name}}" class="form-control" id="" placeholder="{{$label}}">


                        </div>
                        <div class="col-md-12">

                        @if(isset($surcharge_hst->id))

                            <input type="hidden" value="{{$surcharge_hst->id}}" name="surcharge_hst">
                        @endif
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                    {{ Form::close() }}

                </form>
                </div>
            </div>
        </div>

        @if(Auth::user()->hasAnyPermission(['All','Report Ticket Issue']))

       @include('ticket_issues.create_ticket_issue')
        @endif

    </div>
</div>
</div>


@endsection

@section('page_script')
<script>
      function autoSearchTicketNumber(event,tag)
    {
        event.preventDefault();

        var route = "{{ route('autosearchticketnumber') }}";

        $('input.auto_search_ticket_number').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: route,
                    type: "GET",
                    data: {
                        search: request.term,
                    },
                    contentType: "json",
                    success: function (data) {

                        response($.map(JSON.parse(data), function (item) {

                            return {
                                label: item.ticket_no,  
                                val:    item.id,                           
                            }
                        }))
                    },
                    error: function (response) {
                        alert(response.responseText);
                    },
                    failure: function (response) {
                        alert(response.responseText);
                    }
                });
            },
            select: function (e, i) {
              
                $('.auto_search_ticket_number').val(i.item.label).attr('readonly',true);
                $('.transaction_id').val(i.item.val);

            },
            open: function() {
        // Get the autocomplete list element
                var autocompleteList = $(this).autocomplete("widget");

                // Add custom CSS class to the list element
                autocompleteList.addClass("custom-autocomplete-list");
            },
            minLength: 1
        });
    }

</script>

<script>

// function getSurchargeInfo(event,obj)
// {
//     event.preventDefault();
    
//     var client = $(obj).val();
//     var route  = "{{route('surchargeinfo')}}";

//     $.get(route,{client:client},function(data){

//         $('#material_weightage').html(data.transaction_view);
//     // $('#monthly_material_weightage').html(data.monthly_view);
//     });

// }

function updatePassword(event,obj,form_id)
{
    event.preventDefault();
    
    var obj = $(form_id);
    //To send image
    var form = document.querySelector(form_id) // Find the <form> element
    var formData = new FormData(form); // Wrap form contents

    var route = obj.attr('action');


    // alert(ajax_validate(obj,'add customer'));

    addThemeLoader();

    $.ajax({
        url: route,
        type: obj.attr('method'),
        data:  formData,
        dataType: "json",
        contentType: false,
        cache: false,
        processData:false,
        success: function(result){

            if(result.status)
            {
                $(form_id).get(0).reset();

                // messageToaster(result.status,result.message,result.status);

                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
                toastr.success(result.message);

                location.reload();

            }
         

            removeThemeLoader();
        },
        error: function(result)
        {
            // console.log(result.responseJSON);
            // messageToaster(result.responseJSON.status,result.responseJSON.message,result.responseJSON.status);
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
            toastr.success(result.message);

            removeThemeLoader();
        }
    });


}


</script>
@endsection