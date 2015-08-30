<div class='form'>

    <?php 
    	echo form_open_multipart('estrutura_produto/importar', array('class' => 'upload-esturtura-produto'));
    	echo form_fieldset('Carregar nova estrutura de produto');
    ?>
		<!-- AJAX Response will be outputted on this DIV container -->
	    <div class = "upload-messages-esturtura-produto"></div>
        <input type="file" multiple = "multiple"  class = "form-control" name="uploadfile[]" /><br />
        <input type="submit" name = "submit" value="Carregar" class = "submit-form" />
       </fieldset>
    </form>
</div>

<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>                    
    jQuery(document).ready(function($) {

        var options = {
            beforeSend: function(){
                // Replace this with your loading gif image
                $(".upload-messages-esturtura-produto").html('<p><img src = "./img/sistema/background/loading2.gif" class = "loader" /></p>');
            },
            complete: function(response){
                // Output AJAX response to the div container
                $(".upload-messages-esturtura-produto").html(response.responseText);
            }
        };  
        // Submit the form
        $(".upload-esturtura-produto").ajaxForm(options);  

        return false;
        
    });
</script>
