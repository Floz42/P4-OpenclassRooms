class Burger {

    constructor() {
        this.burger();
    }

    burger() {
        $('#burger').on('click', function(){
            if (!$('#burger').hasClass('active')){
                $('#burger').addClass('active');
                $('.first_line').css('animation', 'rotateFirst 0.5s forwards');
                $('.second_line').css('opacity', '0');
                $('.third_line').css('animation', 'rotateThird 0.5s forwards');
                $('#block_menu').css('animation', 'moveRight 0.5s forwards');
                $('.menu_burger li, .menu_connexion_burger').css('display', 'flex');
            } else {
                $('#burger').removeClass('active');
                $('.first_line').css('animation', 'rotateFirstReverse 0.5s forwards');
                $('.second_line').css('opacity', '1');
                $('.third_line').css('animation', 'rotateThirdReverse 0.5s forwards');
                $('#block_menu').css('animation', 'moveLeft 0.5s forwards');
                $('.menu_burger li, .menu_connexion_burger').css('display', 'none');
            }
        });
    }
}