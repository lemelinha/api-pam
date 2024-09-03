<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAM</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <main>
        <div class="btns">
            <a href="#produtos">Produtos</a>
            <a href="#cadastrar">Cadastrar</a>
        </div>
        <section id="produtos">
            <?php
                foreach($produtos as $produto):
                ?>
                    <div class="produto">
                        <h1><?= $produto['nm_produto'] ?></h1>
                        <img src="<?= $produto['url_imagem'] ?>">
                        <p>Quantidade: <?= $produto['qt_pote'] ?></p>
                        <p><?= $produto['ds_produto'] ?></p>
                        <div class="acoes">
                            <button class="alterar" id="<?= $produto['cd_produto'] ?>">Alterar</button>
                            <button class="deletar" id="<?= $produto['cd_produto'] ?>">Deletar</button>
                        </div>
                    </div>
                <?php
                endforeach;
            ?>
        </section>
        <section id="cadastrar" style="display: none">
            <form id="form-cadastrar" method="post">
                <input type="text" name="nome" placeholder="Nome">
                <input type="text" name="qt" placeholder="Quantidade">
                <input type="text" name="ds" placeholder="Descrição">
                <input type="submit" value="Cadastrar">
            </form>
        </section>
        <script>
            $('.btns a').click(function () {
                $('main section').each(function () {
                    $(this).css('display', 'none')
                })
                let id = $(this).attr('href')
                // console.log( $(this).attr('href'))
                $(id).css('display', 'block')
            })

            
        </script>
    </main>
</body>
</html>