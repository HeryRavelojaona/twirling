/** 
 * Manage form with ajax and php
 *
 */
class Form_ajax {
    constructor(){
        this.changePass();
        this.changePicture('#changeImage');
        this.addArticle();
        this.addEvent();
        this.newPrice();
        this.newAddress();
        this.newEmail();
        this.newPhone();
    }

    /**
     * Change user password
     * @param element HTMLElement|string Element 
     */
    changePass() {
        $('#pass_validation').click(function(){

            console.log('ok');
            let postdata= $('.profile-changePass').serialize();
    
            $.ajax({
                type: "POST",
                data: postdata,
                url: "index.php?route=updatePassword",
                success: function (data) {
                    let response = JSON.parse(data);
                    if(response.isSuccess) {
                        $('.profile-changePass').hide();
                        $('.modif-pass').text('Changement bien effectuer').css('color','#007bff');
                    }else {console.log(response);
                        $('.form-error').text(response.validationpass);
                    }
                    $('.profile-changePass')[0].reset();
                }
            })
        })

    }

    /**
     * Change user picture on profile
     * @param element HTMLElement|string Element Change picture
     */
    changePicture(element) 
    {   /*open part form*/
        if($("#myModal").hide()){
            $('#openModal').click(function(){
            $("#myModal").show();
            })
        }
        /*Reload Img on close part*/
        $('.changeImgClose').click(function(){
            $("#myModal").hide();
            $('#picture_profil').load(' #picture_profil');
        })
    
        /*change picture*/
       $(element).submit(function(e){
            e.preventDefault();
            let fileData = new FormData($(element)[0]);
            $.ajax({
                type: "POST",
                data: fileData,
                cache: false,
                contentType: false,
                processData: false,
                url: "../public/index.php?route=fileUpload",
                success: function (data) {
                        $('.status').text(data);
                        $(element)[0].reset();
                }
            })
        })
    }


    /**
     * Show preview before Add Article
     */

    addArticle() {
        let validForm = true;
        /*Input title Validation*/
        $('#actualityTitle').focusout(function(e){
            let title = $('#actualityTitle').val(); 
            if(title.length < 2){
                $('.form-error').html('Veuillez remplir le champ titre avec minimum 2 charactères');
                validForm = false;
            }else{validForm = true;}   
        })
        /* Input content validation*/
        $('#actualityContent').focusout(function(e){
            let content = $('#actualityContent').val(); 
            if(content.length < 5){
                $('.form-error').html('Veuillez remplir le champ texte avec minimum 5 charactères');
                validForm = false;
            }else{validForm = true;}      
        })
        /*Send form if validation success*/
        if(validForm) {
            $('#form_article').submit(function(e){
                e.preventDefault();
                let fileData = new FormData($('#form_article')[0]);
                $.ajax({
                    type: "POST",
                    data: fileData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    url: "../public/index.php?route=previewarticle",
                    success: function (data) {
                        let response = JSON.parse(data);
                        let name = response.filename;
                        if(!response.error){
        
                            $('#preview_file').attr("src","../public/assets/img/upload/"+name);
                            $('.preview-title').text(response.title);
                            $('.preview-content').html(response.content);
                            $('.actuality-edit').hide();
                            $('.actuality .preview').show();
                            $('#savefilename').val(name);
                            $('#savechoice').val(response.choice);
                            $('#savetitle').val(response.title);
                            $('#savecontent').html(response.content);
                        }else {
                            $('.form-error').html(response.error);
                        }        
                    }
                })
                
            })
        }else {
            $('#form_article').submit(function(e){
                e.preventDefault();
                $('.form-error').html('Veuillez remplir les champs');
              
            })
        }
    }

     /**
     * Show preview before Add Event
     */
    addEvent() {
        let validForm = true;
        /*Input title Validation*/
        
        $('#event_title').focusout(function(e){
            let title = $('#event_title').val(); 
            if(title.length < 2){
                $('.errortitle').text('Veuillez remplir le champ titre avec minimum 2 charactères');
                validForm = false;
            }else{validForm = true;}      
        })
        /* Input address validation*/
        $('#event_address').focusout(function(e){
            let address = $('#event_address').val(); 
            if(address.length < 5){
                $('.erroraddress').text('Veuillez remplir le champ adresse avec minimum 5 charactères');
                validForm = false;

            }else{validForm = true;}      
        })
        /* Input place validation*/
        $('#event_place').focusout(function(e){
            let place = $('#event_place').val(); 
            if(place.length < 2){
                $('.errorplace').text('Veuillez remplir le champ Lieu avec minimum 2 charactères');
                validForm = false;
            }else{validForm = true;}       
        })
        /* Input start validation*/
        $('#event_start').focusout(function(e){
            let start = $('#event_start').val(); 
            if(start.length < 4){
                $('.errorstart').text('Veuillez renseigner une heure de début');
                validForm = false;
            }else{validForm = true;}       
        })

         /* Input end validation*/
         $('#event_end').focusout(function(e){
            let end = $('#event_end').val(); 
            if(end.length < 4){
                $('.errorend').text('Veuillez renseigner une heure de fin');
                validForm = false;
            }else{validForm = true;}       
        })
        
        /* Input content validation empty is possible*/
        $('#event_content').focusout(function(e){
           let content = $('#event_content').val(); 
           if(content.length > 400){
               $('.errorcontent').text('Le message est trop long');
               validForm =false;
           }else{validForm = true;}       
       })

        /*Send form if validation success*/
        if(validForm) {
            $('#form_event').submit(function(e){
                e.preventDefault();
                let fileData = $('#form_event').serialize();
                $.ajax({
                    type: "POST",
                    data: fileData,
                    url: "../public/index.php?route=previewevent",
                    success: function (data) {
                        let response = JSON.parse(data);
                        console.log(response);
                        if(response.error ==true){
                            $('.preview-title').text(response.title);
                            $('.preview-place').text(response.place);
                            $('.preview-address').text(response.address);
                            $('.preview-start').text(response.start);
                            $('.preview-end').text(response.end);
                            $('.preview-content').html(response.content);
                            $('.event-edit').hide();
                            $('.event-preview').show();
                            $('#savetitle').val(response.title);
                            $('#saveplace').val(response.place);
                            $('#saveaddress').val(response.address);
                            $('#savestart').val(response.start);
                            $('#saveend').val(response.end);
                        }else {
                            $('.errortitle').text(response.errortitle);
                            $('.errorplace').text(response.errorplace);
                            $('.erroraddress').text(response.erroraddress);
                            $('.errorstart').text(response.errorstart);
                            $('.errorend').text(response.errorend);
                            $('.errorcontent').text(response.errorcontent);
                        }        
                    }
                })
                
            })
        }else {
            $('#form_event').submit(function(e){
                e.preventDefault();
                $('.form-error').html('Veuillez remplir les champs');
             return;
            })
        }
    }

/*Change contribution*/
    newPrice(){
        $('#btn_change_price').click(function(e){
            e.preventDefault();
            if(!$('#changePrice').val()){
                $('#btn_change_price').text('veuillez rentrer une somme');
            }
            let fileData = $('#changePrice').serialize();
            $.ajax({
                type: "POST",
                data: fileData,
                url: "../public/index.php?route=changeconfig",
                success: function (data) {
                        $('#changePrice').hide();
                        $('#changePrice')[0].reset();
                        $('.show-price').load(' .show-price');
                }
            })
        })
    }

/*Change address*/
    newAddress(){
        $('#btn_change_address').click(function(e){
            e.preventDefault();
            if(!$('#new_address').val()){
                $('#btn_change_address').text('veuillez rentrer une adresse');
            }
            let fileData = $('#changeAddress').serialize();
            $.ajax({
                type: "POST",
                data: fileData,
                url: "../public/index.php?route=changeconfig",
                success: function (data) {
                    console.log(data);
                       /* $('#changeAddress').hide();*/
                        $('#changeAddress')[0].reset();
                        $('.show-address').load(' .show-address');
                }
            })
        })
    }

/*Change mail*/
    newEmail(){
        $('#btn_change_email').click(function(e){
            e.preventDefault();
            if(!$('#new_email').val()){
                $('#btn_change_email').text('veuillez rentrer un email');
            }
            let fileData = $('#changeEmail').serialize();
            $.ajax({
                type: "POST",
                data: fileData,
                url: "../public/index.php?route=changeconfig",
                success: function (data) {
                    console.log(data);
                       /* $('#changeAddress').hide();*/
                        $('#changeEmail')[0].reset();
                        $('.show-email').load(' .show-email');
                }
            })
        })
    }

/*Change phonenumber*/
    newPhone(){
        $('#btn_change_phone').click(function(e){
            e.preventDefault();
            if(!$('#new_phone').val()){
                $('#btn_change_phone').text('veuillez rentrer un numéro');
            }
            let fileData = $('#changePhone').serialize();
            $.ajax({
                type: "POST",
                data: fileData,
                url: "../public/index.php?route=changeconfig",
                success: function (data) {
                    console.log(data);
                       /* $('#changeAddress').hide();*/
                        $('#changePhone')[0].reset();
                        $('.show-phone').load(' .show-phone');
                }
            })
        })
    }

       
}