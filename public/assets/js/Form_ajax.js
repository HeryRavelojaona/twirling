/** 
 * Manage form with ajax and php
 *
 */
class Form_ajax {
    constructor(){
        this.changePass('#change_pass');
    
    }

    /**
     * 
     * @param element HTMLElement|string Element 
     */
    changePass(element) {
        $(element).submit(function(e){
            e.preventDefault();
            let postdata= $(element).serialize();
    
            $.ajax({
                type: "POST",
                data: postdata,
                dataType: "json",
                url: "../public/index.php?route=updatePassword",
                success: function (data) {
                    if(data['isSuccess']) {
                        $(element).hide();
                        $('.modif-pass').text('Changement bien effectuer').css('color','#007bff');
                    }else {
                        $('.form-error').text(data['validationpass']);
                    }
                    $(element)[0].reset();
                }
            })
        })

    }
}