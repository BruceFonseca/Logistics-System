<?php


for($i=0; $i < count($linha); $i++){ 
    $id = $linha[$i]['dsc_name'];
    $linhas[$id] = $linha[$i]['dsc_name'];
}

echo '<div class="retrieve-componentes-produto">';
echo '<h2>Administrar OF'."'".'s</h2>';

echo '<form method="" action="" class=>';

echo form_label('Linha');
echo form_dropdown('linha',  $linhas);

echo form_label('Status');
echo form_dropdown('status',  array("LIB"=>"LIBERADO", "PRO"=>"PROGRAMADO"), '', 1)."<br>";

echo form_label('Início');
echo form_input(array('name'=>'dt_inicio', 'class'=>'dt_inicio_plan', 'placeholder'=>"dd/mm/aaaa"));

// set_value('dt_termino_plan', date('d/m/Y', time())
echo '</form>';

echo '<div class="body-table">';
echo '</div>';

echo '</div>';

?>

<script>

$('select[name="linha"]').on('change', function(){
    atualiza_OF();
});

$('select[name="status"]').on('change', function(){
    atualiza_OF();
});

function atualiza_OF(){

    status = $('select[name="status"]').val();
    linha = $('select[name="linha"]').val();
    data = $('input[name="dt_inicio"]').val();
    // alert('atualiza ' + data);
    
    var controller = 'ordem_producao/retrieve_OF_admin';

     $.ajax({
            type      : 'post',
            url       : controller, //é o controller que receberá
            data      : 'status='+ status + ' & linha= ' + linha  + ' & data= ' + data,
            
            success: function( response ){

                alert(response);
                // $('.apontamento').show();

                // $('.dados_componente').css( "display", "table" );
                // $('.dados_componente').css( "position", "absolute" );
                // $('.dados_componente').append(response);
            }
        });
}

</script>

