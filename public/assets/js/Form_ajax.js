/** 
 * Manage form with ajax and php
 *
 */
class Form_ajax {
    constructor(){
        this.changePass('#change_pass');
        this.changePicture('#changeImage');
        this.preview();
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

    /**
     * @param element HTMLElement|string Element Change picture
     */
    changePicture(element) 
    {   /*open part form*/
        if($("#myModal").hide()){
            $('#openModal').click(function(){
            $("#myModal").show();
            })
        }
        
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

    preview() {
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
                    if(!response.error){
                        
                        let name = response.filename;
                        $('#preview_file').attr("src","../public/assets/img/upload/"+name);
                        $('.preview-title').text(response.title);
                        $('.preview-content').text(response.content);
                        $('.actuality-edit').hide();
                        $('.actuality .preview').show();
                        $('#savefilename').val(name);
                        $('#savetitle').val(response.title);
                        $('#savecontent').html(response.content);
                    }else {
                        $('.form-error').html(response.error);

                    }
                        console.log(response.error);
                        
                }
            })
            
        })

    }
}