$(function(){

    $('#btn-login').on('click', function(){
        let username = $('#txt-username').val();
        let password = $('#txt-password').val();
        let usertype = $('#user-type').val();
        
        $.ajax({
            url: '../php/UserLoginSubmit.php',
            data:{
                username: username,
                password: password,
                usertype: usertype
            },
            type: 'POST',
            success: function(e){
                if(e.includes("error")){
                    $('#modal-login-result').modal('show');
                }
                else{
                    let res = JSON.parse(e);
                    if(res.res == true){
                        if(usertype == "admin"){
                            if(res.dept == "REGISTRAR"){
                                window.location.replace('../pages/adm.reg.dashboard.php');
                            }
                            else{
                                window.location.replace('../pages/adm.bur.dashboard.php');
                            }
                        }
                        else if(usertype =="dean"){
                            window.location.replace('../pages/dean.dashboard.php');
                        }
                        else if(usertype == "student"){
                            window.location.replace('../pages/stud.dashboard.php');
                        }
                        else if(usertype == "faculty"){
                            window.location.replace('../pages/faculty.dashboard.php');
                        }
                    }
                    else{
                        $('#modal-login-result').modal('show');
                    }
                }
            }
        });
    });

});