$(function(){

    let schoolYear = $('#school-year').val();
    let department = $('#department').val();
    let faculty = JSON.parse($('#faculty').val());

    //Pagka select ng course makikita e enable yung section and makikita kung ilan ang section
    $('#select-course, #select-year-level, #select-semester').on('change', function(){
        let courseID = $('#select-course').val();
        let yearLevel = $('#select-year-level').val();
        let semester = $('#select-semester').val();

        $.getJSON(`../json/GetListOfSection.php?sy=${schoolYear}&cid=${courseID}&yr=${yearLevel}&sem=${semester}&type=major`, function(sections){
            let sectionHTML = '<option value="">Select Section</option>';
            sectionHTML += sections.map(function(val){
                return `<option value="${val.Section}">${val.Section}</option>`;
            }).join('');

            $('#select-section').html(sectionHTML).prop('disabled', false);
        })
    });

    $('#select-course, #select-year-level, #select-semester, #select-section').on('change', function(){
        let course = $('#select-course').val();
        let yearLevel = $('#select-year-level').val();
        let semester = $('#select-semester').val();
        let section = $('#select-section').val();

        $.getJSON(`../json/GetMajorClassToAddInstructor.php?sy=${schoolYear}&cid=${course}&yr=${yearLevel}&sem=${semester}&sec=${section}&dept=${department}`,function(subject){
            let subjectHTML = subject.map(function(val){

                let facultyOption = faculty.map(function(f){
                    if(f.AdminID == val.AdminID){
                        return `<option value="${f.AdminID}" selected>${f.Firstname} ${f.Lastname}</option>`;
                    }
                    else{
                        return `<option value="${f.AdminID}">${f.Firstname} ${f.Lastname}</option>`;
                    }
                }).join('');

                return `
                    <tr>
                        <td>${val.SubjectCode}</td>
                        <td>${val.Description}</td>
                        <td>${val.Day} ${val.Time}</td>
                        <td>
                            <select class="plmar-input select-instructor" data-subject-id="${val.SubjectID}">
                                <option value="null">Select Instructor</option>
                                ${facultyOption}
                            </select>
                        </td>
                        <td>${val.Units}</td>
                    </tr>`;
            }).join('');

            $('#table-subjects').html(subjectHTML);
        });
    });

    $('#btn-save-major').on('click', function(){
        let subjectID = $('.select-instructor');
        let instructor = $('.select-instructor');
        
        let arrSubjectID = [];
        let arrInstructor = [];

        for(let i = 0; i < subjectID.length; i++){
            arrSubjectID.push(subjectID[i].dataset.subjectId);
            arrInstructor.push(instructor[i].value);
        }
        
        if(arrSubjectID.length <= 0 || arrInstructor.length <= 0){
            alert("Subject table or Grade input is empty");
        }
        else{
            if(confirm("Are you sure you want to assign these instructors?")){
                $.ajax({
                    url: '../php/AddInstructorToSubject.php',
                    type: 'POST',
                    data:{
                        'subjects': arrSubjectID,
                        'admin': arrInstructor,
                        'section': $('#select-section').val(),
                        'school-year': schoolYear
                    },
                    success: function(e){
                        alert("Instructor has been successfully assigned");
                    }
                });
            }
        }
    })
    

    $('.modal #select-course, .modal #select-year-level, .modal #select-semester').on('change', function(){
        let courseID = $('.modal #select-course').val();
        let yearLevel = $('.modal #select-year-level').val();
        let semester = $('.modal #select-semester').val();

        $.getJSON(`../json/GetListOfSection.php?sy=${schoolYear}&cid=${courseID}&yr=${yearLevel}&sem=${semester}&type=major`, function(sections){
            let sectionHTML = '<option value="">Select Section</option>';
            sectionHTML += sections.map(function(val){
                return `<option value="${val.Section}">${val.Section}</option>`;
            }).join('');

            $('.modal #select-section').html(sectionHTML).prop('disabled', false);
        })
    });

    //Modal for Minor subjects
    $('.modal #select-course, .modal #select-year-level, .modal #select-semester, .modal #select-section').on('change', function(){
        let courseID = $('.modal #select-course').val();
        let yearLevel = $('.modal #select-year-level').val();
        let semester = $('.modal #select-semester').val();
        let section = $('.modal #select-section').val();

        $.getJSON(`../json/GetMinorClassToAddInstructor.php?sy=${schoolYear}&yr=${yearLevel}&sem=${semester}&sec=${section}&cid=${courseID}`, function(subject){
            let subjectsHTML = subject.map(function(val){
                let options = `<option value="null">Select Instructor</option>`;
                for(let i = 0; i < faculty.length; i++){
                    if(val.AdminID == faculty[i].AdminID){
                        options += `<option value="${faculty[i].AdminID}" selected>${faculty[i].Firstname} ${faculty[i].Lastname}</option>`
                    }
                    else{
                        options += `<option value="${faculty[i].AdminID}">${faculty[i].Firstname} ${faculty[i].Lastname}</option>`
                    }
                }

                return `
                    <tr>
                        <td>${val.SubjectCode}</td>
                        <td>${val.Description}</td>
                        <td>${val.Day} ${val.Time}</td>
                        <td>
                            <select class="plmar-input select-minor-instructor" data-subject-id="${val.SubjectID}">${options}</option>
                        </td>
                        <td>${val.Units}</td>
                    </tr>
                `
            }).join('');

            console.log(subject);

            $('#table-minor-subjects').html(subjectsHTML);
        });
    });

    //Save minor subjects
    $('#save-minor-subject').on('click', function(){
        let subjectID = $('.modal .select-minor-instructor');
        let instructor = $('.modal .select-minor-instructor');
        
        let arrSubjectID = [];
        let arrInstructor = [];

        for(let i = 0; i < subjectID.length; i++){
            arrSubjectID.push(subjectID[i].dataset.subjectId);
            arrInstructor.push(instructor[i].value);
        }

        if(arrSubjectID.length <= 0 || arrInstructor.length <= 0){
            alert("Subject table or Grade input is empty");
        }
        else{
            if(confirm("Are you sure you want to assign these instructors?")){
                $.ajax({
                    url: '../php/AddInstructorToSubject.php',
                    type: 'POST',
                    data:{
                        'subjects': arrSubjectID,
                        'admin': arrInstructor,
                        'section': $('.modal #select-section').val(),
                        'school-year': schoolYear
                    },
                    success: function(e){
                        alert("Instructors has beeen successfully assigned");
                        window.location.reload();
                    }
                });
            }
        }
    });


    $('.modal').on('hide.bs.modal', function(){
        $('#table-minor-subjects').html('');
        $('.modal #select-course').val('');
        $('.modal #select-year-level').val('');
        $('.modal #select-semester').val($('#select-semester').val());
        $('.modal #select-section').val('');
    })
})