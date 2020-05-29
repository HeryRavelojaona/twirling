/** 
 * Utils Class
 * For all little events
 */
class Utils {
    constructor(){
        this.btnClose(".navbar-toggler-icon");
        this.ArrowUp();
        this.changePrice('#openChangePrice');
        this.responsiveSlider(576, 992);
        this.openForm();
    }

    /**
     * CLose menu if is open
        *@params Listener show listener for close nav mobile
    */
    btnClose(listener) {
        const btnMenu =  $(listener);

        btnMenu.click(function(){
            btnMenu.toggleClass('active');

            if (btnMenu.hasClass('active')) {
                $(".collapse").fadeIn();
                $(".close-btn").click(function(){
                    $(".collapse").fadeOut();
                    btnMenu.removeClass('active');
                })
            }else {
                $(".collapse").hide();
            }

        });
    }

     /*Show and hide arrow at scroll*/
     ArrowUp() {
        $(window).on('scroll',() =>{
            if(window.scrollY >400){
            $('.back-to-top').fadeIn();
            }else{
                $('.back-to-top').fadeOut();
            }
         })
    }

    /**
     * Open from fro change price
    *@params Listener Open form
    */
    changePrice(listener) {
        $(listener).click(function(){
            $('#changePrice').toggle();
        });
    }

    responsiveSlider(mobileBreakpoint, desktopBreakpoint) {
        let img = $('#hero');
        let screenSize = window.screen.width;
        this.mobileBreakpoint = mobileBreakpoint;
        this.desktopBreakpoint = desktopBreakpoint;

        /*mobile size*/
        if(screenSize < mobileBreakpoint) {
            img.css("background", "url(assets/img/twirlHeroSmall.jpg)top center no-repeat");
        }
        /*tablet size*/
        if((screenSize < desktopBreakpoint) && (screenSize >= mobileBreakpoint)) {
            img.css("background", "url(assets/img/twirlHeroMedium.jpg)top center no-repeat");
        }
        /*desktop size*/
        if(screenSize >= desktopBreakpoint) {
            img.css("background", "url(assets/img/twirlHero2.jpg)top center no-repeat");
        }
        return;
    }

     //Validation before Delete
    openForm() {
        $('.go-delete').hide();

        /*part delete-account*/
        $('.check-delete').click(function(e){
        e.preventDefault();
        if($('.go-delete').hide()){
            $('.check-delete').hide();
            $('.go-delete').show();
            $('.stop-delete').click(function(){
                $('.go-delete').hide();
                $('.check-delete').show();
            });
        }else {
            $('.check-delete').show();
            }
        });
    
        /*part Change pass*/
        $('.profile-changePass').hide();
        
        $('.modif-pass').click(function(e){
            e.preventDefault();
                $('.profile-changePass').toggle();
        });
        
    }

    
};