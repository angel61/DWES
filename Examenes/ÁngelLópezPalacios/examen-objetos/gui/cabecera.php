<div class="titulo">
    <h1>Ángel López Palacios</h1>
    <?php
    $tipoUsu = ["i" => "Invitado", "u" => "Usuario", "a" => "Administrador"];
    $usuario = $_SESSION['usuario'] ?? 'Invitado';
    $tipo = $_SESSION['tipo'] ?? 'i';
    echo "Bienvenido " . $usuario . " tu cuenta es de tipo: " . $tipoUsu[$tipo];
    ?>
</div>