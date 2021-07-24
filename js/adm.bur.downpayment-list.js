$(function(){

    let schoolYear = $('#school-year').val();
    let semester = $('#semester').val();

    function onProcessDownpayments(){
        $.getJSON(`../json/GetDownpaymentApprovalDataForTable.php?st=on process&sy=${schoolYear}&sem=${semester}`, function(downpayments){
            let dataHTML = downpayments.map(function(val){
                return `
                    <tr data-approval-id="${val.ApprovalID}" data-student-id="${val.StudentID}">
                        <td>${val.Lastname}, ${val.Firstname} ${val.Middlename}</td>
                        <td>${val.PaymentMode}</td>
                        <td>${val.Bank}</td>
                        <td>${val.CreatedAt}</td>
                    </tr>
                `;
            }).join('');

            $('#on-process-payments').html(dataHTML);
        })
        .then(function(e){
            let downpaymentRows = $('#on-process-payments tr');
            for(let i = 0; i < downpaymentRows.length; i++){
                $(downpaymentRows[i]).on('click', function(){
                    $('#modal-payment-info .modal-content').load('../ajax-pages/ajax.on-process-downpayment-info.php', {
                        'approval-id': this.dataset.approvalId,
                        'student-id': this.dataset.studentId
                    },
                    function(){
                        $('#modal-payment-info').modal('show');

                        $('#btn-submit-payment').off('click')
                        $('#btn-submit-payment').on('click', function(){
                            if(confirm("Are you sure you want to record this payment")){
                                if($('#amount-paid').val().length > 0 && $('#date-paid').val().length > 0){
                                    $.ajax({
                                        url: '../php/SubmitOfficialDownpayment.php',
                                        type: 'POST',
                                        data:{
                                            'amount-paid': $('#amount-paid').val(),
                                            'date-paid': $('#date-paid').val(),
                                            'payment-mode': $('#payment-mode').val(),
                                            'academic-id': $('#academic-id').val(),
                                            'approval-id': $('#approval-id').val(),
                                            'tuition-fee': $('#tuition-fee').val(),
                                            'misc-fee': $('#misc-fee').val(),
                                            'residency': $('#residency').val(),
                                            'status': $('#btn-submit-payment').data('status'),
                                            'admission-id': $('#admission-id').val(),
                                            'student-id': $(downpaymentRows[i]).data('studentId')
                                        },
                                        success: function(e){
                                            if(e == "success - approved"){
                                                alert("Payment has been approved");
                                            }
                                            else{
                                                alert("Something went wrong with the server. Please try it later");
                                            }
                                            window.location.reload();
                                        }
                                    });
                                }
                                else{
                                    alert("Please Complete the approval Inputs");
                                }
                            }
                        });

                        $('#btn-reject-payment').off('click');
                        $('#btn-reject-payment').on('click', function(){
                            if(confirm("Are you sure you want to reject the payment?")){
                                $.ajax({
                                    url: '../php/SubmitOfficialDownpayment.php',
                                    type: 'POST',
                                    data:{
                                        'approval-id': $('#approval-id').val(),
                                        'admission-id': $('#admission-id').val(),
                                        'status': $('#btn-reject-payment').data('status')
                                    },
                                    success: function(e){
                                        if(e == "success - rejected"){
                                            alert("Payment has been Rejected")
                                            window.location.reload();
                                        }
                                        else{
                                            alert("Something went wrong with the server. Please try it later")
                                        }
                                    }
                                });
                            }
                        })
                    });
                })
            }
        });
    }

    function approvedDownpayments(){
        $.getJSON(`../json/GetDownpaymentApprovalDataForTable.php?st=approved&sy=${schoolYear}&sem=${semester}`, function(downpayments){
            let dataHTML = downpayments.map(function(val){
                return `
                    <tr data-approval-id="${val.ApprovalID}" data-student-id="${val.StudentID}">
                        <td>${val.Lastname}, ${val.Firstname} ${val.Middlename}</td>
                        <td>${val.PaymentMode}</td>
                        <td>${val.Bank}</td>
                        <td>${val.CreatedAt}</td>
                    </tr>
                `;
            }).join('');

            $('#approved-payments').html(dataHTML);
        })
        .then(function(e){
            let approved = $('#approved-payments tr');
            for(let i = 0; i < approved.length; i++){
                $(approved[i]).on('click', function(){
                    $('#modal-payment-info').modal('show');
                    $('#modal-payment-info .modal-content').load('../ajax-pages/ajax.processed-downpayment-info.php', {
                        'approval-id': this.dataset.approvalId,
                        'student-id': this.dataset.studentId
                    });
                });
            }
        })
    }


    function rejectedDownpayments(){
        $.getJSON(`../json/GetDownpaymentApprovalDataForTable.php?st=rejected&sy=${schoolYear}&sem=${semester}`, function(downpayments){
            let dataHTML = downpayments.map(function(val){
                return `
                    <tr data-approval-id="${val.ApprovalID}" data-student-id="${val.StudentID}">
                        <td>${val.Lastname}, ${val.Firstname} ${val.Middlename}</td>
                        <td>${val.PaymentMode}</td>
                        <td>${val.Bank}</td>
                        <td>${val.CreatedAt}</td>
                    </tr>
                `;
            }).join('');

            $('#rejected-payments').html(dataHTML);
        })
        .then(function(e){
            let rejected = $('#rejected-payments tr');
            for(let i = 0; i < rejected.length; i++){
                $(rejected[i]).on('click', function(){
                    $('#modal-payment-info').modal('show');
                    $('#modal-payment-info .modal-content').load('../ajax-pages/ajax.processed-downpayment-info.php', {
                        'approval-id': this.dataset.approvalId,
                        'student-id': this.dataset.studentId
                    });
                })
            }
        })
    }


    onProcessDownpayments();
    approvedDownpayments();
    rejectedDownpayments();

    setInterval(function(){
        onProcessDownpayments();
        approvedDownpayments();
        rejectedDownpayments();
    }, 2000);
});