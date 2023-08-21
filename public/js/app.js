function formModal(event,route,form_modal,target_modal)
{

    event.preventDefault();

    $.get(route,function(data)
    {
        $(target_modal).html(data);
        $(form_modal).modal('show');

    });

}



function formSubmission(event,obj)
{
    event.preventDefault();

    swal({
        title: "Are you sure",
        text: "you want to approve",
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
			    window.location.href =  $(obj).attr('href');
        }
        else
        {
            swal("Your request has been cancelled!");
        }

    });



}

