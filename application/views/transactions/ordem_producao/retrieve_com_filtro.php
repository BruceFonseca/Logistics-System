<?php


$this->table->set_heading('Linha', 'OF', 'Produto','Status','Qtd. plan.',' Qtd. prod', 'Dt_Inic.', 'Dt_Term.');

foreach ($status as $linha):
    $this->table->add_row(
    '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>',
    $linha->cd_linha, 
    $linha->cd_of, 
    $linha->cd_produto, 
    $linha->cd_status, 
    $linha->qt_planejada,
    $linha->qt_produzida,
    date('d/m/Y H:i:s', strtotime($linha->dt_inicio_plan)),
    date('d/m/Y H:i:s', strtotime($linha->dt_termino_plan))
    );
endforeach;

    echo $this->table->generate();

?>


