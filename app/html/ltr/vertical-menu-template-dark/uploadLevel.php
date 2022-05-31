<?php
    require './index_php.php';
    $file = $_FILES['csv_file']['tmp_name'];
    $ext = explode(".", $_FILES['csv_file']['name']);
    $handle = fopen($file, "r");
    $i = 0;
    if ($ext[1] == "csv") {
        while (($cont = fgetcsv($handle, 1000, ";")) !== false) {
            if ($i == 0) {
                $i++;
                continue;
            }
            $result = $user->add_level($cont[1], $matricule_etablissement, $date_academique);
            $i++;
            # code...
        }
        echo 1;
        # code...
    } else {
        echo 0;
        # code...
    }
    # code...


?>