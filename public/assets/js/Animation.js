/** 
 * Animations Class
 *
 */
class Animation {
    constructor(){
        this.AnimationScroll();
        this.smoothScroll();
    }

    //animation scrollReveal librarie
    AnimationScroll() {
         
        const sr = ScrollReveal();
        sr.reveal('.fade-up', {
            origin: 'top',
            distance:'80px',
            scale: 0.3,
            duration: 2000 });

        sr.reveal('.fade-left', {
            origin: 'right',
            distance:'300px',
            duration: 2000 });

        sr.reveal('.fade-right', {
            origin: 'left',
            distance:'300px',
            duration: 2000 });

        /*Navbar opacity*/
        sr.reveal('#header', {
            opacity: 0.1,
            distance:'0px',
            duration: 5000 });
    }

    /*smoothSrcoll*/
    smoothScroll() {
        $(".navbar a").on('click',function(event){
            let hash=this.hash;
            $('body,html').animate({scrollTop:$(hash).offset().top},900,function(){window.location.hash=hash;})
    
        });	
    }

    /*hide Gif*/

    /**
     * 
     * @param element Select element 
     */
    gifBatonAnimate(element) {
        $(element).animate({
            opacity: 0.25,
            height: "0"
          }, 6000);

        $(element).css('display','none');
    }
}