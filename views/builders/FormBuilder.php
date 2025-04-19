<?php

namespace views\builders;

class FormBuilder
{
    private array $fields = [];
    private string $action;
    private string $method;
    private string $rotaVoltar;

    private string $titulo;
    private string $descricao;

    private array $feedback;

    public function __construct(string $action = '', string $method = 'POST', string $titulo = "", string $descricaoPagina = "", string $rotaVoltar = "", array $feedback = []) {
        $this->action = $action;
        $this->method = strtoupper($method);
        $this->titulo = $titulo;
        $this->descricao = $descricaoPagina;
        $this->rotaVoltar = $rotaVoltar;
        $this->feedback = $feedback;
    }

    public function addInput(string $type, string $name, string $label, string $placeholder = '', string $value = ""): self {
        $value = htmlspecialchars($value);
        $this->fields[] = [
            'type' => $type,
            'name' => $name,
            'label' => $label,
            'placeholder' => $placeholder,
            'value' => $value
        ];
        return $this;
    }

    public function addTextarea(string $name, string $label, string $placeholder = '', string $value = ""): self 
    {
        $value = htmlspecialchars($value);
        $this->fields[] = [
            'type' => 'textarea',
            'name' => $name,
            'label' => $label,
            'placeholder' => $placeholder,
            'value' => $value
        ];
        return $this;
    }

    public function addButton(string $label = 'Enviar'): self 
    {
        $this->fields[] = [
            'type' => 'submit',
            'label' => $label
        ];
        return $this;
    }

    public function render(): string 
    {
        $h1Style = "";
        $buttonVoltar = "";
        $mensagem = "";

        if(isset($_SESSION["nome"]))
        {
            $h1Style = isset($_SESSION["nome"]) ? "color: #FF8C1A; font-weight: 700;" : "";
            if($this->rotaVoltar)
                $buttonVoltar = <<<HTML
                    <button 
                    style="background-color: transparent; border: none;" 
                    onclick="window.location.href = '{$this->rotaVoltar}'">
                        <i class="fa-solid fa-arrow-left me-2" style="color: #FF8C1A; font-size: 32px; opacity: 0.6;"></i>
                    </button>
                HTML;
        }

        if($this->feedback)
        {
            [ $mensagemTexto, $style, $icon] = $this->feedback;

            $mensagem = <<<HTML
                <div class="mensagem-feedback" style="$style">
                    {$icon}{$mensagemTexto}
                </div>
            HTML;
        }

        $form = <<<HTML
            $mensagem
            <div class="d-flex">
                $buttonVoltar
                <h1 style="$h1Style">{$this->titulo}</h1>
            </div>
            <p>{$this->descricao}</p>
            <form action="{$this->action}" method="{$this->method}" class="d-flex flex-column gap-4">
        HTML;
        
        foreach ($this->fields as $field) {
            switch ($field['type']) {
                case 'textarea':
                    $form .= <<<HTML
                        <fieldset>
                            <label>{$field['label']}</label>
                            <textarea name="{$field['name']}" placeholder="{$field['placeholder']}" style="height: 25rem;">{$field['value']}</textarea>
                        </fieldset>
                    HTML;
                    break;

                case 'submit':
                    $form .= <<<HTML
                        <button type="submit" class="btn-salvar">{$field['label']}</button>
                    HTML;
                    break;

                default:
                    $hide = "";
                    if($field['type'] == "hidden")
                        $hide = "display: none;";

                    $form .= <<<HTML
                        <fieldset style="$hide">
                            <label>{$field['label']}</label>
                            <input type="{$field['type']}" name="{$field['name']}" placeholder="{$field['placeholder']}" value="{$field['value']}">
                        </fieldset>
                    HTML;
                    break;
            }
        }
        
        $form .= <<<HTML
            </form>
        HTML;
        
        return $form;
    }
}