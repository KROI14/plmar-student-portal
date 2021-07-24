$(function(){

    let schoolYears = [];
    let years = [];
    for(let i = 2020; i < 2030; i++){
        schoolYears.push(i + " - " + (i + 1));
        years.push(i);
    }

    let schoolYearsHTML = schoolYears.map(e => `<option value="${e}">${e}</option>`);
    let yearsHTML = years.map(e => `<option value="${e}">${e}</option>`);

    let editPen = $('.control i.fa-pen');

    let control = $('.control');
    for(let i = 0; i < control.length; i++){
        $(control[i]).on('mouseover', function(){
            $(editPen[i]).show();
        }).on('mouseleave', function(){
            $(editPen[i]).hide();
        })

        $(editPen[i]).on('click', function(){
            $('#modal-change-status').modal('show');
            if(this.dataset.control == "school-year"){
                $('#modal-change-status .modal-header h5').text("School Year");
                $('#modal-change-status .modal-body').html(`
                    <label class="title">Select School Year</label>
                    <select class="plmar-input mb-3"></select>

                    <label class="title">Password</label>
                    <input type="password" class="plmar-input text-center" id="txt-password">
                `);
                $('#modal-change-status .modal-body select').html(schoolYearsHTML);
            }
            else if(this.dataset.control == "semester"){
                $('#modal-change-status .modal-header h5').text("Semester");
                $('#modal-change-status .modal-body').html(`
                    <label class="title">Semester</label>
                    <select class="plmar-input mb-3">
                        <option value="1st Semester">1st Semester</option>
                        <option value="2nd Semester">2nd Semester</option>
                        <option value="Summer">Summer</option>
                    </select>

                    <label class="title">Password</label>
                    <input type="password" class="plmar-input text-center" id="txt-password">
                `);
            }
            else{
                $('#modal-change-status .modal-header h5').text("Year");
                $('#modal-change-status .modal-body').html(`
                    <label class="title">Year</label>
                    <select class="plmar-input mb-3"></select>

                    <label class="title">Password</label>
                    <input type="password" class="plmar-input text-center" id="txt-password">
                `)
                $('#modal-change-status .modal-body select').html(yearsHTML);
            }

            $('#btn-save').off('click');
            $('#btn-save').on('click', function(){
                let control = editPen[i].dataset.control;
                let status = $('#modal-change-status .modal-body select').val();
                let password = $('#txt-password').val();

                if(password == $('#user-pass').val()){
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
                else{
                    alert("Wrong Password");
                    window.location.reload();
                }
            });
        })
    }

    //Announcements
    $('#btn-add-announcement').on('click', function(){
        window.location.replace('../pages/add-announcement.php');
    });

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