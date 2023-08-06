

<!-- Modal -->
<div class="modal fade" id="modal_add_transaction_truck" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Truck Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'store.truck', 'class' => '', 'id' => 'form_add_transaction_truck_info')) }}


      <div class="modal-body">
               
                <div class="card">

                    <div class="card-body">
                      @include('components.trucks.add_truck_component')

                    </div>
                    <!-- /.card-body -->

                
                </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" onclick="storeTruck(event,this,'#form_add_transaction_truck_info','#modal_add_transaction_truck')" class="btn btn-primary">Submit</button>
      </div>
      {{ Form::close() }}

    </div>
  </div>
</div>

<script>

function storeTruck(event,obj,form_id,modal_id)
	{
		event.preventDefault();

		var obj = $(form_id);
		//To send image
		var form = document.querySelector(form_id) // Find the <form> element
		var formData = new FormData(form); // Wrap form contents

		var route = obj.attr('action');



    formData.append('flag',true);

		$.ajax({
		url: route,
		type: obj.attr('method'),
		data:  formData,
		dataType: "json",
		contentType: false,
		cache: false,
		processData:false,
		success: function(result){
			if(result.id)
		    {
		    	$("input[name=truck_id]").val(result.id);
		    	$("input[name=plate_no]").val(result.plate_no).attr("readonly",true);

          $(modal_id).modal('hide');
          
				
          toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
                toastr.success('Truck added successfully');


		    }
		},
		error: function(data)
			   {
			   }
		});


	}

</script>