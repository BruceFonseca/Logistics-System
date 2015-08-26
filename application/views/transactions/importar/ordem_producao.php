
<div class='form'>

    <?php 
    	echo form_open_multipart('importar/ordem_producao', array('class' => 'upload-ordem-producao'));
    	echo form_fieldset('Carregar nova ordem de produção');
    ?>
		<!-- AJAX Response will be outputted on this DIV container -->
	    <div class = "upload-messages-ordem-producao"></div>
        <input type="file" multiple = "multiple"  class = "form-control" name="uploadfile[]" /><br />
        <input type="submit" name = "submit" value="Upload" class = "btn btn-primary" />
    </fieldset>
    </form>

</div>

<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>                    
    jQuery(document).ready(function($) {

        var options = {
            beforeSend: function(){
                // Replace this with your loading gif image
                $(".upload-messages-ordem-producao").html('<p><img src = "<?php echo base_url() ?>img/sistema/backgroung/loading2.gif" class = "loader" /></p>');
            },
            complete: function(response){
                // Output AJAX response to the div container
                $(".upload-messages-ordem-producao").html(response.responseText);
            }
        };  
        // Submit the form
        $(".upload-ordem-producao").ajaxForm(options);  

        return false;
        
    });
</script>


