

<!-- Modal -->
<div class="modal fade" id="modal_add_client" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Client Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'store.client', 'class' => '', 'id' => 'form_add_client')) }}

      <div class="modal-body">
               
                <div class="card">

                    <div class="card-body">
                      
                    @include('components.clients.add_client_component')
                    </div>
                    <!-- /.card-body -->

                
                </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" onclick="storeClient(event,this,'#form_add_client','#modal_add_client')">Submit</button>
      </div>
      {{ Form::close() }}


    </div>
  </div>
</div>

<script type="text/javascript">
$('.cnic').mask("00000-0000000-0");
$('.contact').mask("0000-0000000");


function storeClient(event,obj,form_id,modal_id)
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
		    	$("input[name=user_id]").val(result.id);
		    	$("input[name=name]").val(result.name);
		    	$("input[name=contact_no]").val(result.contact);

          $(modal_id).modal('hide');
          
				
          toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
                toastr.success('User added successfully');


		    }
		},
		error: function(data)
			   {
			   }
		});


	}


</script>
