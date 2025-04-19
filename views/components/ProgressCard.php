<?php
namespace views\components;

class ProgressCard {
    public static function render($usuario, $nomeUsuario, $registro, $rotaEditar) {
        $registro =  str_pad(substr($registro, 0, 2), 2, "0");

        $buttons = "";
        if($usuario == $_SESSION["id"])
            $buttons = <<<HTML
                <div class="d-flex flex-column gap-2 align-items-center justify-content-center" style="width: 10%;">
                    <button onclick="window.location.href = '$rotaEditar'" style="color: DeepSkyBlue; background-color: transparent; border: none; padding: 8px;" class="d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-pen me-2"></i>
                        Editar
                    </button>
                </div>
            HTML;

        return <<<HTML
            <div class="d-flex gap-4">
                <div class='card-progresso d-flex justify-content-between align-items-center' style="width: 100%;">
                    <div class="usuario">
                        <i class="fa-solid fa-reply"></i>
                        <div class=''>{$nomeUsuario}</div>
                    </div>
                    <div class="challenge-progress">{$registro}%</div>
                </div>
                $buttons
            </div>
        HTML;
    }
}