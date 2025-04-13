<?php

namespace views\builders;

class FormBuilder
{
    private array $fields = [];
    private string $action;
    private string $method;

    private string $titulo;
    private string $descricao;

    public function __construct(string $action = '', string $method = 'POST', string $titulo = "", string $descricaoPagina = "") {
        $this->action = $action;
        $this->method = strtoupper($method);
        $this->titulo = $titulo;
        $this->descricao = $descricaoPagina;
    }

    public function addInput(string $type, string $name, string $label, string $placeholder = ''): self {
        $this->fields[] = [
            'type' => $type,
            'name' => $name,
            'label' => $label,
            'placeholder' => $placeholder
        ];
        return $this;
    }

    public function addTextarea(string $name, string $label, string $placeholder = ''): self 
    {
        $this->fields[] = [
            'type' => 'textarea',
            'name' => $name,
            'label' => $label,
            'placeholder' => $placeholder
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
        $form = <<<HTML
            <h1>{$this->titulo}</h1>
            <p>{$this->descricao}</p>
            <form action="{$this->action}" method="{$this->method}" class="d-flex flex-column gap-4">
        HTML;
        
        foreach ($this->fields as $field) {
            switch ($field['type']) {
                case 'textarea':
                    $form .= <<<HTML
                        <fieldset>
                            <label>{$field['label']}</label>
                            <textarea name="{$field['name']}" placeholder="{$field['placeholder']}"></textarea>
                        </fieldset>
                    HTML;
                    break;

                case 'submit':
                    $form .= <<<HTML
                        <button type="submit">{$field['label']}</button>
                    HTML;
                    break;

                default:
                    $form .= <<<HTML
                        <fieldset>
                            <label>{$field['label']}</label>
                            <input type="{$field['type']}" name="{$field['name']}" placeholder="{$field['placeholder']}">
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