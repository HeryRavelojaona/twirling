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
  
            let fileData = $(element).serialize();
            $.ajax({
                type: "POST",
                data: fileData,
                url: "index.php?route=contact",
                success: function (data) {
                    let response = JSON.parse(data);
                    if(response.success){
                        $('.error-name').hide();
                        $('.error-email').hide();
                        $('.error-subject').hide();
                        $('.error-content').hide();
                        $('.contact #contact_sent').text('Message bien envoyé');
                        $(element)[0].reset();
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