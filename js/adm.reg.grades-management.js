$(function(){
    
    let schoolYear = $('#school-year').val();

    //Input section in select-section
    $('#select-course, #select-year-level, #select-semester').on('click', function(){
        let course = $('#select-course').val();
        let yearLevel = $('#select-year-level').val();
        let semester = $('#select-semester').val();

        $.getJSON(`../json/GetListOfSection.php?sy=${schoolYear}&cid=${course}&yr=${yearLevel}&sem=${semester}&type=`, function(sections){
            let sectionHTML = `<option value="">Select Section</option>`;
            sectionHTML += sections.map(val => `<option value="${val.Section}">${val.Section}</option>`);
            console.log(sections);
            $('#select-section').html(sectionHTML);
            $('#select-section').prop('disabled', false);
        });
    });


    $('#select-course, #select-year-level, #select-semester, #select-section').on('click', function(){
        let course = $('#select-course').val();
        let yearLevel = $('#select-year-level').val();
        let semester = $('#select-semester').val();
        let section = $('#select-section').val();
        
        $.getJSON(`../json/GetClassByCourseYearSemSectionSchoolYear.php?cid=${course}&yr=${yearLevel}&sem=${semester}&sec=${section}&sy=${schoolYear}`, function(subjects){
            let subjectHTML = subjects.map(function(val){
                return `
                    <tr data-subject-code="${val.SubjectCode}" data-admin-id="${val.AdminID}">
                        <td>${val.SubjectCode}</td>
                        <td>${val.Description}</td>
                        <td>${val.Day} ${val.Time}</td>
                        <td>${val.Firstname} ${val.Lastname}</td>
                        <td>${val.Units}</td>
                    </tr>
                `;
            }).join('');
            $('#table-subject').html(subjectHTML);
        })
        .then(function(){
            let row = $('#table-subject tr');
            for(let i = 0; i < row.length; i++){
                $(row[i]).on('click', function(){
                    $('#modal-grade-list .modal-content').load('../ajax-pages/ajax.adm-reg.on-process-grades.php', {
                        'subject-code': $(row[i]).data('subjectCode'),
                        'school-year': schoolYear,
                        'section': section,
                        'admin-id': $(row[i]).data('adminId')
                    },
                    function(){
                        $('#modal-grade-list').modal('show');

                        $('#btn-update').on('click', function(){
                            if(confirm("Are you sure you want to update these grades?")){
                                let selectData = $('.subject-status');
                                let gradeID = [];
                                let status = [];
                                
                                for(let i = 0; i < selectData.length; i++){
                                    gradeID.push(selectData[i].dataset.gradeId);
                                    status.push(selectData[i].value);
                                }
    
                                $.ajax({
                                    url: '../php/UpdateGradeStatus.php',
                                    type: 'POST',
                                    data:{
                                        'grade-id': gradeID,
                                        'status': status,
                                    },
                                    success: function(e){
                                        if(e.includes('error')){
                                            alert("Something went wrong with the system please try it again later");
                                        }
                                        else{
                                            alert("Grade Status has been updated successfully");
                                            $('#modal-grade-list').modal('hide');
                                        }
                                    }
                                });
                            }
                        });

                        
                        let subStatus = $('.subject-status');
                        let prevStatus = [];

                        for(let i = 0; i < subStatus.length; i++){
                            prevStatus.push(subStatus[i].value);
                        }

                        $('#check-all').on('change', function(){

                            if($(this).is(':checked')){
                                $('.subject-status').val('approved');
                            }
                            else{
                                for(let i = 0; i < prevStatus.length; i++){
                                    $(subStatus).val(prevStatus[i]);
                                }
                            }
                        });
                    });
                });
            }
        });
    });

   
    $.ajax({
        url: '../ajax-pages/ajax.encoding-of-grades-schedule.php',
        success:function(e){
            if(e == false){
                $('.card-container').hide();
                $('.close-message').show();
            }
            else{
                $('.card-container').show();
                $('.close-message').hide();
            }
        }
    });
    setInterval(function(){
        $.ajax({
            url: '../ajax-pages/ajax.encoding-of-grades-schedule.php',
            success:function(e){
                if(e == false){
                    $('.card-container').hide();
                    $('.close-message').show();
                }
                else{
                    $('.card-container').show();
                    $('.close-message').hide();
                }
            }
        });
    }, 1000);
})