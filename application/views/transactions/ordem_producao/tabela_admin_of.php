<?php



$this->table->set_heading('Linha', 'OF', 'Produto' , 'Quantidade', 'Início', 'Término', 'Sequência','Editar');

foreach ($status as $linha):

    $seq_prod = array('data'=> form_input(array('name'=>'seq_prod', 'class'=>'seq_prod'),  set_value('seq_prod', $linha->seq_prod)));
    $linha_prod = array('data'=> $linha->cd_linha, 'class'=>'linha-prod');
    $of_prod = array('data'=> $linha->cd_of, 'class'=>'of-prod');
	$prod_prod = array('data'=> $linha->cd_produto, 'class'=>'prod-prod');

    $this->table->add_row(
    // $linha->cd_linha,
    $linha_prod,
    // $linha->cd_of,
    $of_prod,
    // $linha->cd_produto,
    $prod_prod,
    $linha->qt_planejada,
    $linha->dt_inicio_plan,
    $linha->dt_termino_plan,
    // $linha->seq_prod,
    $seq_prod,
    '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>'
    );
endforeach;


echo $this->table->generate();

?>
