<?php


class App
{
    private function printHead()
    {
        include_once("gui/head.html");
    }
    private function printBody()
    {
        $pisos = isset($_REQUEST["slcCiudad"]);

        switch (true) {
            case $pisos:
                include_once("gui/pisos.php");
                break;
            default:
                include_once("gui/slcCiudad.php");
                break;
        }
    }
    private function printFoot()
    {
        include_once("gui/foot.html");
    }

    private function printProvincias()
    {
        $bbdd = new BBDD();
        $ciudades = $bbdd->getProvincias();
        unset($bbdd);
        echo '<select name="slcCiudad">';
        foreach ($ciudades as $ciudad)
            echo "<option value=\"{$ciudad['id_provincia']}\">{$ciudad['provincia']}</option>";
        echo '</select>';
    }

    private function printPisos($ciudad)
    {
        $bbdd = new BBDD();
        $pisos = $bbdd->getPisos($ciudad);
        unset($bbdd);
        
        if($pisos)
        foreach ($pisos as $piso){
            $descripcion="{$piso['municipio']},{$piso['provincia']},{$piso['calle']},{$piso['numero']}";
            
            $ascensor="No";
            if($piso['ascensor']>0) $ascensor="Si";
            
            $garaje="No";
            if($piso['garaje']>0) $garaje="Si";
            
            $trastero="No";
            if($piso['trastero']>0) $trastero="Si";
            
            $calefaccion="No";
            if($piso['calefaccion']>0) $calefaccion="Si";

            echo "<div class='piso'>
            <div class='info'>
                <table>
                    <tr><td>Direccion: </td><td>{$descripcion}</td></tr>
                    <tr><td>Codigó postal: </td><td>{$piso['cp']}</td></tr>
                    <tr><td>Antigüedad: </td><td>{$piso['antiguedad']}años</td></tr>
                    <tr><td>Habitaciones: </td><td>{$piso['numhabitaciones']}</td></tr>
                    <tr><td>Baños: </td><td>{$piso['numbaños']}</td></tr>
                    <tr><td>Ascensor: </td><td>{$ascensor}</td></tr>
                    <tr><td>Garaje: </td><td>{$garaje}</td></tr>
                    <tr><td>Trastero:</td><td>{$trastero}</td></tr>
                    <tr><td>Calefacción:</td><td>{$calefaccion}</td></tr>
                </table>
            </div>
            <div class='mapa'>
                <iframe
                width='600'
                height='450'
                frameborder='0' style='border:0'
                src='https://www.google.com/maps/embed/v1/place?key=AIzaSyCiQ6EncBFahWgpw96QKLPmMKZmwiMopXA
                &q={$descripcion}+ES' allowfullscreen>
                </iframe>
            </div>
            </div>";
        }
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
