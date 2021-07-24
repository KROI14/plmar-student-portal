$(function(){

    let students = $('#table-students tr');
    for(let i = 0; i < students.length; i++){
        $(students[i]).on('click', function(){
            $('#modal-student-info .modal-body').load('../ajax-pages/ajax.student-info-from-master-list.php',{
                'student-id': this.dataset.studentId
            }, function(){
                $('#modal-student-info').modal('show');
            });
        });
    }

})