<?php
chmod(__DIR__ . '/storage', 0775);
chmod(__DIR__ . '/bootstrap/cache', 0775);
echo "Permisos actualizados correctamente.";
?>
