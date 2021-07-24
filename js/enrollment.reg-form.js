$(function(){

    setInterval(function(){
        $.getJSON('../json/GetAdmissionEnrollmentStatus.php', function(e){
            // let enrollmentStatus = e.EnrollStatus;
            // if(enrollmentStatus == "payment on process"){
            //     $('.reg-form-container').html('<p class="sub-header mb-0 text-center">Please wait for the approval of your payment, this won\'t take long</p>');
            // }
            // else if(enrollmentStatus == "payment"){
            //     $('.reg-form-container').html(`
            //         <p class="sub-header mb-0 text-center">Your payment has been rejected please proceed to 'Encoded Subjects' page and fix your payment details</p>
            //         <div class="text-center">
            //             <button class="plmar-btn" id="back-to-payment">Proceed to Encoded Subjects</button>
            //         </div>
            //     `);

            //     $('#back-to-payment').on('click', function(){
            //         window.location.replace('../pages/enrollment.encoded-subject.php');
            //     })
            // }
            // else{
            //     $('.reg-form-container').load('../ajax-pages/ajax.registration-form.php', {
            //         'student-id': $('#student-id').val()
            //     });

            //     $('#btn-container').html(`
            //         <button class="plmar-btn" id="btn-register-modal">Register an Account</button>
            //     `)
            // }
            $('.reg-form-container').load('../ajax-pages/ajax.registration-form.php', {
                'student-id': $('#student-id').val()
            });

            $('#btn-container').html(`
                <button class="plmar-btn" id="btn-register-modal">Register an Account</button>
            `)
        }).then(function(e){
            $('#btn-register-modal').on('click', function(){
                $('#modal-account-form').modal('show');
            })
        })
        ;
    }, 1000);



    
    //Account Registration
    $('#txt-username').on('click', function(){
        alert("You cannot change your username due to Security Purposes");
    });

    $('#btn-register').on('click', function(){
        let password = $('#txt-pass').val();
        let passwordConf = $('#txt-pass-confirm').val();

        if(password.length < 8){
            alert("Password should be atleast 8 characters");
        }
        else{
            if(password != passwordConf){
                alert("Password and password confirmation dont match");
            }
            else{
                if(confirm("Are you sure with your password? ")){
                    $.ajax({
                        url: '../php/StudentRegisterAccount.php',
                        type: 'POST',
                        data:{
                            'student-id': $('#student-id').val(),
                            'username': $('#txt-username').val(),
                            'password': password
                        },
                        success: function(e){
                            if(e === "success"){
                                window.location.replace('../pages/user-login.php');
                            }
                            else{
                                alert("Something went wrong with the system. Try again later");
                            }
                        }
                    });
                }
            }
        }
    });


    $('#btn-finish').on('click', function(){
        $.ajax({
            url: '../php/CancelEnrollment.php',
            success: function(e){
                window.location.replace('../pages/user-login.php');
            }
        })
    })
});