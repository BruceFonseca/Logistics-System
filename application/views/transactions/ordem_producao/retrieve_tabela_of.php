<?php



$this->table->set_heading('Abrir', 'Componente', 'Descrição' , 'qt_componente', 'qt_necessaria', 'qt_abastecido', 'qt_faltante' );

foreach ($status as $linha):
    
    $cd_componente = array('data'=> $linha->componente, 'class'=>'cd-componente');
    $qt_necessaria = (int)$linha->qt_componente * (int)  $linha->qt_planejada;
    $qt_faltante = $qt_necessaria - (int)  $linha->qt_abastecido;

    $this->table->add_row(
    '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>',
    $cd_componente,
    $linha->dsc_componente,
    $linha->qt_componente,
    $qt_necessaria,
    $linha->qt_abastecido,
    $qt_faltante
    );
endforeach;

echo $this->table->generate();

?>

<script>

$('.retrieve-componentes-produto .body-table tr td span').on('click', function(){
    
    //encontra o id do usuário que será atualizado
    var cd_of = $(this).closest('.retrieve-componentes-produto').find('input[class="of"]').val();
    var cd_produto = $(this).closest('.retrieve-componentes-produto').find('input[class="produto"]').val();
    var cd_componente = $(this).closest('tr').find('td[class="cd-componente"]').text();

    // var height = $('.retrieve-componentes-produto').height());

    var controller = 'apontamento/apontar';

     $.ajax({
            type      : 'post',
            url       : controller, //é o controller que receberá
            data      : 'of='+ cd_of + ' & produto= ' + cd_produto  + ' & componente= ' + cd_componente,
            
            success: function( response ){
                $('.apontamento').show();

                $('.dados_componente').css( "display", "table" );
                $('.dados_componente').css( "position", "absolute" );
                $('.dados_componente').append(response);
            }
        });

});

</script>