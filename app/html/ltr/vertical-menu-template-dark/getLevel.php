<?php
    require './index_php.php';
    $output = '<ul class="users-list-wrapper media-list" >';
    $query = mysqli_query($database, "SELECT * FROM niveau WHERE matricule_etablissement = '$matricule_etablissement' and date_academique = '$date_academique' ");
    while ($result = mysqli_fetch_assoc($query)) { 
        $output .= '
        <li class="media mail-read">
            <div class="user-action">
                <div class="checkbox-con mr-25">
                    <div class="checkbox checkbox-shadow checkbox-sm">
                        <input type="checkbox" name="checkboxsmall' . $result['id'].'" id="checkboxsmall'. $result['id'].'">
                        <label for="checkboxsmall'. $result['id'].'"></label>
                    </div>
                </div>
                <button type="submit" name="delete_level" value="'. $result['id'].'" class="btn btn-icon action-icon">
                    <span class="fonticon-wrap">
                        <i class="livicon-evo" data-options="name: trash.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                        </i>
                    </span>
                </button>
                <span class="favorite warning">
                    <i class="bx bxs-star"></i>
                </span>
            </div>
            <div class="pr-50">
                <div class="avatar">
                    <img src="logo_data/'. $logo.'" alt="avtar img holder">
                </div>
            </div>
            <div class="media-body">
                <div class="user-details">
                    <div class="mail-items">
                        <span class="list-group-item-text text-truncate">'. $result['nom_niveau'] .'</span>
                    </div>
                    <div class="mail-meta-item">
                        <span class="float-right">
                            <span class="mail-date">'. $date_academique.'</span>
                        </span>
                    </div>
                </div>
                <div class="mail-message">
                    <p class="list-group-item-text truncate mb-0">'. $nom_etablissement .'  '. $date_academique.'
                    </p>
                    <div class="mail-meta-item">
                        <span class="float-right">
                            <span class="bullet bullet-success bullet-sm"></span>
                        </span>
                    </div>
                </div>
            </div>
        </li>';
        # code...
    }
    $output .= '</ul>';
    echo $output;
?>
