/** 
 * Utils Class
 *
 */
class Utils {
    constructor(){
        this.btnClose(".navbar-toggler-icon");
        this.ArrowUp();
        this.changePrice('#openChangePrice');
        this.responsiveSlider(576, 992);
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

   

    
};