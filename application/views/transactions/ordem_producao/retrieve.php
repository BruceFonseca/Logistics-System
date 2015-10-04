<?php

for($i=0; $i < count($linha); $i++){ 
    $id = $linha[$i]['dsc_name'];
    $linhas[$id] = $linha[$i]['dsc_name'];
}

// $this->table->set_heading('Abrir','Linha', 'OF', 'Produto','Status','Qtd. plan.',' Qtd. prod', 'Dt_Inic.', 'Dt_Term.');

// if($status){
//     foreach ($status as $linha):

//         $of= array('data'=> $linha->cd_of, 'class'=>'cd-of');

//         $this->table->add_row(
//         '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>',
//         $linha->cd_linha, 
//         $of, 
//         $linha->cd_produto, 
//         $linha->cd_status, 
//         $linha->qt_planejada,
//         $linha->qt_produzida,
//         date('d/m/Y H:i:s', strtotime($linha->dt_inicio_plan)),
//         date('d/m/Y H:i:s', strtotime($linha->dt_termino_plan)),
//         $linha->seq_prod
//         );
//     endforeach;
// }

echo '<div class="retrieve-ordem-producao">';
echo '<h2>Abastecer ordens de produção</h2>';
?>	
<div class="filtros">

    <?php 
        $atr = 'name="filtro-linha" class="filtro-linha"';
        echo form_dropdown('linha',  $linhas, '', $atr );
     ?>
    <input placeholder="OF" name="filtro-OF" class='filtro-OF'>
    <br>
    <input placeholder="Produto" name="filtro-produto"  class="filtro-produto">
    <button type="">Limpar</button>
</div>

<?php

echo '<div class="body-table">';
    // echo $this->table->generate();
echo '</div>';

echo '</div>';

?>

<!-- o script jquery abaixo é carregado no formulário no momento que o formulário é criado -->
<script>
    
    $('select[name="linha"]').on('change', function(){
        atualiza_tabela();
    });

    $(".filtros input").on('change', function(){
        atualiza_tabela();
    });
    $(".filtros button").click(function(){
        $('.filtros .filtro-linha').val('');
        $('.filtros .filtro-OF').val('');
        $('.filtros .filtro-produto').val('');
        $('.body-table table').remove();
    });
    
    $(document).ready(function(){
        atualiza_tabela();
    });

    function atualiza_tabela(){

        var dados = 'linha= '        + $('.filtros .filtro-linha').val() +
                    '& OF= '         + $('.filtros .filtro-OF').val() +
                    '& produto= '    + $('.filtros .filtro-produto').val() ;

            $.ajax({
                type: "POST",
                url: "ordem_producao/retrieve",
                data: dados,
                success: function( data )
                {
                    // alert('deu certo   ' + data);
                    $('.body-table table').remove();
                    $('.body-table').append(data);
                }
            });

    }

    
</script>

