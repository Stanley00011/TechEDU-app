$(document).ready(function() {
    var form = $('#contactForm');
    form.submit(function(event) {
      event.preventDefault();
  
      var fname = $('#fname').val();
      var email = $('#email').val();
      var subject = $('#subject').val();
      var message = $('#message').val();
  
      $.ajax({
        type: 'POST',
        url: './function/contact/contact.php?action=addContactDetails',
        data: {
          firstName: fname,
          contactEmail: email,
          subject: subject,
          msgBody: message
        },
        success: function(response) {
         if(response.success=="success") {
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: response.message,
                showConfirmButton: false, 
                timer: 2000 
              });
         }else{
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: response.message,
                showConfirmButton: false, 
                timer: 2000 
              });
         }
       
        },
        error: function() {
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred during the request.',
            showConfirmButton: false, // Remove the "OK" button
            timer: 2000 // Auto close the pop-up after 2 seconds
          });
        }
      });
    });
  });
  