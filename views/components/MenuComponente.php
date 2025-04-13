<?php
class MenuComponente
{
    private string $username;
    private string $userLink;
    private string $showButton;
    private string $buttonLink;

    public function __construct(
        string $username, string $userLink = '#', bool $showButton = true, string $buttonLink = '#'
    ) 
    {
        $this->username = $username;
        $this->userLink = $userLink;
        $this->showButton = $showButton;
        $this->buttonLink = $buttonLink;
    }
    
    public function render()
    {
        $buttonHTML = '';

        if ($this->showButton) {
            $buttonHTML = <<<HTML
                <a href="{$this->buttonLink}" 
                style="background-color: #ff5e6c; 
                padding: 10px 20px; 
                color: white; 
                border-radius: 8px; 
                text-decoration: none; 
                display: flex; 
                align-items: center; 
                gap: 5px; 
                font-weight: bold;">
                    <span style="font-size: 18px;"></span> Cadastrar
                </a>
            HTML;
        }

        return <<<HTML
            
        HTML;
    }
}