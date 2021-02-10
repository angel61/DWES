<?php


class App
{
    private function printHead()
    {
        include_once("gui/head.html");
    }
    private function printBody()
    {
        include_once("gui/body.php");
        $annadir = isset($_REQUEST["btnAnnadir"]);
        $mostrar = isset($_REQUEST["btnMostrar"]);
        $modificarSelect = isset($_REQUEST["btnModificar"]);
        $modificarForm = isset($_REQUEST['slcPersonaUpdate']);

        switch (true) {
            case $annadir:
                include_once("gui/formAnnadir.php");
                break;
            case $mostrar:
                include_once("gui/formMostrar.php");
                break;
            case $modificarSelect:
                include_once("gui/slcModificar.php");
                break;
            case $modificarForm:
                include_once("gui/formModificar.php");
                break;
        }
    }
    private function printFoot()
    {
        include_once("gui/foot.html");
    }

    private function printTipoVia()
    {
        $bbdd = new BBDD();
        $tiposvias = $bbdd->getTiposVias();
        unset($bbdd);
        echo '<select name="tipovia">';
        foreach ($tiposvias as $tipovia)
            echo "<option value=\"{$tipovia['cod']}\">{$tipovia['descri']}</option>";
        echo '</select>';
    }

    private function printDatosUsuario($persona)
    {
        
    }

    private function printUsuario($texto)
    {
        $bbdd = new BBDD();
        $personas = $bbdd->getPersonas();
        unset($bbdd);
        echo '<select name="slcPersona' . $texto . '">';
        foreach ($personas as $persona)
            echo "<option value=\"{$persona->dni}\">{$persona->dni}/{$persona->nombre}</option>";
        echo '</select>';
    }
    public function run($p = null)
    {
        $this->printHead();
        if (isset($p['datos'])) {
            $pers = new Persona($p['dni'], $p['nombre'], $p['ap1'], $p['ap2'], $p['tipovia'], $p['direccion']);
            $bbdd = new BBDD();
            if ($bbdd->setPersona($pers)) echo "<h2>Grabado</h2>";
            unset($bbdd);
        }
        if (isset($p['datosMod'])) {
            $pers = new Persona( $_SESSION['dniUpdate'],$p['nombre'], $p['ap1'], $p['ap2'], $p['tipovia'], $p['direccion']);
            $bbdd = new BBDD();
            if ($bbdd->updatePersona($pers)) echo "<h2>Grabado</h2>";
            unset($bbdd);
        }
        $this->printBody();

        if (isset($p['slcPersonaListado'])) {
            $bbdd = new BBDD();
            var_dump($bbdd->getPersona($p['slcPersonaListado'], 'personas'));
            unset($bbdd);
        }
        if (isset($p['slcPersonaUpdate'])) {
            $_SESSION['dniUpdate']=$p['slcPersonaUpdate'];
        }
        $this->printFoot();
    }
}
