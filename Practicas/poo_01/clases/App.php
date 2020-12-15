<?php


class App{
    private function printHead(){
        include_once ("gui/head.html");
    }
    private function printBody(){
        include_once ("gui/body.php");
        $annadir = isset($_REQUEST["btnAnnadir"]);
        $mostrar = isset($_REQUEST["btnMostrar"]);

        switch (true) {
            case $annadir:
                include_once("gui/formAnnadir.php");
                break;
            case $mostrar:
                include_once("gui/formMostrar.php");
                break;
        }
    }
    private function printFoot(){
        include_once ("gui/foot.html");
    }

    private function printTipoVia(){
        $bbdd = new BBDD();
        $tiposvias = $bbdd->getTiposVias();
        unset($bbdd);
        echo '<select name="tipovia">';
        foreach ($tiposvias as $tipovia)
            echo "<option value=\"{$tipovia['cod']}\">{$tipovia['descri']}</option>";
        echo '</select>';
    }

    private function printUsuario(){
        $bbdd = new BBDD();
        $personas = $bbdd->getPersonas();
        unset($bbdd);
        echo '<select name="slcPersona">';
        foreach ($personas as $persona)
            echo "<option value=\"{$persona->dni}\">{$persona->dni}/{$persona->nombre}</option>";
        echo '</select>';
    }
    public function run($p=null){
        $this->printHead();
        if (isset($p['datos'])){
            $pers=new Persona($p['dni'],$p['nombre'],$p['ap1'],$p['ap2'],$p['tipovia'],$p['direccion']);
            $bbdd = new BBDD();
            if ( $bbdd->setPersona($pers)) echo "<h2>Grabado</h2>";
            unset($bbdd);
        }
        $this->printBody();
        
        if(isset($p['slcPersona'])){
            $bbdd = new BBDD();
            var_dump($bbdd->getPersona($p['slcPersona'],'personas'));
            unset($bbdd);
        }
        $this->printFoot();
    }
}