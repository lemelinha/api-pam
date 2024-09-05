<?php
    foreach($rep as $produto):
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
