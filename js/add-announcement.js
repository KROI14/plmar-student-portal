$(function(){
    $('#btn-post').on('click', function(){
        let title = $('#txt-title').val();
        let content = $('#txt-content').val();
        let type = $('#announce-type').val();

        if(title.length > 0 && content.length > 0){
            if(confirm("Are you sure you want to post this announcement?")){
                $.ajax({
                    url: '../php/SubmitAnnouncement.php',
                    type: 'POST',
                    data:{
                        'title': title,
                        'content': content,
                        'type': type,
                    },
                    success: function(e){
                        if(e.includes("error")){
                            alert("Something went wrong with the system try posting again later");
                        }
                        else{
                            alert("Announcement has been successfully posted");
                            window.location.reload();
                        }
                    }
                });
            }
        }
        else{
            alert("You cannot post an empty announcement");
        }
    });

    let rowAnnounce = $('#table-announcement tr');
    for(let i = 0; i < rowAnnounce.length; i++){
        $(rowAnnounce[i]).on('click', function(){
            $('#modal-announcement').modal('show');
            $('#modal-announcement .modal-content').load('../ajax-pages/ajax.view-announcement.php', {
                'announce-id': this.dataset.announceId,
                'from': 'admin'
            }, function(){
                $('#btn-delete').on('click', function(){
                    if(confirm("Are you sure you want to delete this Announcement?")){
                        $.ajax({
                            url: '../php/DeleteAnnouncement.php',
                            type: 'POST',
                            data:{
                                'announce-id': $(rowAnnounce[i]).data('announceId')
                            },
                            success: function(e){
                                if(e.includes('error')){
                                    alert("Something went wrong. Please try it again later");
                                }
                                else{
                                    alert("Announcement has been successfully deleted");
                                }
                                window.location.reload();
                            }
                        })
                    }
                })
            });
        })
    }
});