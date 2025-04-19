<?php
use views\builders\FormBuilder;
use service\DesafioService;

$feedback = [];

if(isset($_GET["sucesso"]))
    $feedback = [
        $_GET["sucesso"],
        "padding: 10px; background-color: darkgreen; border-radius: 5px; font-weight: 600; margin-top: 5px; margin-bottom: 5px;",
        "<i class='fa-solid fa-check me-2'></i>"
    ];
else if(isset($_GET["erro"]))
    $feedback = [
        $_GET["erro"],
        "padding: 10px; background-color: crimson; border-radius: 5px; font-weight: 600; margin-top: 5px; margin-bottom: 5px;",
        "<i class='fa-solid fa-triangle-exclamation me-2'></i>"
    ];

$tituloPagina = "Cadastrar Desafio";
$desafioId = "";
$nomeValue = "";
$descricaoValue = "";
$rotaSalvar = "/mvcFitness/api/desafio/registrar";
if(isset($_GET["desafio_id"]))
{
    $desafiosService = new DesafioService();
    $desafio = $desafiosService->buscarPorId($_GET["desafio_id"]);
    
    if($desafio["usuario_id"] == $_SESSION["id"])
    {
        $nomeValue = $desafio["nome"];
        $descricaoValue = $desafio["descricao"];
        $desafioId = $_GET["desafio_id"];
    }

    $tituloPagina = "Editar Desafio";
    $rotaSalvar = "/mvcFitness/api/desafio/atualizar";
}

$formBuilder = new FormBuilder(
    action: $rotaSalvar, 
    method: 'POST', 
    titulo: $tituloPagina, 
    descricaoPagina: "Preencha as informações do seu desafio e compartilhe com a comunidade",
    rotaVoltar: '/mvcFitness/home',
    feedback: $feedback
);
$formBuilder->addInput(
    type: 'hidden', 
    name: 'id', 
    label: '', 
    placeholder: '',
    value: $desafioId
);
$formBuilder->addInput(
    type: 'text', 
    name: 'nome', 
    label: 'Nome', 
    placeholder: 'Digite aqui o nome do desafio',
    value: $nomeValue
);
$formBuilder->addTextarea(
    name: 'descricao', 
    label: 'Descrição', 
    placeholder: 'Digite aqui a descrição do desafio',
    value: $descricaoValue
);
$formBuilder->addButton(
    label: 'Salvar'
);
$form = $formBuilder->render();

if(isset($_GET["sucesso"]))
{

}

echo <<<HTML
    <div class="container">
        $form
    </div>
HTML;