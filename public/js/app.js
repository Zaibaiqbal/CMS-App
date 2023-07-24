function formModal(event,route,form_modal,target_modal)
{

    event.preventDefault();

    $.get(route,function(data)
    {
        $(target_modal).html(data);
        $(form_modal).modal('show');

    });

}

function submitModalForm(event,obj,form_id,form_modal_id)
{

    event.preventDefault();

    var obj = $(form_id);

    var form = document.querySelector(form_id) // Find the <form> element

    var formData = new FormData(form); // Wrap form contents

    var route = obj.attr('action');

    $.ajax({

        url: route,

        type: obj.attr('method'),

        data: formData,

        dataType: "json",

        contentType: false,

        cache: false,

        processData: false,

        success: function(result) {

            if (result.status) {

                // messageToaster('success', result.message, 'Success');
               
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
                toastr.success(result.message);

                flag = false;

                if ($(form_modal_id).length > 0) {

                    $(form_modal_id).modal('hide');

                    flag = true;
                }
                    location.reload();
                
                

            } else {


            }

            // removeLoader();
        },
        error: function(result){

            var errors = result.responseJSON.errors;
            $.each(errors, function (key, val) {

                $("#" + key + "_error").text(val[0]);
            });
           
        }
       
    });

}

function formSubmission(event)
{

    event.preventDefault();

    swal({
        title: "Are you sure",
        text: "you want to Approve User",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {

        if (willDelete)
        {
            swal("Your request has been submitted!", {
                icon: "success",
            });

			    window.location.href =  $('.delete_submit').attr('href');


        }
        else
        {
            swal("Your request has been cancelled!");
        }
    });

}

