$(document).ready(() => {
    $('#signup').on('submit', (event) => {
        event.preventDefault();
        var username = $('#name').val();
        var email = $('#email').val();
        var password = $('#pass').val();
        var formData = new FormData(document.getElementById('signup'));
        if (username !== '' && email !== '' && password !== '') {
            $.ajax({
                url: "./../function/auth/registration.php?action=signup",
                method: 'POST',
                data:formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log(data);
                    var response = JSON.parse(data);
                    Swal.fire({
                        icon: response.status === 'success' ? 'success' : 'error',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    }).then(()=>{
                        window.location.href="./signin.html";
                    })
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Please fill in all fields',
                showConfirmButton: false,
                timer: 2000
            });
        }
    });
    $(document).ready(() => {
        $('#signin').on('submit', (event) => {
            event.preventDefault();
            var email = $('#email').val();
            var password = $('#password').val();
            if (email !== '' && password !== '') {
                $.ajax({
                    url: "./../function/auth/registration.php?action=signin",
                    method: 'POST',
                    data: {
                        email: email,
                        password: password
                    },
                    success: function(data) {
                        var response = JSON.parse(data);
                        Swal.fire({
                            icon: response.status === 'success' ? 'success' : 'error',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            if (response.status === 'success') {
                                var userID = response.userID;
                                sessionStorage.setItem('userid', userID);
                                var role = response.role;
                                console.log(role);
                                if(role=="admin"){
                                    window.location.href="./../project/admin/dashboard.php";
                                }else{
                                    window.location.href = "./../project/home.php";
                                }
                            }
                        });
                    }
                }).fail(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'An error occurred while logging in',
                        showConfirmButton: false,
                        timer: 2000
                    });
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Please fill in all fields',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        });
    });
    
    
});
