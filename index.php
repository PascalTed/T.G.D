<?php
require_once('controller/controller.php');

try {

demarrer();

}
catch(Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}

?>