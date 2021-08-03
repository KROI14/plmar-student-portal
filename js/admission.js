$(function(){

    //Admission List Scripts
    let onProcessRow = $('#table-on-process  tr');
    for(let i = 0; i < onProcessRow.length; i++){
        $(onProcessRow[i]).on('click', function(){
            $('#admission-modal').modal('show');
            $('#admission-modal .modal-header h5').text("On Process Admission");
            $('#admission-modal .modal-body').html(`
                <p>Your admission is currently on process in admission office. Please check the list daily
                    for the update on your admission</p>
            `);
            $('#admission-modal .modal-footer').html(`
                <button class="plmar-btn" data-bs-dismiss="modal">Okay</button>
            `);
        });
    }

    let approvedRow = $('#table-approved tr');
    for(let i = 0; i < approvedRow.length; i++){
        $(approvedRow[i]).on('click', function(){
            $('#admission-modal').modal('show');
            $('#admission-modal .modal-header h5').text("Approved Admission");
            $('#admission-modal .modal-body').html(`
                <p class="phar">Your admission has been approved. Please input your control no.
                to proceed to enrollment.</p>

                <input type="password" class="plmar-input text-center" id="txt-control-no">
            `)
            $('#admission-modal .modal-footer').html(`
                <button class="plmar-btn" id="btn-proceed">Proceed</button>
            `)

            $('#txt-control-no').off('input');
            $('#txt-control-no').on('input', function(){ this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1'); })

            $('#btn-proceed').off('click');
            $('#btn-proceed').on('click', function(){
                let controlNo = approvedRow[i].dataset.controlNo;
                let inputControlNo = $('#txt-control-no').val();
                
                if(controlNo == inputControlNo){
                    $.ajax({
                        url: '../php/SubmitControlNo.php',
                        type: 'POST',
                        data:{
                            'student-id': approvedRow[i].dataset.studentId,
                        },
                        success: function(e){
                            window.location.replace('../pages/enrollment.encoded-subject.php');
                        }
                    })
                }
                else{
                    alert("Incorrect Control No.");
                    $('#admission-modal').modal('hide');
                }
            })
        })
    }

    let rejectedRow = $('#table-rejected tr');
    for(let i = 0; i < rejectedRow.length; i++){
        $(rejectedRow[i]).on('click', function(){
            $('#admission-modal').modal('show');
            $('#admission-modal .modal-header h5').text("Rejected Admission");
            $('#admission-modal .modal-body').html(`
                <p class="title">Your admission has been rejected</p>
                <small class="form-text">Your admission might have:</small>
                <ul>
                    <li>Incomplete documents</li>
                    <li>You might submit incorrect document</li>
                    <li>The admission office failed your admission essay</li>
                    <li>Conflicting of address information and the address in proof of billing</li>
                    <li>Invalid submitted photo</li>
                <ul>
            `);
            $('#admission-modal .modal-footer').html(`
                <button class="plmar-btn" data-bs-dismiss="modal">Okay</button>
            `)
        });
    }



    
    //Old Enrollment
    $('#btn-enter-old-enrollment').on('click', function(){
        let username = $('#username').val();
        let password = $('#password').val();
        let studentID = $('#student-id').val();

        $.ajax({
            url: '../php/SubmitEnrollmentForOldStudent.php',
            type: 'POST',
            data:{
                'username': username,
                'password': password,
                'student-id': studentID
            },
            success: function(e){
                if(e.includes('error')){
                    alert("Incorrect Username, Password or Student ID");
                }
                else{
                    window.location.replace('../pages/enrollment.encoded-subject.php');
                }
            }
        })
    })


    //Terms and agreement
    let url_string = window.location.href;
    let url = new URL(url_string);
    let c = url.searchParams.get("page");
    if(c == "form"){
        $('#terms-conditions').modal('show');
    }

    let fileButtons = $('.input-group button');
    let inputFile = $('.input-group .input-file');

    for(let i = 0; i < fileButtons.length; i++){
        $(fileButtons[i]).on('click', function(){
            let inputFile = $(this).next().next();
            let file = inputFile[0].files;
    
            if(file.length > 0){
                $(inputFile).val("");
                $(this).addClass('plmar-btn').removeClass('btn btn-danger').html('<i class="fas fa-file-upload"></i> Upload File');
                $(this).next().val("");
            }
            else{
                $(inputFile).click();
            }
        })
    
        $(inputFile[i]).on('change', function(){
            let files = this.files;
            $(this).prev().val(files[0].name);
            $(this).prev().prev().html('<i class="far fa-trash-alt"></i> Remove File').addClass('btn btn-danger').removeClass('plmar-btn');
        })
    }

    $(fileButtons[4]).hide();
    $(fileButtons[4]).next().hide();
    $(inputFile[4]).hide();
    $('#select-entry').on('change', function(){
        let value = this.value;
        if(value === "Transferee"){
            $(fileButtons[4]).show();
            $(fileButtons[4]).next().show();
            $(inputFile[4]).show();
        }
        else{
            $(fileButtons[4]).hide();
            $(fileButtons[4]).next().hide();
            $(inputFile[4]).hide();
        }
    });

    $('#btn-submit-form').on('click', function(){
        $('#admission-modal').modal('show');
        $('#admission-modal .modal-header h5').text("Form Validation");

        let isInputTextValid = false;
        let isFilesValid = false;
        let isAdmissionValid = false;

        let inputText = $('.admission-form input[type="text"]');
        for(let i = 0; i < inputText.length; i++){
            let value = $(inputText[i]).val();
            if(value.length > 0){ isInputTextValid = true; } else{ isInputTextValid = false; break; }//Check Input text if populated
        }

        //let imgFile = $('#input-img-file').val();
        //let inputFiles = $('#input-files').val();
        //if(imgFile.length > 0 && inputFiles.length > 0){ isFilesValid = true; } else{ isFilesValid = false; }//Check if files is populated

        for(let i = 0; i < inputFile.length; i++){
            if($(inputFile[i]).val().length > 0 && $('#input-img-file').val().length > 0){
                isFilesValid = true;
            }
        }

        let admissionInput = $('.admission-form select');
        for(let i = 0; i < admissionInput.length; i++){
            let value = $(admissionInput[i]).val();
            if(value.length > 0){ isAdmissionValid = true; } else{ isAdmissionValid = false; break; }//Check if admission infos are populated
        }

        if(isInputTextValid && isFilesValid && isAdmissionValid && ($('input[type="date"]').val().length > 0)){
            $('#admission-modal .modal-body').html(`
                <p>Are you sure you want to submit your admission form?</p>
            `);
            $('#admission-modal .modal-footer').html(`
                <button class="plmar-btn" id="btn-submit">Yes</button>
                <button class="plmar-btn" data-bs-dismiss="modal">No</button>
            `);

            $('#btn-submit').off('click');
            $('#btn-submit').on('click', function(){
                $('#admission-modal').modal('hide');

                $.ajax({
                    url: '../php/AdmissionFormSubmit.php',
                    data: new FormData($('.admission-form')[0]),
                    method: 'POST',
                    contentType: false,
                    processData: false,
                    success: function(res){
                        if(!res.includes('<br>')){
                            let result = JSON.parse(res);
                            if(result.result == true){
                                window.location.replace('../pages/admission-result.php?admid=' + result.admissionID);
                            }
                            else{
                                $('#admission-modal').modal('show');
                                $('#admission-modal .modal-body').html('<p class="phar">Something went wrong with the server. Please try again later</p>');
                                $('#admission-modal .modal-footer').html('<button class="plmar-btn" data-bs-dismiss="modal">Okay</button>');
                            }
                        }
                        else{
                            $('#admission-modal').modal('show');
                            $('#admission-modal .modal-body').html('<p class="phar">Something went wrong with the server. Please try again later</p>');
                            $('#admission-modal .modal-footer').html('<button class="plmar-btn" data-bs-dismiss="modal">Okay</button>');
                        }
                    }
                })
            });
        }
        else{
            $('#admission-modal .modal-body').html(`
                <p>Please complete all input fields and upload all required files</p>
            `);
            $('#admission-modal .modal-footer').html(`
                <button class="plmar-btn" data-bs-dismiss="modal">Okay</button>
            `);
        }
    });

});