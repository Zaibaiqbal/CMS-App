function applyDarkModeToModals() {
    $('.modal-content, .card, .card-body').addClass('dark-mode');

     // Set modal input fields background to transparent
     $('.modal-content input').css('background', 'transparent');

     // Set modal input fields text color to white
     $('.modal-content input').css('color', 'white');

      // Set select option background to transparent
      $('.modal-content select option').css('background', 'transparent');

      // Set select option text color to white
      $('.modal-content select option').css('color', 'white');

         // Style FST Dropdown select options
        $('.fstdropdown').css({
        'background': '#333',
        'color': '#fff',
        });
}

function formModal(event, route, form_modal, target_modal) {
    event.preventDefault();

    // Function to apply dark mode to modal content
    function applyDarkModeToModalContent() {
        const currentTheme = document.getElementById('pcoded').getAttribute('layout-type');
        if (currentTheme === 'dark') {
            applyDarkModeToModals();
        }
    }

    $.get(route, function (data) {
        $(target_modal).html(data);

        // Apply dark mode styles immediately after loading content
        applyDarkModeToModalContent();

        // Show the modal after it has been loaded
        $(form_modal).modal('show');
    });
}


// function formModal(event,route,form_modal,target_modal)
// {

//     event.preventDefault();

//     $.get(route,function(data)
//     {
//         $(target_modal).html(data);
//         $(form_modal).modal('show');

//     });

// }



function formSubmission(event,obj)
{
    event.preventDefault();

    swal({
        title: "Are you sure",
        text: "you want to "+$(obj).attr('content'),
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


function addThemeLoader() {
    var loaderHTML = '<div class="theme-loader" style="z-index:2052;opacity:0.5"><div class="ball-scale"><div class="contain"><div class="ring"><div class="frame"></div></div><div class="ring"><div class="frame"></div></div><div class="ring"><div class="frame"></div></div><div class="ring"><div class="frame"></div></div><div class="ring"><div class="frame"></div></div><div class="ring"><div class="frame"></div></div><div class="ring"><div class="frame"></div></div><div class="ring"><div class="frame"></div></div><div class="ring"><div class="frame"></div></div><div class="ring"><div class="frame"></div></div></div></div></div>';

    $(loaderHTML).appendTo('body');
}

function removeThemeLoader()
{
    $('.theme-loader').fadeOut('slow', function() {
        $(this).remove();
    });
}

function submitModalForm(event,obj,form_id,form_modal_id)
{

    event.preventDefault();

    var obj = $(form_id);

    var form = document.querySelector(form_id) // Find the <form> element

    var formData = new FormData(form); // Wrap form contents

    var route = obj.attr('action');

    addThemeLoader();

    $.ajax({

        url: route,

        type: obj.attr('method'),

        data: formData,

        dataType: "json",

        contentType: false,

        cache: false,

        processData: false,

        success: function(result) {
// alert(result.status);
            if (result.status) {


               var flag = false;

                if ($(form_modal_id).length > 0) {

                    $(form_modal_id).modal('hide');

                    flag = true;
                }
               
                if (result.redirect_url && result.redirect_url.length > 0) {

                    window.location.href = result.redirect_url;
                }
                else
                {
                location.reload();

                }

                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
                toastr.success(result.message);

                removeThemeLoader();

            } else {

                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
                toastr.error(result.message);

                removeThemeLoader();

            }

        },
        error: function(result){

            removeThemeLoader();
            // alert(result.responseJSON);
            var errors = result.responseJSON.errors;
            $.each(errors, function (key, val) {

                $("#" + key + "_error").text(val[0]);
            });
           
        }
       
    });

}


function importData(event,form_obj,message)
{
    event.preventDefault();
    
    var obj = $(form_obj);
    //To send image
    var form = document.querySelector(form_obj) // Find the <form> element
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

            if (result.status) {
                // Only hide the modal and display success message if the response is successful
                $(form_obj).closest('.modal').modal('hide');
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true
                }
                toastr.success(result.message);
            } else {
                // Handle other cases here, e.g., displaying an error message
                toastr.error(result.message);
            }
            location.reload();
            removeThemeLoader();
        },
        error: function(result)
        {
            // console.log(result.responseJSON);
            // messageToaster(result.responseJSON.status,result.responseJSON.message,result.responseJSON.status);
            var errors = result.responseJSON.errors;
            $.each(errors, function (key, val) {

                $("#" + key + "_error").text(val[0]);
            });
            toastr.error("An error occurred while processing your request.");

            removeThemeLoader();
        }
    });


}

