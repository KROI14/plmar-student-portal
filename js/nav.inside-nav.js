$(function(){

    let isMenuOpen = false;
    $('#btn-menu').on('click', function(e){
        e.stopPropagation();
        if(isMenuOpen){
            $('aside').css('left', '-240px');
            isMenuOpen = false;
        }
        else{
            $('aside').css('left', '0px');
            isMenuOpen = true;

            $('.profile-container').css('right', '-230px');
            isProfileOpen = false;
        }
    });
    
    $('aside').on('click', function(e){
        e.stopPropagation();
    })

    let isProfileOpen = false;
    $('#btn-account').on('click', function(e){
        e.stopPropagation();

        if(isProfileOpen){
            $('.profile-container').css('right', '-230px');
            isProfileOpen = false;
        }
        else{
            $('.profile-container').css('right', '0px');
            isProfileOpen = true;
            
            $('aside').css('left', '-240px');
            isMenuOpen = false;
        }
    });

    $('.profile-container').on('click', function(e){
        e.stopPropagation();
    });

    $(document).on('click', function(){
        $('aside').css('left', '-240px');
        isMenuOpen = false;

        $('.profile-container').css('right', '-230px');
        isProfileOpen = false;
    });
})