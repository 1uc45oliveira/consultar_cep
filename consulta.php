<?php

// Contagem dos caracteres digitados pelo usuario
$cep = strlen($_POST['cep']);

// Verificando se o CEP digitado pelo usuario tem 8 digitos. Se nao houver 8 digitos sera exibida uma mensagem.
if($cep <> 8){
    echo "Ao digitar o CEP certifique a quantidade de 8 digitos, somente números. <br> ";

    // Chamando a funcao que cria um link para voltar a tela inicial
    voltar();

    return;
}

// Fazendo a requisicao para a API com o CEP digitado pelo usuario e guardando as informacoes retornadas em uma variavel.
$resp = json_decode(file_get_contents('https://viacep.com.br/ws/' . $_POST['cep'] . '/json/'));

// Se o CEP digitado pelo usuario nao existir na base de dados da API, sera exibida uma mensagem na tela.
if(!empty($resp->erro)){
    
    echo 'CEP não encontrado na base de dados';

    // Chamando a funcao que cria um link para voltar a tela inicial
    voltar();

    return;
}

// Imprimindo informacoes na tela para o usuario apos a consulta.
echo "CEP -> ". $resp->cep . pulaLinha(1);
echo "Logradouro -> ". $resp->logradouro . pulaLinha(1);
echo "Bairro -> ". $resp->bairro . pulaLinha(1);
echo "Cidade -> ". $resp->localidade . pulaLinha(1);
echo "Estado -> ". $resp->uf . pulaLinha(1);

// Chamando a funcao que cria um link para voltar a tela inicial
voltar();

// criando funcao que cria o link para voltar a tela inicial
function voltar(){
    echo pulaLinha(2) . "<a href='" . $_SERVER['HTTP_REFERER'] . "'>Voltar</a>";
}

// criando uma funcao para quebra de linha quando for necessario na impressao dos dados.
// devera ser informado a quantidade de linhas como parametro
function pulaLinha($qntLinhas){

    // enquanto o contador for menor que a qntLinhas sera adicionado uma quebra de linha
    for ($i=0; $i < $qntLinhas; $i++) { 
        
        // quebra de linha
        echo '<br>';
    }  

}

?>