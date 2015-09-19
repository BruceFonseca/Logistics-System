<?php



$this->table->set_heading('LInha', 'OF', 'Produto' , 'Quantidade', 'Início', 'Término', 'Sequência' );

foreach ($status as $linha):

    $this->table->add_row(
    '<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>',
    $linha->cd_linha,
    $linha->cd_of,
    $linha->cd_produto,
    $linha->qt_planejada,
    $linha->dt_inicio_plan,
    $linha->dt_inicio_plan,
    $linha->qt_planejada
    );
endforeach;


echo $this->table->generate();