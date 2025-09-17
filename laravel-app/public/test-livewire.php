<?php
echo "Base URL: " . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "<br>";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
echo "Script Name: " . $_SERVER['SCRIPT_NAME'] . "<br>";
echo "PHP Self: " . $_SERVER['PHP_SELF'] . "<br>";

// Verificar si el archivo de Livewire existe
$livewire_path = __DIR__ . '/vendor/livewire/livewire.js';
echo "Livewire file exists: " . (file_exists($livewire_path) ? 'YES' : 'NO') . "<br>";
echo "Livewire path: " . $livewire_path . "<br>";

if (file_exists($livewire_path)) {
    echo "File size: " . filesize($livewire_path) . " bytes<br>";
}
?>