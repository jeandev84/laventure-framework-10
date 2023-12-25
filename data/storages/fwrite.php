<?php

$filename = 'test.txt';
$somecontent = "Ajout de chaîne dans le fichier\n";

// Assurons nous que le fichier est accessible en écriture
if (is_writable($filename)) {

    // Dans notre exemple, nous ouvrons le fichier $filename en mode d'ajout
    // Le pointeur de fichier est placé à la fin du fichier
    // c'est là que $somecontent sera placé
    if (!$fp = fopen($filename, 'a')) {
        echo "Impossible d'ouvrir le fichier ($filename)";
        exit;
    }

    // Ecrivons quelque chose dans notre fichier.
    if (fwrite($fp, $somecontent) === FALSE) {
        echo "Impossible d'écrire dans le fichier ($filename)";
        exit;
    }

    echo "L'écriture de ($somecontent) dans le fichier ($filename) a réussi";

    fclose($fp);

} else {
    echo "Le fichier $filename n'est pas accessible en écriture.";
}