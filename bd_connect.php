<?php
// Conecta ao BD
        $conexao = new mysqli("127.0.0.1", "root", NULL, "rede_social");

        // Deu erro ao conectar?
        if ($conexao->connect_error) {
        echo "Erro de Conexão!<br>".$conexao->connect_error;
        }

?>