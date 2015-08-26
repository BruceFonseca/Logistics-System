
<div class='form'>

 <!-- Generate the form using form helper function: form_open_multipart(); -->
    <?php echo form_open_multipart('importar/ordem_producao', array('class' => 'upload-image-form'));?>
	<!-- AJAX Response will be outputted on this DIV container -->
	    <div class = "upload-image-messages"></div>
        <input type="file" multiple = "multiple"  class = "form-control" name="uploadfile[]" /><br />
        <input type="submit" name = "submit" value="Upload" class = "btn btn-primary" />
    </form>

</div>

<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>                    
    jQuery(document).ready(function($) {

        var options = {
            beforeSend: function(){
                // Replace this with your loading gif image
                $(".upload-image-messages").html('<p><img src = "<?php echo base_url() ?>img/sistema/backgroung/loading2.gif" class = "loader" /></p>');
                // $('div[numtab="'+ numTran +'"] div').remove();
            },
            complete: function(response){
                // Output AJAX response to the div container
                $(".upload-image-messages").html(response.responseText);
            }
        };  
        // Submit the form
        $(".upload-image-form").ajaxForm(options);  

        return false;
        
    });
</script>


