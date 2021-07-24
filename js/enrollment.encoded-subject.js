$(function(){
    //Payment mode
    let paymentMode = $('input[type="radio"][name="payment-mode"]:checked').val();
    if(paymentMode == "Full Payment"){
        $('#full-payment').show();
        $('#installment').hide();
    }
    else{
        $('#full-payment').hide();
        $('#installment').show();
    }
    
    $('input[type="radio"][name="payment-mode"]').on('change', function(){
        if(this.value == "Full Payment"){
            $('#full-payment').show();
            $('#installment').hide();
        }
        else{
            $('#full-payment').hide();
            $('#installment').show();
        }
    })


    //Bank options
    // $('#disp-bdo').show();
    // $('#disp-bpi').hide();
    // $('#disp-gcash').hide();

    // $('input[type="radio"][name="bank"]').on('change', function(){
    //     switch(this.value){
    //         case "Banco de Oro":{
    //             $('#disp-bdo').show();
    //             $('#disp-bpi').hide();
    //             $('#disp-gcash').hide();
    //         }
    //         break;
    //         case "Bank of Philippine Island":{
    //             $('#disp-bdo').hide();
    //             $('#disp-bpi').show();
    //             $('#disp-gcash').hide();
    //         };
    //         break;
    //         case "GCash":{
    //             $('#disp-bdo').hide();
    //             $('#disp-bpi').hide();
    //             $('#disp-gcash').show();
    //         }
    //         break;
    //     }
    // });


    // let fileInput = $('input[type="file"]');
    // $('#btn-file-explorer').on('click', function(){
    //     if($(fileInput).val().length > 0){
    //         $('#btn-file-explorer').addClass('plmar-btn').removeClass('btn btn-danger');
    //         $('#btn-file-explorer').html('<i class="fas fa-file-upload"></i> Upload File');
    //         $(fileInput).val("");
    //         $('#file-output').val("");
    //     }
    //     else{
    //         $(fileInput).click();
    //     }
    // });
    // $(fileInput).on('change', function(){
    //     $('#file-output').val(this.files[0].name);
    //     $('#btn-file-explorer').removeClass('plmar-btn').addClass('btn btn-danger');
    //     $('#btn-file-explorer').html('<i class="far fa-trash-alt"></i> Remove File');
    // });


    $('#btn-submit-payment').on('click', function(){
        //if($('#file-output').val().length > 0 ){
            if(confirm("Are you sure with your payment Information?")){
                // let formData = new FormData();
                // formData.append('academic-id', $('#academic-id').val());
                // formData.append('payment-mode', $('input[type="radio"][name="payment-mode"]:checked').val());
                // formData.append('bank', $('input[type="radio"][name="bank"]:checked').val());
                // formData.append('payment-file', $('input[type="file"]')[0].files[0]);
                // formData.append('admission-id', $('#admission-id').val())

                // $.ajax({
                //     url: '../php/SubmitApprovalDownpayment.php',
                //     type: 'POST',
                //     data: formData,
                //     contentType: false,
                //     processData: false,
                //     cache: false,
                //     success: function(e){
                //         if(e.includes("error")){
                //             alert("Something went wrong with the system, Try again later");
                //         }
                //         else{
                //             window.location.replace('../pages/enrollment.reg-form.php');
                //         }
                //     }
                // })
                let paymentMode = $('input[type="radio"][name="payment-mode"]:checked').val();
                let academicID = $('#academic-id').val();
                let tuitionFee = $('#tuition-fee').val();
                let miscFee = $('#misc-fee').val();
                let residency = $('#residency').val();
                let amountPaid = $('#amount-paid').val();
                let studentID = $('#student-id').val();
                let admissionID = $('#admission-id').val();

                $.ajax({
                    url: '../php/SubmitOfficialDownpayment.php',
                    type: 'POST',
                    data: {
                        'student-id': studentID,
                        'status': "approved",
                        'amount-paid': amountPaid,
                        'payment-mode': paymentMode,
                        'academic-id': academicID,
                        'tuition-fee': tuitionFee,
                        'misc-fee': miscFee,
                        'residency': residency,
                        'admission-id': admissionID
                    },
                    success: function(e){
                        window.location.replace('../pages/enrollment.reg-form.php');
                    }
                });
            }
        //}
        // else{
        //     alert("Input your transfer receipt");
        // }
    });
});