<?php
if (isset($_SESSION['usuario'])) {
    registroActividad($_SESSION['usuario'], true, "Cerrar sesión");
    unset($_SESSION['usuario']);
    unset($_SESSION['tipo']);
}
