<?php

define('FUNCAO_ALVO', 'function funcao_autodestrutiva()');

function funcao_autodestrutiva() {
    echo "Esta função se autodestruirá após a execução.\n";

    $nome_arquivo = 'autodead.php';

    // Abrir o arquivo para leitura
    $conteudo = file_get_contents($nome_arquivo);
    if ($conteudo === false) {
        die("Erro ao abrir o arquivo");
    }

    // Encontrar o início da função
    $inicio_funcao = strpos($conteudo, FUNCAO_ALVO);
    if ($inicio_funcao === false) {
        echo "Função não encontrada no arquivo.\n";
        exit;
    }

    // Encontrar o fim da função
    $fim_funcao = strpos($conteudo, '}', $inicio_funcao);
    if ($fim_funcao === false) {
        echo "Fim da função não encontrado.\n";
        exit;
    }
    $fim_funcao += 1; // Incluir o caractere '}'

    // Excluir a função do conteúdo
    $novo_conteudo = substr($conteudo, 0, $inicio_funcao) . substr($conteudo, $fim_funcao);

    // Escrever o novo conteúdo no arquivo
    $resultado = file_put_contents($nome_arquivo, $novo_conteudo);
    if ($resultado === false) {
        die("Erro ao abrir o arquivo para escrita");
    }
}

// Chama a função
funcao_autodestrutiva();
?>
