<?php
namespace views\components;

class CardsDesafio
{
    public static function render($titulo, $descricao, $progresso, $onclick, $usuario, $rotaEditar, $rotaExcluir): string
    {
        $buttons = "";
        if($usuario == $_SESSION["id"])
            $buttons = <<<HTML
                <div class="d-flex flex-column gap-2" style="width: 10%;">
                    <button onclick="window.location.href = '$rotaEditar'" style="color: DeepSkyBlue; background-color: transparent; border: none; padding: 8px;" class="d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-pen me-2"></i>
                        Editar
                    </button>
                    <button onclick="window.location.href = '$rotaExcluir'" style="color: crimson; background-color: transparent; border: none; padding: 8px;" class="d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-trash me-2"></i>
                        Excluir
                    </button>
                </div>
            HTML;

        return <<<HTML
            <div class="d-flex gap-4">
                <div class="challenge-card" onclick="$onclick" style="cursor: pointer; width: 100%;">
                    <div style="width: 100%;" class="d-flex justify-content-between">
                        <div class="challenge-info">
                            <strong class="challenge-title">$titulo</strong>
                            <p class="challenge-desc">$descricao</p>
                        </div>
                        <div class="challenge-progress">$progresso</div>
                    </div>
                </div>
                $buttons
            </div>
        HTML;
    }
}