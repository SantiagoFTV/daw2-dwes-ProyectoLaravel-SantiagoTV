<?php

    //1. Cargar el documento HTML
    $doc = new DOMDocument();
    @$doc->loadHTMLFile('poc.html');


    //2. Encuentra el nodo
    $spanUsuario = $doc->getElementById('usuario');


    //3. Escribo el nuevo nodo
    $nodoTexto = $doc -> createTextNode('Santiago Francisco');
    $spanUsuario -> appendChild($nodoTexto);

    //a. Cargar el json
    $json = file_get_contents('datos.json');
    $datos = json_decode($json);
    echo "<pre>";var_dump($datos->frameworks_php); die();

    //4. Generamos y enviamos el HTML
    $html = $doc->saveHTML();
    echo $html;

?>