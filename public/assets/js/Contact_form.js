/** 
 * ContactClass
 *
 */
class Contact {
    constructor(){
        this.sendMessage('#contact_form');
        
    }

    /**
     * @param element String||Html element
     **/
    sendMessage(element){

        $(element).submit(function(e){
            e.preventDefault();
  
            let fileData = $('#contact_form').serialize();
            $.ajax({
                type: "POST",
                data: fileData,
                url: "../public/index.php?route=contact",
                success: function (data) {
                    let response = JSON.parse(data);
                    console.log(response);
                    if(response.success){
                        $('.error-name').hide();
                        $('.error-email').hide();
                        $('.error-subject').hide();
                        $('.error-content').hide();
                        $('.contact #contact_sent').text('Message bien envoyé');
                        $('#contact_form')[0].reset();
                    }  
                    else {
                        $('.error-name').html(response.errors.name);
                        $('.error-email').html(response.errors.email);
                        $('.error-subject').html(response.errors.subject);
                        $('.error-content').html(response.errors.message);  
                       
                    }
                }
            })
        })

    }

}