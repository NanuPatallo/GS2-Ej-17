<?php

header('Content-type:application/json');

require_once '../../modelo/vehiculo.php';
require_once '../../modelo/contacto.php';
require_once 'request/nuevoRequest.php';
require_once 'responses/nuevoResponse.php';

$json = file_get_contents('php://input', true);
$req = json_decode($json);

$req = new NuevoRequest();

$res = new NuevoResponse();

if ($req->NroPoliza>1000&&$req->NroPoliza<0) {
    $res->IsOk=false;
    $res->Mensaje='La Póliza no existe.';
} elseif () {} 
