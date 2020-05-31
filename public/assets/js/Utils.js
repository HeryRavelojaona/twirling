/** 
 * Utils Class
 * For all events
 */
class Utils {
    constructor(){
        this.btnClose(".navbar-toggler-icon");
        this.ArrowUp();
        this.changePrice('#openChangePrice');
        this.responsiveSlider(576, 992);
        this.openForm();
        this.deleteArticle();
        this.articleEditor('textarea.tiny');
    }


    /**Tinymce Editarticle
    * @params element Selector
    */
    articleEditor(element){
        tinymce.init({ selector:element,
                        height : "480"
        });
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

     /*Show and hide arrowUp at scroll*/
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
     * Open from for change price
    *@params Listener Open form
    */
    changePrice(listener) {
        $(listener).click(function(){
            $('#changePrice').toggle();
        });
    }
    /*Change Hero Img*/
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

    /*part Change pass*/
    openForm() {
      
        $('.profile-changePass').hide();
        
        $('.modif-pass').click(function(e){
            e.preventDefault();
                $('.profile-changePass').toggle();
        });
        
    }
    
    /*Open form Delete article on admin*/
    deleteArticle() {
        // Ask confirmation   
        $('.check-delete').click(function(e){
            e.preventDefault();
            $('#' + e.target.dataset.deleteid).css('display','flex');
            $(this).hide();
        });
        
        // Cancel
        $('.stop-delete').click(function(e) {
            e.preventDefault();
            $(e.target).closest('.control-delete').css('display','none');
            $('.check-delete').show();
        });  
    }
};