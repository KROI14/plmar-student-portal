$(function(){
    let schoolYear = $('#school-year').val();
    let year = "";

    function onProcessAdmissionList(){
        $.getJSON(`../json/GetAdmissionDataForTable.php?sy=${schoolYear}&enroll=&adm-status=on process&yr=${year}&dept=`, function(data){
            let onProcessHTML = data.map(val => {
                return `
                    <tr data-student-id="${val.StudentID}">
                        <td>${val.AdmissionID}</td>
                        <td>${val.Lastname + ", " + val.Firstname + " " + val.Middlename}</td>
                        <td>${val.CreatedAt}</td>
                    </tr>
                `
            })
    
            $('#table-on-process').html(onProcessHTML);
        })
        .then(function(){
            let row = $('#table-on-process tr');
            for(let i = 0; i < row.length; i++){
                $(row[i]).on('click', function(){
                    window.location.href = "../pages/adm.reg.admission-info.php?stid=" + this.dataset.studentId;
                })
            }
        });
    }

    function approvedAdmissionList(){
        $.getJSON(`../json/GetAdmissionDataForTable.php?sy=${schoolYear}&enroll=&adm-status=approved&yr=${year}&dept=`, function(data){
            let onProcessHTML = data.map(val => {
                return `
                    <tr data-student-id="${val.StudentID}">
                        <td>${val.AdmissionID}</td>
                        <td>${val.Lastname + ", " + val.Firstname + " " + val.Middlename}</td>
                        <td>${val.CreatedAt}</td>
                    </tr>
                `
            })
    
            $('#table-approved').html(onProcessHTML);
        });
    }

    function rejectedAdmissionList(){
        $.getJSON(`../json/GetAdmissionDataForTable.php?sy=${schoolYear}&enroll=&adm-status=rejected&yr=${year}&dept=`, function(data){
            let onProcessHTML = data.map(val => {
                return `
                    <tr data-student-id="${val.StudentID}">
                        <td>${val.AdmissionID}</td>
                        <td>${val.Lastname + ", " + val.Firstname + " " + val.Middlename}</td>
                        <td>${val.CreatedAt}</td>
                    </tr>
                `
            });
    
            $('#table-rejected').html(onProcessHTML);
        });
    }

    onProcessAdmissionList();
    approvedAdmissionList();
    rejectedAdmissionList();
     
    setInterval(function(){
        onProcessAdmissionList();
        approvedAdmissionList();
        rejectedAdmissionList();
    }, 1000);

});