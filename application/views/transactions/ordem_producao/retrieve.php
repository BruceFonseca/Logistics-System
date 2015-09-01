<?php


$this->table->set_heading('Linha', 'OF', 'Produto','Status','Qtd. plan.',' Qtd. prod', 'Dt_Inic.', 'Dt_Term.');

foreach ($status as $linha):
    $this->table->add_row(
    $linha->cd_linha, 
    $linha->cd_of, 
    $linha->cd_produto, 
    $linha->cd_status, 
    $linha->qt_planejada,
    $linha->qt_produzida,
    $linha->dt_inicio_plan,
    $linha->dt_termino_plan,
	'<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>');
endforeach;

echo '<div class="retrieve-ordem-producao">';
echo '<h2>Administrar ordens de produção</h2>';	

echo $this->table->generate();

echo '</div>';

?>


