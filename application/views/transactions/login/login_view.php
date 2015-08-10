<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script type="text/javascript" src=<?php echo base_url("js/jquery-2.1.0.js" )?>></script>
    <script type="text/javascript" src=<?php echo base_url('js/bootstrap.min.js') ?>></script>
    <script type="text/javascript" src=<?php echo base_url('js/login.js') ?>></script>

    <link rel="stylesheet" type="text/css" href= <?php echo base_url("css/bootstrap.css" )?> />
    <link rel="stylesheet" type="text/css" href= <?php echo base_url("css/login.css" )?> />

    <meta charset="UTF-8">
    <title>InfoLog  - bflabs</title>
</head>
<body>
<div class="topo-login">
    <p>InfoLog :: Controle de sequenciamento e abastecimento de linhas de produção</p>
</div>

<?php
/*atributos para o form_open*/

    $attributes = array(
            'role'=>"form",
            'id' => 'login-form',
            'method' => "post",
            'autocomplete' => "off",
    );
?>

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-wrap">
                    <h1>Faça Log in</h1>
                    <?php echo validation_errors(); ?>

                    <?php echo form_open('verifylogin', $attributes); ?>

                        <div class="form-group">
                            <label for="userid" class="sr-only">UserID</label>
                            <input type="userid" id="username" name="username" class="form-control" placeholder="Usuário" autofocus>
                        </div>

                        <div class="form-group">
                            <label for="key" class="sr-only">Senha</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Senha">
                        </div>

                        <div class="checkbox">
                            <span class="character-checkbox" onclick="showPassword()"></span>
                            <span class="label">Exibir senha</span>
                        </div>
                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Log in">
                    </form>
                    <hr>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

<footer id="footer">
    <img id="logo-login" src="<?php echo base_url('img/sistema/logotipo/logoembraco.jpg' )?>" alt=""/>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p>Page © - 2014</p>
                <p>Powered by <strong><a href="https://www.linkedin.com/profile/view?id=92016927&trk=hp-identity-name" target="_blank">Bruce Fonseca</a></strong></p>
            </div>
        </div>
    </div>
</footer>

</body>
</html>