<?php

$this->table->set_heading('Linha','Média Produção', 'Status', 'Editar');


foreach ($linhas as $linha):
    
    $dsc_linha = array('data'=> $linha->dsc_name, 'class'=>'linha');
    $qt_media_producao = array('data'=> $linha->qt_media_producao, 'class'=>'qt_media_producao');
    $cd_status = array('data'=> $linha->cd_status, 'class'=>'cd_status');
    
    $this->table->add_row(
    $dsc_linha,
    $qt_media_producao,
    $cd_status,
	'<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>');
endforeach;




echo '<div class="retrieve-linha-producao">';
echo '<h2>Média de produção (Hr)</h2>';	

echo '<div class="body-table">';
    echo $this->table->generate();
echo '</div>';

echo '</div>';

?>

<script>
$('.retrieve-linha-producao .body-table tr td span').on('click', function(){
    
    //encontra o id do usuário que será atualizado
    var linha = $(this).closest('tr').find('td[class="linha"]').text();
    var qt_media_producao = $(this).closest('tr').find('td[class="qt_media_producao"]').text();
    var cd_status = $(this).closest('tr').find('td[class="cd_status"]').text();

    // alert(linha + "    " + qt_media_producao);

    var controller = 'linha_producao/update';

     $.ajax({
            type      : 'post',
            url       : controller, //é o controller que receberá
            data      : 'linha='+ linha + ' & qt_media_producao= ' + qt_media_producao + ' & cd_status= ' + cd_status ,
            
            success: function( response ){
                $('.apontamento').show();
                $('.dados_componente').css( "display", "table" );
                $('.dados_componente').css( "position", "absolute" );
                $('.dados_componente').append(response);
            }
        });

});
</script>
