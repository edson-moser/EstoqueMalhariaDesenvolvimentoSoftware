<?php
require 'loginCadastro.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ilka Reblin · Login</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="login.css">
</head>

<body>

<div class="container">
    <div class="content second-content">
        <div class="first-column">
            <img src="LOGO-ILKA-REBLIN-TRANSPARENTE.png" alt="Logo" class="logo">
            <h2 class="title title-primary">Olá Costureira(o)!</h2>
            <p class="description description-primary">
                Faça o login e vamos transformar a sua empresa!
            </p>
        </div>

        <!-- Lado direito -->
        <div class="second-column">
            <h2 class="title title-second">Faça o login</h2>
            <p class="description description-second">
                Insira o login e sua senha:
            </p>

            <!-- Mensagem de erro -->
            <?php if (isset($erro)) { ?>
                <p style="color:red;"><?php echo $erro; ?></p>
            <?php } ?>

            <form class="form" method="POST">

                <label class="label-input">
                    <i class="far fa-user icon-modify"></i>
                    <input name="login" type="text" placeholder="Login" required>
                </label>

                <label class="label-input">
                    <i class="fas fa-lock icon-modify"></i>
                    <input name="senha" type="password" placeholder="Senha" required>
                </label>

                <button type="submit" class="btn btn-second">
                    Entrar
                </button>

            </form>
        </div>

    </div>
</div>

</body>
</html>