

<!-- Modal -->
<div class="modal fade" id="modal_add_truck"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Truck Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'store.truck', 'class' => '', 'id' => 'form_add_truck_info')) }}


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

                  <select name="{{$name}}" id="" class="form-control fstdropdown-select">
                      <option value="{{encrypt(0)}}">{{$label}}</option>
                  @foreach($client_list as $rows)
                      <option value="{{encrypt($rows->id)}}">{{$rows->name}}</option>
                  @endforeach
                  </select>
              </div>

            </div>
              
              <div class="col-md-6">
                @php($label = 'Plate Number')
                @php($name = 'plate_no')
                  <div class="form-group">
                      <label for="">{{$label}}</label>
                      <span><i class="text-danger">*</i></span>
                      <small id="{{$name}}_error" class="text-danger"></small>

                      <input type="text" name="{{$name}}" class="form-control auto_search_truck" onkeyup="autoSearchTruck(event,this)" id="" placeholder="{{$label}}">
                  </div>

              </div>

              <div class="col-md-6">
                @php($label = 'Company')
                @php($name = 'company')
                  <div class="form-group">
                      <label for="">{{$label}}</label>
                      <span><i class="text-danger">*</i></span>
                      <small id="{{$name}}_error" class="text-danger"></small>

                      <input type="text" name="{{$name}}" class="form-control company" placeholder="{{$label}}">
                  </div>
              </div>

              <div class="col-md-6">
                @php($label = 'Model')
                @php($name = 'model')
                  <div class="form-group">
                      <label for="">{{$label}}</label>
                      <span><i class="text-danger">*</i></span>
                      <small id="{{$name}}_error" class="text-danger"></small>

                      <input type="text" name="{{$name}}" class="form-control model" placeholder="{{$label}}">
                  </div>
              </div>

              <div class="col-md-6">
                @php($label = 'Color')
                @php($name = 'color')
                  <div class="form-group">
                      <label for="">{{$label}}</label>
                      <small id="{{$name}}_error" class="text-danger"></small>

                      <input type="text" name="{{$name}}" class="form-control" placeholder="{{$label}}">
                  </div>
              </div>

              <div class="col-md-6">
                @php($label = 'Tare Weight')
                @php($name = 'tare_weight')
                  <div class="form-group">
                      <label for="">{{$label}}</label>
                      <span><i class="text-danger">*</i></span>
                      <small id="{{$name}}_error" class="text-danger"></small>

                      <input type="text" name="{{$name}}" class="form-control tare_weight" placeholder="{{$label}}">
                  </div>
              </div>

              <div class="col-md-6">
                  @php($label = 'VIN Number')
                  @php($name = 'vin_no')
                  <div class="form-group">
                      <label for="">{{$label}}</label>
                      <span><i class="text-danger"></i></span>
                      <small id="{{$name}}_error" class="text-danger"></small>

                      <input type="text" name="{{$name}}" class="form-control vin_no" placeholder="{{$label}}">
                  </div>
              </div>

              <div class="col-md-12">
                  @php($label = 'Description')
                  @php($name = 'description')
                  <div class="form-group">
                      <label for="">{{$label}}</label>
                      <textarea type="text" name="{{$name}}" class="form-control description" cols="40" rows="3" placeholder="{{$label}}"></textarea>
                  </div>
              </div>
              
            </div>

          </div>
            <!-- /.card-body -->
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" onclick="submitModalForm(event,this,'#form_add_truck_info','#modal_add_truck')" class="btn btn-primary">Submit</button>
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

function autoSearchTruck(event,obj)
{

  event.preventDefault();

  var route = "{{ route('autosearchtruck') }}";

  var formData = {}

  $('input.auto_search_truck').autocomplete({
      source: function (request, response) {
          $.ajax({
              url: route,
              type: "GET",
              data: {
                  search: request.term,
              },
              contentType: "json",
              success: function (data) {

                  var parsedData = JSON.parse(data);
                  if (parsedData.length === 0) {

                    $('.company').val('').attr('readonly',false);
                    $('input[name=color]').val('').attr('readonly',false);
                    $('.model').val('').attr('readonly',false);
                    $('.vin_no').val('').attr('readonly',false);
                    $('.tare_weight').val('').attr('readonly',false);
                    $('.description').val('').attr('readonly',false);

                  } else {

                  response($.map(JSON.parse(data), function (item) {

                      return {

                          label: item.plate_no,
                          label1: item.model,
                          val1:    item.color,
                          label2: item.company,
                          label3: item.vin_no,
                          label4: item.tare_weight,
                          label5: item.description,
                      }
                
                  }))
              }
              
              },
              error: function (response) {
                  alert(response.responseText);
              },
              failure: function (response) {
                  console.log("fve");

                  alert(response.responseText);
              }
          });
      },
      select: function (e, i) {

          $('.company').val(i.item.label2).attr('readonly',true);
          $('input[name=color]').val(i.item.val1).attr('readonly',true);
          $('.auto_search_truck').val(i.item.label);
          $('.model').val(i.item.label1).attr('readonly',true);
          $('.vin_no').val(i.item.label3).attr('readonly',true);
          $('.tare_weight').val(i.item.label4).attr('readonly',true);
          $('.description').val(i.item.label5).attr('readonly',true);


          // getClientAccountList(i.item.val1);
      },
      open: function() {
        // alert($(obj).autocomplete("widget"));
  // Get the autocomplete list element
          var autocompleteList = $(obj).autocomplete("widget");

          // Add custom CSS class to the list element
          autocompleteList.addClass("custom-autocomplete-list");
      },
      minLength: 1
  });

}
</script>