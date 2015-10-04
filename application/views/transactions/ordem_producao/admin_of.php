<?php


for($i=0; $i < count($linha); $i++){ 
    $id = $linha[$i]['dsc_name'];
    $linhas[$id] = $linha[$i]['dsc_name'];
}

echo '<div class="retrieve-componentes-produto">';
echo '<h2>Administrar OF'."'".'s</h2>';

echo '<form method="" action="" class="admin_of">';

echo form_label('Linha');
echo form_dropdown('linha',  $linhas);

echo form_label('Status');
echo form_dropdown('status',  array("LIB"=>"LIBERADO", "PRO"=>"PROGRAMADO"), '', 1)."<br>";

echo form_label('Início');
echo form_input(array('name'=>'dt_inicio', 'class'=>'dt_inicio_plan', 'placeholder'=>"dd/mm/aaaa"));

echo form_label('');
echo form_button(array('name'=>'cadastrar', 'class'=>'submit-admin-of','content'=>'Atualizar', 'type'=>'submit'))."<br>";

// set_value('dt_termino_plan', date('d/m/Y', time())
echo '</form>';

    echo '<div class="body-table">';
    echo '</div>';

echo '</div>';

?>

<script>

$(document).ready(function(){
    atualiza_OF();//carrega a primeira tabela apos carregar a página
 });

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

                $('.retrieve-componentes-produto .body-table script').remove();
                $('.retrieve-componentes-produto .body-table table').remove();
                $('.retrieve-componentes-produto .body-table').append(response);
            }
        });
}


    $(".submit-admin-of").click(function(){


        var controller = 'ordem_producao/update_OF';

        $('.admin_of').submit(function(){

            if(valida_sequencias() == true){
               insere_sequencia();
             }
            alert('Sequências atualizadas com sucesso');
            return false;
        });
    });

    function insere_sequencia(){

        $('input.seq_prod').each( function(){

            var seq_prod = $(this).val();
            // var linha_prod = $('input.seq_prod').closest('tr').find('td[class="linha-prod"]').text();
            var of_prod = $(this).closest('tr').find('td[class="of-prod"]').text();
            var prod_prod = $(this).closest('tr').find('td[class="prod-prod"]').text();
            
            var controller = 'ordem_producao/update_OF';

            $.ajax({
                type: "POST",
                url: controller,
                data:   'seq_prod='               +seq_prod + 
                        // ' & linha_prod= '         +linha_prod  + 
                        ' & of_prod= '            + of_prod +
                        ' & prod_prod= '          + prod_prod,
                
                success: function( response )
                {
                    alert(response);
                }
            });
        });



        // }
    }

function valida_sequencias(){
    //verifica se os inputs com valor, são númericos
    //valores numéricos são aceitáveis e em branco tambem.. retornarão TRUE
    //valores não numericos retornarão FALSE

    var resposta = true;

    // $('input.seq_prod').each( function() {

    //     var seq_prod = $(this).val();

    //     if ($.isNumeric(seq_prod)) {//SE É NUMERO
            
    //         if(resposta == false){
    //             resposta = false;
    //         }else{
    //             resposta = true;
    //         }
    //     }
    //     else if(!$.isNumeric(seq_prod) && (seq_prod != "")){//SE NÃO É UM NUMERO E NÃO ESTÁ EM GRANCO
    //         resposta = false;
    //     }

    // });

    return resposta;

}

</script>

