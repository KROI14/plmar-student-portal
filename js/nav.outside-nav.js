$(function(){

    let isMenuOpen = false;
    $('#btn-nav-menu').on('click', function(e){
        e.stopPropagation();

        if(isMenuOpen){
            $('nav').css('height', '90px');
            isMenuOpen = false;
        }
        else{
            $('nav').css('height', '220px');
            isMenuOpen = true;
        }
    });

    $('nav ul').on('click', function(e){
        e.stopPropagation();
    })

    $(document).on('click', function(){
        $('nav').css('height', '90px');
        isMenuOpen = false;
    })

})