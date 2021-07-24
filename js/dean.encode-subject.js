$(function(){

    let schoolYear = $('#school-year').val();
    let department = $('#department').val();

    function toEncodeSubjectFromAdmission(){
        $.getJSON(`../json/GetAdmissionDataForTable.php?sy=${schoolYear}&enroll=to encode&adm-status=on process&yr=&dept=${department}`,function(data){
            let toEncodeHTML = data.map(function(e){
                return `
                    <tr data-student-id="${e.StudentID}">
                        <td>${e.Lastname}</td>
                        <td>${e.Firstname}</td>
                        <td>${e.PreferredCourse}</td>
                    </tr>
                `
            });
    
            $('#to-encode-from-admission-table').html(toEncodeHTML);
        })
        .then(function(e){
            let toEncodeRows = $('#to-encode-from-admission-table tr');
            for(let i = 0; i < toEncodeRows.length; i++){
                $(toEncodeRows[i]).on('click', function(){
                    window.location.replace('../pages/dean.encoded-student-subjects.php?stid=' + this.dataset.studentId);
                });
            }
        });
    }

    function toEncodeSubjectFromOldStudent(){
        $.getJSON('../json/GetToEncodeSubjectsOldStudents.php?type=to encode', function(student){
            let studentHTML = student.map(function(e){
                return `
                    <tr data-student-id="${e.StudentID}" data-student-type="old">
                        <td>${e.StudentID}</td>
                        <td>${e.Lastname}</td>
                        <td>${e.Firstname}</td>
                    </tr>
                `;
            });

            $('#to-encode-old-students').html(studentHTML);
        })
        .then(function(e){
            let toEncodeRows = $('#to-encode-old-students tr');
            for(let i = 0; i < toEncodeRows.length; i++){
                $(toEncodeRows[i]).on('click', function(){
                    window.location.replace('../pages/dean.encoded-student-subjects.php?stid=' + this.dataset.studentId + "&type=" + this.dataset.studentType);
                });
            }
        });
    }

    toEncodeSubjectFromAdmission();
    toEncodeSubjectFromOldStudent();
    setInterval(function(){
        toEncodeSubjectFromAdmission();
        toEncodeSubjectFromOldStudent();
    }, 1000);
})