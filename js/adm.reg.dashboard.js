$(function(){

    let schoolYears = [];
    let years = [];
    for(let i = 2020; i < 2030; i++){
        schoolYears.push(i + " - " + (i + 1));
        years.push(i);
    }

    let schoolYearsHTML = schoolYears.map(e => `<option value="${e}">${e}</option>`);
    let yearsHTML = years.map(e => `<option value="${e}">${e}</option>`);

    let penIcon = $('.control i');
    let controlStatus = $('.control');
    for(let i = 0; i < controlStatus.length; i++){
        $(controlStatus[i]).on('mouseenter', function(){ $(penIcon[i]).show();  })
        .on('mouseleave', function(){ $(penIcon[i]).hide(); });

        $(penIcon[i]).on('click', function(){
            $('#modal-change-status').modal('show');
            if(this.dataset.control == "enrollment-status"){
                $('#modal-change-status .modal-header h5').text("Enrollment Status");
                $('#modal-change-status .modal-body').html(`
                    <p class="title mb-0">Status</p>
                    <select class="plmar-input">
                        <option value="Open">Open</option>
                        <option value="Close">Close</option>
                    </select>

                    <p class="title mb-0 mt-3">Password</p>
                    <input type="password" class="plmar-input text-center" id="txt-password">
                `);
            }
            else if(this.dataset.control == "enrollment-semester"){
                $('#modal-change-status .modal-header h5').text("Enrollment Semester");
                $('#modal-change-status .modal-body').html(`
                    <p class="title mb-0">Semester</p>
                    <select class="plmar-input">
                        <option value="1st Semester">1st Semester</option>
                        <option value="2nd Semester">2nd Semester</option>
                        <option value="Summer">Summer</option>
                    </select>

                    <p class="title mb-0 mt-3">Password</p>
                    <input type="password" class="plmar-input text-center" id="txt-password">
                `);
            }
            else if(this.dataset.control == "enrollment-school-year"){
                $('#modal-change-status .modal-header h5').text("Enrollment School Year");
                $('#modal-change-status .modal-body').html(`
                    <p class="title mb-0">School Year</p>
                    <select class="plmar-input"></select>

                    <p class="title mb-0 mt-3">Password</p>
                    <input type="password" class="plmar-input text-center" id="txt-password">
                `);
                $('.modal-body select').html(schoolYearsHTML);
            }
            else if(this.dataset.control == "school-year"){
                $('#modal-change-status .modal-header h5').text("Active School Year");
                $('#modal-change-status .modal-body').html(`
                    <p class="title mb-0">School Year</p>
                    <select class="plmar-input"></select>

                    <p class="title mb-0 mt-3">Password</p>
                    <input type="password" class="plmar-input text-center" id="txt-password">
                `);
                $('.modal-body select').html(schoolYearsHTML);
            }
            else if(this.dataset.control == "year"){
                $('#modal-change-status .modal-header h5').text("Active School Year");
                $('#modal-change-status .modal-body').html(`
                    <p class="title mb-0">Year</p>
                    <select class="plmar-input"></select>

                    <p class="title mb-0 mt-3">Password</p>
                    <input type="password" class="plmar-input text-center" id="txt-password">
                `);
                $('.modal-body select').html(yearsHTML);
            }
            else if(this.dataset.control == "subject-encode"){
                $('#modal-change-status .modal-header h5').text("Subject Encoding Status");
                $('#modal-change-status .modal-body').html(`
                    <label class="phar">Starting Date</label>
                    <input type="datetime-local" class="plmar-input" id="start-date">

                    <label class="phar mt-3">Deadline Date</label>
                    <input type="datetime-local" class="plmar-input" id="end-date">

                    <p class="title mb-0 mt-3">Password</p>
                    <input type="password" class="plmar-input text-center" id="txt-password">
                `);
            }
            
            $('#btn-save').off('click');
            $('#btn-save').on('click', function(){
                let control = penIcon[i].dataset.control;
                let status = $('.modal-body select').val();
                let password = $('#txt-password').val();

                if(password == $('#user-pass').val()){
                    if(control == "subject-encode"){
                        $.ajax({
                            url: '../php/SubmitEncodingGradesSchedule.php',
                            type: 'POST',
                            data:{
                                'start-date': $('#modal-change-status #start-date').val(),
                                'end-date': $('#modal-change-status #end-date').val()
                            },
                            success: function(e){
                                if(e.includes('error')){
                                    alert("Something went wrong in the system please try it later");
                                }
                                else{
                                    alert("Schedule of encoding of grades has been set");
                                }
                                window.location.reload();
                            }
                        });
                    }
                    else{
                        $.ajax({
                            url: '../php/ChangeControls.php',
                            type: 'POST',
                            data:{
                                control: control,
                                status: status
                            },
                            success: function(e){
                                alert(e);
                                window.location.reload();
                            }
                        });
                    }
                }
                else{
                    alert("Wrong Password");
                    window.location.reload();
                }
            });
        });
    }

    $('#modal-change-status').on('hide.bs.modal', function(){
        $('#txt-password').val('');
    });


    //Announcements
    $('#btn-add-announcement').on('click', function(){
        window.location.replace('../pages/add-announcement.php');
    })

    let schoolAnnounce = $('.school-announce a');
    for(let i = 0; i < schoolAnnounce.length; i++){
        $(schoolAnnounce[i]).on('click', function(){
            $('#modal-announcement').modal('show');
            $('#modal-announcement .modal-content').load('../ajax-pages/ajax.view-announcement.php', {
                'announce-id': $(schoolAnnounce[i]).data('announceId')
            })
        })
    }
});