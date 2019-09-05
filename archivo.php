
<?php
$fichero = 'gente.txt';
// La nueva persona a añdir al fichero
$persona = "John Smith\n";
// Escribir los contenidos en el fichero,
// usando la bandera FILE_APPEND para añadir el contenido al final del fichero
// y la bandera LOCK_EX para evitar que cualquiera escriba en el fichero al mismo tiempo
file_put_contents($fichero, $persona, FILE_APPEND | LOCK_EX);
?>