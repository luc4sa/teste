<?php
session_start();
ob_start();
$banidos = array();
if (in_array($_SERVER['REMOTE_ADDR'], $banidos)) {
    echo "<link rel='stylesheet' type='text/css' href='css/css.css' />
    <link rel='icon' href='imagens/icon.png' type='image/x-icon'>
    <center><br><br><table width='302' height='99' border='0' background='imagens/aviso.png' style='border-radius:5px; font-size:12px;'>
        <tr>
          <td style='padding-left:3px;'><b>Banido permanentemente</b><br>Você foi banido de nosso fã-site<br>por não respeitar os <u>termos de uso</u>.<br><br><i>Equipe Infolito</i></td>
        </tr>
      </table></center>";
} else {
    include("includes/conexao.php");
    include("includes/clean.php");

    $ip = $_SERVER['REMOTE_ADDR'];
    $manutencao = 0;
    if ($manutencao == 0) {
        ?>
        <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
            <title>Infolito - Te informando tudo sobre o Habbolito!</title>
            <link rel='icon' href='imagens/icon.png' type='image/x-icon'>
            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js"></script>
            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
            <script type="text/javascript" src="js/tip1.js"></script>
            <script type="text/javascript" src="js/tip2.js"></script>
            <script type="text/javascript" src="js/menu.js"></script>
            <script src="edils/js-image-slider.js" type="text/javascript"></script>
            <link href="edils/js-image-slider.css" rel="stylesheet" type="text/css" />
            <link href="css/css.css" media="all" rel="stylesheet" type="text/css" />
            <style type="text/css">
                <!--
                .style2 {color: #FFFFFF}
                -->
            </style>
        </head>

        <body>
        <div align="center">
            <div class="banner">
                <!-- MENU RÁPIDO-->
                <div class="conteudo_banner">
                    <div class="menu_conteudo2">
                        <div class="menu_rapido">
                            <span class="menu_divisao"><a href="?p=inicio"><img src="imagens/menu_home.png" width="22" height="22" border="0" title="Início" /></a></span>
                            <span class="menu_divisao"><a href="player2.php" target="topFrame"><img src="imagens/menu_play.png" width="22" height="22" border="0" title="Play"  /></a></span>
                            <span class="menu_divisao"><a href="stop.php" target="topFrame"><img src="imagens/menu_pausar.png" width="22" height="22" border="0" title="Stop" /></a></span>
                            <?php
                            if (($_SESSION['usr_ban'] == 0) && ($_SESSION['usr_level'] == 1) || ($_SESSION['usr_level'] == 2)) {
                                ?>
                                <span class="menu_divisao"><a href="?p=configuracoes"><img src="imagens/menu_config.png" width="22" height="22" border="0" title="Configurações"  /></a></span>
                          <?php
    $result = mysql_query("SELECT * FROM ma_recados WHERE recebeu = '".$_SESSION['usr_name']."' AND lido = 'n'");
    $numRows = mysql_num_rows($result);
?>

<span class="menu_divisao">
    <a href="?p=home&amp;usuario=<?php echo $_SESSION['usr_name']; ?>">
        <img src="imagens/menu_mensagem.png" width="22" height="22" border="0" title="Mensagens (<?php echo $numRows; ?>)"  />
    </a>
</span>

                                <span class="menu_divisao"><a href="?p=criar"><img src="imagens/menu_postar.png" width="22" height="22" border="0" title="Postar tópico"  /></a> </span>
                                <span class="menu_divisao"><a href="?p=criar_arte"><img src="imagens/menu_arte.png" width="22" height="22" border="0" title="Postar obra"  /></a> </span>
                                <span class="menu_divisao"><a href="?p=pedidos"><img src="imagens/menu_pedido.png" width="22" height="22" border="0" title="Pedir uma música"  /></a> </span>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <br />
                    <div class="logo"></div>
                </div>
            </div>
            <div id="sse2">
                <div id="sses2">
                    <ul>
                        <li><a href="?p=inicio">Início</a></li>
                        <li><a href="?p=infolito">Infolito</a></li>
                        <li><a href="?p=hotel">Habbo Lito</a></li>
                        <li><a href="?p=forum">Fórum</a></li>
                        <li><a href="?p=termosdeuso">Ajuda</a></li>
                        <li><a href="?p=rank">Rank</a></li>
                        <li><a href="?p=gerador">Fancenter</a></li>
                        <?php
                        if (($_SESSION['usr_ban'] == 0) && ($_SESSION['usr_level'] == 1) || ($_SESSION['usr_level'] == 2)) {
                            ?>
                            <li><a href="?p=meustopicos">Meus tópicos</a></li>
                            <li><a href="?login=logout">Deslogar-se</a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="site" align="center">
<!-- CONTEUDO -->
<div class="conteudo">
    <div class="conteudo_e" align="left">
        <?php
        $permitidos = array('avatar', 'bbcode', 'chat', 'blog', 'ban', 'configuracoes', 'criar', 'configuracoes', 'criar_arte', 'criarblog', 'editar', 'erro', 'esqueci', 'forum', 'gerador', 'grupos', 'infolito', 'home', 'hotel', 'inicio', 'meustopicos', 'noticias', 'oficina', 'pedidos', 'rank', 'registro', 'senha', 'termosdeuso', 'topico');

        $link = $_GET['p'];
        if(empty($link)){
            include("paginas/inicio.php");
        } else if((file_exists("paginas/{$link}.php")) && (in_array($link, $permitidos))){
            include("paginas/{$link}.php");
        } else {
            ?>
            <div align='left' style='background-color:#F9E8E8; border:1px solid #E4B6B7; width:500px; padding:10px; color:#B75759; border-radius:3px;'>
                <img src="imagens/erro.png" width="14" height="14" align="left" style="padding-right:5px;" />
                Não foi possível localizar esta página, certifique-se da URL digitada.
            </div>
            <?php
        }
        ?>
    </div>
    <?php
    $link = $_GET['p'];
    if(($link!="topico") && ($link!="home")){
        ?>
       <div class="conteudo_mais">
    <div class="conteudo_d">
        <!-- INICIO BOX -->
        <div class="box_conteudorosa">&Uacute;LTIMOS T&Oacute;PICOS</div>
        <div class="box_escreve" align="left">
            <?php
            $forum = "SELECT * FROM ma_forum ORDER BY not_id DESC LIMIT 3";
            $chamativo = mysqli_query($conexao, $forum) or die(mysqli_error($conexao));
            while($row = mysqli_fetch_array($chamativo)){
                ?>
                <table width="263" height="45" border="0" class="topico">
                    <tr>
                        <td width="48" align="center">
                            <img width="42" height="42" style="border-radius:3px;" src="<?php 
                                $avatar = mysqli_query($conexao, "SELECT avatar FROM usr_users WHERE username = '{$row['not_autor']}'") or die(mysqli_error($conexao));
                                $pega_avatar = mysqli_fetch_array($avatar);
                                echo $pega_avatar['avatar'];
                            ?>" />
                        </td>
                        <td width="205" valign="top" style="padding-top:5px;">
                            <a href="?p=topico&amp;id=<?php echo $row['not_id']; ?>" title="<?php echo $row['not_titulo']; ?>">
                                <span style="font-size:14px;">
                                    <?php
                                    $tamMax = 30;
                                    if(strlen($row['not_titulo']) > $tamMax) {
                                        echo substr($row['not_titulo'], 0, $tamMax) . '...';
                                    } else {
                                        echo $row['not_titulo'];
                                    }
                                    ?>
                                </span>
                            </a><br />
                            Por <?php echo $row['not_autor']; ?>
                        </td>
                    </tr>
                </table>
                <?php
            }
            ?>
        </div>
        <!-- FIM BOX 1 -->
    </div>
</div>
<div class="box_conteudorosa">&Uacute;LTIMOS REGISTRADOS</div>
<div class="box_escreve" align="left">
    <?php
    $usuario = "SELECT * FROM usr_users ORDER BY id DESC LIMIT 3";
    $chamativo = mysqli_query($conexao, $usuario) or die(mysqli_error($conexao));
    while($row = mysqli_fetch_array($chamativo)){
        ?>
        <table width="263" height="45" border="0" class="topico">
            <tr>
                <td width="48" align="center">
                    <img width="42" height="42" style="border-radius:3px;" src="<?php 
                        $avatar = mysqli_query($conexao, "SELECT avatar FROM usr_users WHERE username = '{$row['username']}'") or die(mysqli_error($conexao));
                        $pega_avatar = mysqli_fetch_array($avatar);
                        echo $pega_avatar['avatar'];
                    ?>" />
                </td>
                <td width="205" valign="top" style="padding-top:5px;">
                    <span style="font-size:14px;">
                        <a href="site.php?p=home&amp;usuario=<?php echo $row['username']; ?>">
                            <?php echo $row['username']; ?>
                        </a>
                    </span><br />
                    <?php
                    if($row['sexo'] == "M"){
                        echo "Masculino";
                    } else{
                        echo "Feminino";
                    }
                    echo " - ";
                    if($row['pais'] == "B"){
                        echo "Brasil";
                    } else{
                        echo "Portugal";
                    }
                    ?>
                </td>
            </tr>
        </table>
        <?php
    }
    ?>
</div>
<!-- FIM BOX 2 -->
<div class="box_conteudorosa">&Uacute;LTIMOS COMENT&Aacute;RIOS</div>
<div class="box_escreve" align="left">
    <?php
    $comentarios = "SELECT * FROM ma_forum f, ma_forum_comentarios c WHERE f.not_id = c.not_id ORDER BY comnot_id DESC LIMIT 3";
    $chamativo = mysqli_query($conexao, $comentarios) or die(mysqli_error($conexao));
    while($row = mysqli_fetch_array($chamativo)){
        ?>
        <table width="263" height="45" border="0" class="topico">
            <tr>
                <td width="48" align="center">
                    <img width="42" height="42" style="border-radius:3px;" src="<?php 
                        $avatar = mysqli_query($conexao, "SELECT avatar FROM usr_users WHERE username = '{$row['comnot_habbo']}'") or die(mysqli_error($conexao));
                        $pega_avatar = mysqli_fetch_array($avatar);
                        echo $pega_avatar['avatar'];
                    ?>" />
                </td>
                <td width="205" valign="top" style="padding-top:5px;">
                    <a href="?p=topico&amp;id=<?php echo $row['not_id']; ?>" title="<?php echo $row['not_titulo']; ?>">
                        <span style="font-size:14px;">
                            <?php
                            $tamMax = 30;
                            if(strlen($row['not_titulo']) > $tamMax) {
                                echo substr($row['not_titulo'], 0, $tamMax) . '...';
                            } else {
                                echo $row['not_titulo'];
                            }
                            ?>
                        </span>
                    </a><br />
                    <?php echo $row['comnot_habbo']; ?>, <?php echo $row['comnot_data']; ?>
                </td>
            </tr>
        </table>
        <?php
        $i++;
    }
    ?>
</div>
<!-- FIM BOX 3 -->
<!-- FIM BOX 4 -->
</div>
</div>
<?php } ?>
</div>
<!-- CONTEUDO -->
</div>
<div>
<!-- FIM CONTEUDO AZUL -->
<div class="forum">
    <div class="escrever" align="left">
        <div class="divisao_forum">
            <div class="logo_forum"></div>
        </div>
        <table width="263" height="48" cellpadding="0" cellspacing="0">
            <?php
            $sql = "SELECT *
                    FROM ma_forum
                    WHERE not_fixo = '1'
                    ORDER BY not_id DESC LIMIT 3";
            $res = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
            $i = 0;
            while ($row = mysqli_fetch_array($res)) {
                if ($i % 3 == 0) {
                    echo "<tr>";
                }
                ?>
                <td width="50%" valign="top" style="padding:5px;">
                    <table width="263" class="topico_forum" height="48" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="20%" height="46">
                                <div align="center">
                                    <img width="42" height="42" style="border-radius:3px;" src="<?php
                                    $avatar = mysqli_query($conexao, "SELECT avatar FROM usr_users WHERE username = '{$row['not_autor']}'") or die(mysqli_error($conexao));
                                    $pega_avatar = mysqli_fetch_array($avatar);
                                    echo $pega_avatar['avatar'];
                                    ?>" />
                                </div>
                            </td>
                            <td width="80%" valign="top" style="padding:5px;">
                                <a class="branco" href="?p=topico&id=<?= $row['not_id'] ?>" title="<?= $row['not_titulo'] ?>"><b>
                                        <?php
                                        $tamMax = 30;
                                        if (strlen($row['not_titulo']) > $tamMax)
                                            echo substr($row['not_titulo'], 0, $tamMax) . '...';
                                        else
                                            echo $row['not_titulo'];
                                        ?></b></a><br />
                                <?= $row['not_autor'] ?>,
                                <?= $row['not_data'] ?>
                                <br />
                                <?php
                                $ver = mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM ma_forum_comentarios WHERE not_id = '{$row['not_id']}'"));
                                echo $ver;
                                ?> coment&aacute;rios
                            </td>
                        </tr>
                    </table>
                </td>
                <?php
                $i++;
            }
            ?>
        </table>
        <br />
        <table width="263" height="48" cellpadding="0" cellspacing="0">
            <?php
            $sql = "SELECT *
                    FROM ma_forum
                    WHERE not_fixo = '0'
                    ORDER BY not_id DESC LIMIT 6";
            $res = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
            $i = 0;
            while ($row = mysqli_fetch_array($res)) {
                if ($i % 3 == 0) {
                    echo "<tr>";
                }
                ?>
                <td width="50%" valign="top" style="padding:5px;">
                    <table width="263" class="topico_forum" height="48" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="20%" height="46">
                                <div align="center">
                                    <img width="42" height="42" style="border-radius:3px;" src="<?php
                                    $avatar = mysqli_query($conexao, "SELECT avatar FROM usr_users WHERE username = '{$row['not_autor']}'") or die(mysqli_error($conexao));
                                    $pega_avatar = mysqli_fetch_array($avatar);
                                    echo $pega_avatar['avatar'];
                                    ?>" />
                                </div>
                            </td>
                            <td width="80%" valign="top" style="padding:5px;">
                                <a class="branco" href="?p=topico&id=<?= $row['not_id'] ?>" title="<?= $row['not_titulo'] ?>"><b>
                                        <?php
                                        $tamMax = 30;
                                        if (strlen($row['not_titulo']) > $tamMax)
                                            echo substr($row['not_titulo'], 0, $tamMax) . '...';
                                        else
                                            echo $row['not_titulo'];
                                        ?></b></a><br />
                                <?= $row['not_autor'] ?>,
                                <?= $row['not_data'] ?>
                                <br />
                                <?php
                                $ver = mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM ma_forum_comentarios WHERE not_id = '{$row['not_id']}'"));
                                echo $ver;
                                ?> coment&aacute;rios
                            </td>
                        </tr>
                    </table>
                </td>
                <?php
                $i++;
            }
            ?>
        </table>
        <br />
        <div class="divisao_forum">
            <div class="logo_ranking"></div>
        </div>
        <table width="263" height="48" cellpadding="0" cellspacing="0">
            <?php
            $sql = "SELECT *
                    FROM ma_conquista
                    ORDER BY pontos DESC LIMIT 3";
            $res = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
            $conta = mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM ma_conquista"));
            if ($conta > 0) {
                $i = 0;
                while ($row = mysqli_fetch_array($res)) {
                    if ($i % 3 == 0) {
                        echo "<tr>";
                    }
                    ?>
                    <td width="50%" valign="top" style="padding:5px;">
                        <table width="263" class="topico_forum" height="48" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="20%" height="46">
                                    <div align="center">
                                        <img width="42" height="42" style="border-radius:3px;" src="<?php
                                        $avatar = mysqli_query($conexao, "SELECT avatar FROM usr_users WHERE username = '{$row['nome']}'") or die(mysqli_error($conexao));
                                        $pega_avatar = mysqli_fetch_array($avatar);
                                        echo $pega_avatar['avatar'];
                                        ?>" />
                                    </div>
                                </td>
                                <td width="80%" valign="top" style="padding:5px;">
                                    <a class="branco" href="?p=home&usuario=<?= $row['nome'] ?>"><b><?= $row['nome'] ?></b></a><br />
                                    <?= $row['pontos'] ?> pontos
                                </td>
                            </tr>
                        </table>
                    </td>
                    <?php
                    $i++;
                }
            } else {
                echo ("<div align='left' style='background-color:#F9E8E8; border:1px solid #E4B6B7; width:800px; padding:10px; color:#B75759; border-radius:3px;'>Não há usuários com pontos no momento.</div><br>");
            }
            ?>
        </table>
        <br />
        <div class="divisao_forum">
            <div class="logo_oficina"></div>
        </div>
        <table width="174" height="48" cellpadding="0" cellspacing="0">
            <?php
            $sql = "SELECT *
                    FROM ma_oficina
                    ORDER BY not_id DESC LIMIT 10";
            $res = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));
            $i = 0;
            while ($row = mysqli_fetch_array($res)) {
                if ($i % 5 == 0) {
                    echo "<tr>";
                }
                ?>
                <td width="50%" valign="top" style="padding:5px;">
                    <table width="112" class="topico_forum" height="48" border="0" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="82%" height="46" valign="top" style="padding:5px;">
                                <div style="width:140px; height:140px; background-image:url(<?= $row['not_imagem'] ?>);">
                                    <div class="style2" style="background-image:url(imagens/comentarios.png); width:42px; height:42px; padding">
                                        <div style="padding-top:5px; padding-left:8px;">
                                            <?php echo $ver = mysqli_num_rows(mysqli_query($conexao, "SELECT * FROM ma_oficina_comentarios WHERE not_id = '{$row['not_id']}'")); ?>
                                        </div>
                                    </div>
                                </div>
                                <div style="padding-top:5px;">
                                    <a class="branco" href="site.php?p=oficina&id=<?= $row['not_id'] ?>" title="<?= $row['not_titulo'] ?>">
                                        <b>
                                            <?php
                                            $tamMax = 21;
                                            if (strlen($row['not_titulo']) > $tamMax)
                                                echo substr($row['not_titulo'], 0, $tamMax) . '...';
                                            else
                                                echo $row['not_titulo'];
                                            ?>
                                        </b>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
                <?php
                $i++;
            }
            ?>
        </table>
    </div>
</div>
<div class="rodape">
    <div class="escrever" align="left">
        <div style="float:right">Copyright © Infolito 2014
            <br />Este fã-site não é de propriedade ou operado do Habbolito
            <br /><i>Desenvolvido por Bruno Mendes(Lineu)</i>
        </div>
        <span style="font-size:24px; font-weight:bold;">INFOLITO</span>
        <br />Te informando tudo sobre o Habbolito!
    </div>
</div>
</div>
</div>
</body>

</html>
