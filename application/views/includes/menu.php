<nav class="menu">
    <ul>
        <li><a href="#">Usuários</a> 
            <ul>
                <li><?php echo anchor( base_url('usuario/create'), 'Criar'); ?> </li>
                <li><?php echo anchor(base_url('usuario/retrieve'), 'Consultar'); ?> </li>
                <li><?php echo anchor(base_url('usuario/update'), 'Atualizar'); ?> </li>
                <li><?php echo anchor(base_url('usuario/delete'), 'Excluir'); ?> </li>
            </ul>
        </li>
        <li><a href="#">Status</a> 
            <ul>
                <li><?php echo anchor(base_url('cadastro_status/create'), 'Criar'); ?> </li>
                <li><?php echo anchor(base_url('cadastro_status/retrieve'), 'Consultar'); ?> </li>
                <li><?php echo anchor(base_url('cadastro_status/update'), 'Atualizar'); ?> </li>
                <li><?php echo anchor(base_url('cadastro_status/delete'), 'Excluir'); ?> </li>
            </ul>
        </li>
        <li><a href="#">Tipo Usuário</a> 
            <ul>
                <li><?php echo anchor(base_url('tipo_usuario/create'), 'Criar'); ?> </li>
                <li><?php echo anchor(base_url('tipo_usuario/retrieve'), 'Consultar'); ?> </li>
                <li><?php echo anchor(base_url('tipo_usuario/update'), 'Atualizar'); ?> </li>
                <li><?php echo anchor(base_url('tipo_usuario/delete'), 'Excluir'); ?> </li>
            </ul>
        </li>
        <li><a href="#">Tipo Imóvel</a> 
            <ul>
                <li><?php echo anchor(base_url('tipo_imovel/create'), 'Criar'); ?> </li>
                <li><?php echo anchor(base_url('tipo_imovel/retrieve'), 'Consultar'); ?> </li>
                <li><?php echo anchor(base_url('tipo_imovel/update'), 'Atualizar'); ?> </li>
                <li><?php echo anchor(base_url('tipo_imovel/delete'), 'Excluir'); ?> </li>
            </ul>
        </li>
        <li><a href="#">Mensagens</a> 
            <ul>
                <li><?php echo anchor(base_url('contato/retrieve'), 'Consultar'); ?> </li>
            </ul>
        </li>
        <li><a href="#">Imóvel</a> 
            <ul>
                <li><?php echo anchor(base_url('imovel/create'), 'Criar'); ?> </li>
                <li><?php echo anchor(base_url('imovel/retrieve'), 'Consultar'); ?> </li>
                <li><?php echo anchor(base_url('imovel/update'), 'Atualizar'); ?> </li>
                <li><?php echo anchor(base_url('imovel/delete'), 'Excluir'); ?> </li>
            </ul>
        </li>
        <li><a href="#">Tipo Topografia</a> 
            <ul>
                <li><?php echo anchor(base_url('tipo_topografia/create'), 'Criar'); ?> </li>
                <li><?php echo anchor(base_url('tipo_topografia/retrieve'), 'Consultar'); ?> </li>
                <li><?php echo anchor(base_url('tipo_topografia/update'), 'Atualizar'); ?> </li>
                <li><?php echo anchor(base_url('tipo_topografia/delete'), 'Excluir'); ?> </li>
            </ul>
        </li>      
        <li><a href="#">Tipo Transação</a> 
            <ul>
                <li><?php echo anchor(base_url('tipo_transacao/create'), 'Criar'); ?> </li>
                <li><?php echo anchor(base_url('tipo_transacao/retrieve'), 'Consultar'); ?> </li>
                <li><?php echo anchor(base_url('tipo_transacao/update'), 'Atualizar'); ?> </li>
                <li><?php echo anchor(base_url('tipo_transacao/delete'), 'Excluir'); ?> </li>
            </ul>
        </li> 
    </ul>
</nav>

