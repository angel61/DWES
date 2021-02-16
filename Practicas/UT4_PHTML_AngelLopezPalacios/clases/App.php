<?php


class App
{
    private function printConferencias()
    {
        $pweb = new PaginaWeb('Conferencia');

        $form1 = new Formulario('frm1', 'POST', 'index.php');

        $bbdd = new BBDD();
        $slcConferencia = new Desplegable('slcConferencia', $bbdd->getConferencias());
        unset($bbdd);

        $lblConferencia = new Etiqueta($slcConferencia->nombre, "Conferencias: ");
        $filaForm1 = new Fila([$lblConferencia, $slcConferencia]);

        $submit = new input('submit', 'submit', 'Enviar');
        $filaForm2 = new Fila([$submit]);

        $tablaForm = new Tabla([$filaForm1, $filaForm2], 0);

        $form1->addElemento($tablaForm);
        $pweb->addElemento($form1);
        echo $pweb;
    }
    private function printEquipos($conferencia)
    {
        $pweb = new PaginaWeb('Equipos');

        $form1 = new Formulario('frm1', 'POST', 'index.php');

        $bbdd = new BBDD();
        $slcEquipo = new Desplegable('slcEquipo', $bbdd->getEquipos($conferencia));
        unset($bbdd);

        $lblEquipo = new Etiqueta($slcEquipo->nombre, "Equipos: ");
        $filaForm1 = new Fila([$lblEquipo, $slcEquipo]);

        $submit = new input('submit', 'submit', 'Enviar');
        $filaForm2 = new Fila([$submit]);

        $tablaForm = new Tabla([$filaForm1, $filaForm2], 0);

        $form1->addElemento($tablaForm);
        $pweb->addElemento($form1);
        echo $pweb;
    }

    private function printJugadores($equipo)
    {
        $bbdd = new BBDD();
        $jugadores = $bbdd->getJugadores($equipo);
        unset($bbdd);

        $pweb = new PaginaWeb('Equipos');

        $tabla = new Tabla();

        $encabezado = new Fila();
        $encabezado->addEncabezado("codigo");
        $encabezado->addEncabezado("Nombre");
        $encabezado->addEncabezado("Procedencia");
        $encabezado->addEncabezado("Altura");
        $encabezado->addEncabezado("Peso");
        $encabezado->addEncabezado("Posicion");
        $encabezado->addEncabezado("Nombre_equipo");
        $tabla->addFila($encabezado);

        foreach ($jugadores as $jugador) {
            $fila = new Fila($jugador);
            $tabla->addFila($fila);
        }

        $pweb->addElemento($tabla);
        echo $pweb;
    }

    public function run($p = null)
    {
        $equipo = isset($p["slcConferencia"]);
        $jugadores = isset($p["slcEquipo"]);

        switch (true) {
            case $equipo:
                $this->printEquipos($p["slcConferencia"]);
                break;
            case $jugadores:
                $this->printJugadores($p["slcEquipo"]);
                break;
            default:
                $this->printConferencias();
                break;
        }
    }
}
