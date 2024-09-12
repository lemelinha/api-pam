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
        <div class="nav">
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
                        <div class="btns">
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
                <input type="url" name="imagem" placeholder="Imagem (link)">
                <input type="submit" value="Cadastrar">
            </form>
        </section>
        <section id="alterar" style="display: none">
            <button class="voltar">
                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M2.117 12l7.527 6.235-.644.765-9-7.521 9-7.479.645.764-7.529 6.236h21.884v1h-21.883z"/></svg>
            </button>
            <h1></h1>
            <form method="PUT">
                <input type="text" name="nome" placeholder="Nome" id="nome">
                <input type="number" name="qt" placeholder="Quantidade" id="qt">
                <input type="text" name="ds" placeholder="Descrição" id="ds">
                <input type="url" name="imagem" placeholder="Imagem (link)" id="imagem">
                <input type="submit" value="Alterar">
            </form>
            <script>
                $('#alterar form').on('submit', function(e) {
                    e.preventDefault()
                    $.ajax({
                        url: `/alterar/${$(this).attr('id')}`,
                        type: 'PUT',
                        data: $(this).serialize(),
                        dataType: 'json'
                    })
                    .done(function (data) {
                        alert(data.msg)
                        window.location.href = '/'
                    })
                })
            </script>
        </section>
        <script>
            $('.nav a').click(function () {
                $('main section').each(function () {
                    $(this).css('display', 'none')
                })
                let id = $(this).attr('href')
                // console.log( $(this).attr('href'))
                $(id).css('display', 'block')
            })

            $('.btns button.deletar').click(function () {
                $.ajax({
                    url: `/deletar/${$(this).attr('id')}`,
                    type: 'DELETE',
                    dataType: 'json',
                })
                .done(function (data) {
                    alert(data.msg)
                    window.location.reload()
                })
            })

            $('.btns button.alterar').click(function () {
                $('section#produtos').css('display', 'none')
                $('section#alterar').css('display', 'block')
                

                getProduto($(this).attr('id'))
            })

            $('section#alterar button.voltar').click(function () {
                $('section#produtos').css('display', 'block')
                $('section#alterar').css('display', 'none')
            })

            const getProdutos = () => {
                $.ajax({
                    url: '/produtos',
                    type: 'GET',
                    dataType: 'html',
                    data: {html: true}
                })
                .done(function (data) {
                    $('section#produtos').html(data)
                })
                .catch(function () {
                    alert('algo deu errado')
                })
            }

            const getProduto = (id) => {
                $.ajax({
                    url: `/produto/${id}`,
                    type: 'GET',
                    dataType: 'json'
                })
                .done(function (data) {
                    $('section#alterar h1').text('ID: ' + data.produto.cd_produto)
                    $('section#alterar input#nome').val(data.produto.nm_produto)
                    $('section#alterar input#qt').val(data.produto.qt_pote)
                    $('section#alterar input#ds').val(data.produto.ds_produto)
                    $('section#alterar input#imagem').val(data.produto.url_imagem)
                    $('section#alterar form').attr('id', data.produto.cd_produto)
                })
                .catch(function () {
                    alert('algo deu errado')
                })
            }
        </script>
    </main>
</body>
</html>