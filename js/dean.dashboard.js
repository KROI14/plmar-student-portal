$(function(){

    let schoolYears = [];
    let years = [];
    for(let i = 2020; i < 2030; i++){
        schoolYears.push(i + " - " + (i + 1));
        years.push(i);
    }

    let schoolYearsHTML = schoolYears.map(e => `<option value="${e}">${e}</option>`);
    let yearsHTML = years.map(e => `<option value="${e}">${e}</option>`);

    let penControl = $('.control i');

    let controlContainer = $('.control');
    for(let i = 0; i < controlContainer.length; i++){
        $(controlContainer[i]).on('mouseover', function(){
            $(penControl[i]).show();
        })
        .on('mouseout', function(){
            $(penControl[i]).hide();
        });

        $(penControl[i]).on('click', function(){
            let control = this.dataset.control;
            $('#modal-change-status').modal('show');
            if(control == "school-year"){
                $('#modal-change-status .modal-header h5').text('Change Active School Year');
                $('#modal-change-status .modal-body').html(`
                    <p class="title mb-0">School Year</p>
                    <select class="plmar-input"></select>

                    <p class="title mb-0 mt-3">Password</p>
                    <input type="password" class="plmar-input text-center" id="txt-password">
                `);

                $('.modal-body select').html(schoolYearsHTML);
            }
            else{
                $('#modal-change-status .modal-header h5').text('Change Year');
                $('#modal-change-status .modal-body').html(`
                    <p class="title mb-0">Year</p>
                    <select class="plmar-input"></select>

                    <p class="title mb-0 mt-3">Password</p>
                    <input type="password" class="plmar-input text-center" id="txt-password">
                `);

                $('.modal-body select').html(yearsHTML); 
            }

            $('#change-status').on('click', function(){
                let userPassword = $('#user-password').val();
                let txtPassword = $('#txt-password').val();
                
                if(userPassword == txtPassword){
                    $.ajax({
                        url: '../php/ChangeControls.php',
                        type: 'POST',
                        data:{
                            control: control,
                            status: $('#modal-change-status .modal-body select').val()
                        },
                        success: function(e){
                            alert(e);
                            window.location.reload();
                        }
                    })
                }
                else{
                    alert("Incorrect Password");
                }
            })
        });
    }

    //Announcements
    $('#btn-add-announcement').on('click', function(){
        window.location.replace('../pages/add-announcement.php');
    });

    let schoolAnnounce = $('.school-announce a');
    for(let i = 0; i < schoolAnnounce.length; i++){
        $(schoolAnnounce[i]).on('click', function(){
            console.log(schoolAnnounce[i].dataset.announceId);
            $('#modal-announcement').modal('show');
            $('#modal-announcement .modal-content').load('../ajax-pages/ajax.view-announcement.php', {
                'announce-id': $(schoolAnnounce[i]).data('announceId')
            })
        })
    }
});