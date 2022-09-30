<?php

header('Content-type:application/json');

require_once '../../modelo/vehiculo.php';
require_once '../../modelo/contacto.php';
require_once 'request/nuevoRequest.php';
require_once 'responses/nuevoResponse.php';

$json = file_get_contents('php://input', true);
$req = json_decode($json);

$res = new NuevoResponse();
$res->IsOk = true;


if ($req->NroPoliza > 1000 or $req->NroPoliza < 0) {
    $res->IsOk = false;
    $res->Mensaje[] = 'La Póliza no existe.';
} else {
    if ($req->Vehiculo == null) {
        $res->IsOk = false;
        $res->Mensaje[] = 'Debe indicar el Vehículo';
    } elseif (
        $req->Vehiculo->Marca == null or $req->Vehiculo->Modelo == null or
        $req->Vehiculo->Version == null or $req->Vehiculo->Anio == null
    ) {
        $res->IsOk = false;
        $res->Mensaje[] = 'Debe indicar todas las propiedades del Vehículo';
    }
    if ($req->ListMediosContacto == null) {
        $res->IsOk = false;
        $res->Mensaje[] = 'Debe indicar al menos un Medio de Contacto';
    } else {
        foreach ($req->ListMediosContacto as $c) {
            if ($c->MedioContactoDescripcion <> 'Celular' && $c->MedioContactoDescripcion <> 'Email') {
                $res->IsOk = false;
                $res->Mensaje[] = 'Debe indicar Medios de Contactos válidos';
            }
        }
    }
}

echo json_encode($res);
