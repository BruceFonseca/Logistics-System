<?php

for($i=0; $i< count($linha); $i++){ 
    $linhas[$i] = $linha[$i]['dsc_name'];
}

$this->table->set_heading('LInha', 'OF', 'Produto' , 'qt_componente', 'qt_necessaria', 'qt_abastecido' );

// if($status){
    

// foreach ($status as $linha):
    
//     $cd_componente = array('data'=> $linha->componente, 'class'=>'cd-componente');
//     $qt_necessaria = (int)$linha->qt_componente * (int)  $linha->qt_planejada;

//     $this->table->add_row(
//     '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>',
//     $cd_componente,
//     $linha->dsc_componente,
//     $linha->qt_componente,
//     $qt_necessaria,
//     $linha->qt_abastecido
//     );
// endforeach;
// }



echo '<div class="retrieve-componentes-produto">';
echo '<h2>Administrar OF'."'".'s</h2>';

echo '<form method="" action="" class=>';

echo form_label('Linha');
echo form_dropdown('linha',  $linhas, '', 1);

echo form_label('Status');
echo form_dropdown('ativo',  array("LIB"=>"LIBERADO", "PRO"=>"PROGRAMADO"), '', 1)."<br>";

echo form_label('Início');
echo form_input(array('name'=>'dt_inicio_plan', 'class'=>'dt_inicio_plan', 'disabled'=>'TRUE'), set_value('dt_termino_plan', date('d/m/Y H:i:s', time())));


echo '</form>';

echo '<div class="body-table">';
    echo $this->table->generate();
echo '</div>';

echo '</div>';

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

