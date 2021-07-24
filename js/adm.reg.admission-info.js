$(function(){
    //Updating admission(Enrollment information)
    $('#btn-update-admission').on('click', function(){
        if(confirm("Are you sure you want to update the admission?")){
            let residency = $('input[type="radio"][name="residency"]:checked').val();
            let selectEnrollStatus = $('#enrollment-status').val();
            
            $.ajax({
                url: '../php/UpdateResidencyEnrollmentStatus.php',
                type: 'POST',
                data:{
                    'residency': residency,
                    'enroll-status': selectEnrollStatus,
                    'admission-id': $('#admission-id').val(),
                    'student-id': $('#student-id').val()
                },
                success: function(res){
                    alert("Admission has been updated")
                    window.location.reload();
                }
            });
        }
    });
    
    $('#btn-submit-grades').hide();

    $('#btn-enter').on('click', function(){
        let course = $('#select-course').val();
        let yearLevel = $('#select-year').val();
        let semester = $('#select-semester').val();
        let schoolYear = $('#select-school-year').val();
        
        if(!(course == "" || yearLevel == "" || semester == "" || schoolYear == "")){
            $.getJSON(`../json/GetSubjectByAcademicInfo.php?cid=${course}&yr=${yearLevel}&sem=${semester}`, function(subjects){
                let subjectHTML = subjects.map(e => {
                    return`
                        <tr>
                            <td>${e.SubjectCode}</td>
                            <td>${e.Description}</td>
                            <td>${e.Units}</td>
                            <td>
                                <select class="select-grade plmar-input" data-subject-code="${e.SubjectCode}">
                                </select>
                            </td>
                        </tr>
                    `
                }).join('');

                $('#subject-table').html(subjectHTML);
            }).
            //Render Grades dictionary into select after rendering the subjects
            then(function(){
                $.getJSON('../json/GetGradeDictionary.php', function(grades){
                    let gradesHTML = grades.map(e => `<option value="${e.Grade}">${e.Grade} / ${e.Remarks}</option>`);
                    $('.select-grade').html(gradesHTML);
                })
                .then(function(){
                    $('#btn-submit-grades').show();

                    $('#btn-submit-grades').off('');
                    $('#btn-submit-grades').on('click', function(){
                        if(confirm("Are you sure you want to input these grades. You cannot Edit this in the future")){
                            let subjectCodes = [];
                            let subjectGrades = [];
                            let selectGrades = $('#subject-table .select-grade');
                            for(let i = 0; i < selectGrades.length; i++){
                                if(selectGrades[i].value != "no grades"){
                                    subjectCodes.push(selectGrades[i].dataset.subjectCode);
                                    subjectGrades.push(selectGrades[i].value);
                                }
                            }

                            $.ajax({
                                url: '../php/SubmitGradeTranscriptRecord.php',
                                type: 'POST',
                                data:{
                                    'subject-code': subjectCodes,
                                    'grades': subjectGrades,
                                    'student-id': $('#student-id').val(),
                                    'course': course,
                                    'year-level': yearLevel,
                                    'semester': semester,
                                    'school-year': schoolYear
                                },
                                success: function(res){
                                    if(!res.includes("error")){
                                        let jsonRes = JSON.parse(res);
                                        if(jsonRes['academic-info-res'] == true && jsonRes['grades-result'] == true){
                                            alert("Student Academic Information has been recorded successfully");
                                        }
                                        else{
                                            alert("Student Academic Information has been already recorded");
                                        }
                                        window.location.reload();
                                    }
                                    else if(res.includes("Undefined array key")){
                                        alert("Please input atleast one grade");
                                    }
                                    else{
                                        alert("Something went wrong with the system please try it again later");
                                        window.location.reload();
                                    }
                                }
                            });
                        }
                    });
                })
            });
        }
        else{
            alert("Please complete the academic information");
        }
    });

    $('#grade-transcript-modal').on('hidden.bs.modal', function(){
        $('#btn-submit-grades').hide();

        $('#subject-table').html('');

        $('#select-course').val('');
        $('#select-year').val('');
        $('#select-semester').val('');
        $('#select-school-year').val('');
    });


    $('#btn-reject-admission').on('click', function(){
        if(confirm("Are you sure you want to reject this admission? You cannot edit this anymore")){
            $.ajax({
                url: '../php/RejectAdmission.php',
                type: 'POST',
                data:{
                    'admission-id': $('#admission-id').val(),
                },
                success: function(e){
                    alert("Admission has been rejected successfully");
                    window.location.reload();
                }
            })
        }
    })
});