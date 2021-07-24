$(function(){
    
    $('#btn-encode-subject').click(function(){
        let studentID = $('#student-id').val();
        let admissionID = $('#admission-id').val();
        
        let courseID = $('#course-id').val();
        let yearLevel = $('#year-level').val();
        let semester = $('#semester').val();
        let schoolYear = $('#school-year').val();

        let arrSubject = [];
        let arrDays = [];
        let arrTime = [];
        let arrSection = [];
        
        let subjects = $('#subjects tr');
        let days = $('.select-days');
        let time = $('.select-time');
        let section = $('#subjects tr');

        for(let i = 0; i < subjects.length; i++){
            arrSubject.push(subjects[i].dataset.subjectId);
            arrDays.push(days[i].value);
            arrTime.push(time[i].value);
            arrSection.push(section[i].dataset.section);
        }

        if(arrDays.includes("") || arrTime.includes("")){
            alert("Please Complete the schedule");
        }
        else{
            if(confirm("Are you sure you want to encode these subjects?")){
                $.ajax({
                    url: '../php/SubmitEncodedSubjects.php',
                    type: 'POST',
                    data:{
                        'student-id': studentID,
                        'admission-id': admissionID,
                        'course-id': courseID,
                        'year-level': yearLevel,
                        'semester': semester,
                        'school-year': schoolYear,
                        'arr-subject': arrSubject,
                        'arr-days': arrDays,
                        'arr-time': arrTime,
                        'section': arrSection,
                        'type': $('#student-type').val()
                    },
                    success: function(e){
                        alert("Subjects has been successfully Encoded!");
                        window.location.replace('../pages/dean.encode-subject.php');
                    }
                });
            }
        }

    });
})