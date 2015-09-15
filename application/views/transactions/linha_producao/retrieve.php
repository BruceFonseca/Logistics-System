<?php

$this->table->set_heading('Linha','Média Produção','Editar');


foreach ($linhas as $linha):
    $this->table->add_row(
    $linha->dsc_name, 
    $linha->qt_media_producao,
	'<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>');
endforeach;




echo '<div class="retrieve-linha-producao">';
echo '<h2>Média de produção (Hr)</h2>';	

echo $this->table->generate();

echo '</div>';

?>


