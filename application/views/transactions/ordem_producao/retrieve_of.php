<?php



// $this->table->set_heading('Abrir', 'Componente', 'Descrição' , 'qt_componente', 'qt_necessaria', 'qt_abastecido', 'qt_faltante' );

// foreach ($status as $linha):
    
//     $cd_componente = array('data'=> $linha->componente, 'class'=>'cd-componente');
//     $qt_necessaria = (int)$linha->qt_componente * (int)  $linha->qt_planejada;
//     $qt_faltante = $qt_necessaria - (int)  $linha->qt_abastecido;

//     $this->table->add_row(
//     '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>',
//     $cd_componente,
//     $linha->dsc_componente,
//     $linha->qt_componente,
//     $qt_necessaria,
//     $linha->qt_abastecido,
//     $qt_faltante
//     );
// endforeach;


echo '<div class="retrieve-componentes-produto">';
echo '<h2>Administrar OF <strong>'.  $dados_of->cd_of .'</strong></h2>';

echo '<form method="" action="" class=>';

echo form_label('OF');
echo form_input(array('name'=>'of', 'class'=>'of', 'disabled'=>'TRUE'),  set_value('of', $dados_of->cd_of),'bloqued');

echo form_label('Linha');
echo form_input(array('name'=>'linha', 'class'=>'linha', 'disabled'=>'TRUE'),  set_value('cd_linha', $dados_of->cd_linha),'bloqued')."<br>";

echo form_label('Produto');
echo form_input(array('name'=>'produto', 'class'=>'produto', 'disabled'=>'TRUE'),  set_value('cd_produto', $dados_of->cd_produto),'bloqued');

echo form_label('Qtde. plan');
echo form_input(array('name'=>'qtde_plan', 'class'=>'qtde_plan', 'disabled'=>'TRUE'),  set_value('qtde_plan', $dados_of->qt_planejada),'bloqued')."<br>";

echo form_label('Início');
echo form_input(array('name'=>'dt_inicio_plan', 'class'=>'dt_inicio_plan', 'disabled'=>'TRUE'), set_value('dt_termino_plan', date('d/m/Y H:i:s', strtotime($dados_of->dt_inicio_plan))),'bloqued');

echo form_label('Término');
echo form_input(array('name'=>'dt_termino_plan', 'class'=>'dt_termino_plan', 'disabled'=>'TRUE'),  set_value('dt_termino_plan', date('d/m/Y H:i:s', strtotime($dados_of->dt_termino_plan))),'bloqued')."<br>";

echo '</form>';

echo '<div class="body-table">';
    // echo $this->table->generate();
echo '</div>';

echo '</div>';

?>

<script>


$(document).ready(function(){
        atualiza_tabela_OF();
 });

function atualiza_tabela_OF(){

    var cd_of = $('.retrieve-componentes-produto form input[class="of"]').val();
    var cd_produto = $('.retrieve-componentes-produto form input[class="produto"]').val();

    //encontra o id do usuário que será atualizado
    var dados = 'of= '         + cd_of +
                ' & produto= '    + cd_produto;

        // alert(dados);
        // var numtab = $(this).closest("div").attr("numtab");
        

            $.ajax({
                type: "POST",
                url: "ordem_producao/retrieve_tabela_of",
                data: dados,
                success: function( response )
                {
                    // alert('deu certo   ' + response);
                    $('.retrieve-componentes-produto .body-table table').remove();
                    $('.retrieve-componentes-produto .body-table').append(response);
                }
            });

}


</script>

