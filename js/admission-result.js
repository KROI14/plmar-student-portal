$(function(){
    //Create PDf from HTML...

    $('#btn-download').on('click', function(){
        let pdf = $('#pdf').clone().css('display', 'block');
        
        html2pdf().from($(pdf)[0]).save();
    });

});