<?php


$this->table->set_heading('Abrir','Linha', 'OF', 'Produto','Status','Qtd. plan.',' Qtd. prod', 'Dt_Inic.', 'Dt_Term.');

foreach ($status as $linha):
    $of= array('data'=> $linha->cd_of, 'class'=>'cd-of');
    $cd_produto= array('data'=> $linha->cd_produto, 'class'=>'cd-produto');

    $this->table->add_row(
    '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>',
    $linha->cd_linha, 
    $of,  
    $cd_produto, 
    $linha->cd_status, 
    $linha->qt_planejada,
    $linha->qt_produzida,
    date('d/m/Y H:i:s', strtotime($linha->dt_inicio_plan)),
    date('d/m/Y H:i:s', strtotime($linha->dt_termino_plan))
    );
endforeach;

    echo $this->table->generate();

?>

<script>
$('.retrieve-ordem-producao .body-table tr td span').on('click', function(){
    
    //encontra o id do usuário que será atualizado
    var cd_of = $(this).closest('tr').find('td[class="cd-of"]').text();
    var cd_produto = $(this).closest('tr').find('td[class="cd-produto"]').text();
    var desc = 'OF ' + cd_of;
    var controller = 'ordem_producao/retrieve_OF';
    var numTran = numTab();

    criarNovaAbaSemConteudo(controller, desc, numTran);


     $.ajax({
            type      : 'post',
            url       : controller, //é o controller que receberá
            data      : 'of='+ cd_of + ' & produto= ' + cd_produto,
            
            success: function( response ){
                $('div[numtab="'+ numTran +'"]').append(response);
                // alert('entrou' + 'of='+ cd_of + ' & produto= ' + cd_produto);
            }
        });

});
</script>


