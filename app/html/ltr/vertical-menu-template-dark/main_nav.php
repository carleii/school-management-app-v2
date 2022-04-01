<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="../../../html/ltr/vertical-menu-template-dark/index.php">
                    <div class="brand-logo"><img class="logo" src="../../../app-assets/images/logo/logo.png" /></div>
                    <h6 class="brand-text mb-0"><?php echo $nom_etablissement; ?></h6> <br>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary" data-ticon="bx-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
            <li class=" navigation-header"><a href="../../../html/ltr/vertical-menu-template-dark/index.php"><i class="menu-livicon" data-icon="desktop"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span><span class="badge badge-light-danger badge-pill badge-round float-right mr-2">5</span></a>
                <ul class="menu-content">
                    <li class="active"><a href="#"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="GESTION SCOLAIRE">DOCUMENTATION</span></a>
                        <ul class="menu-content">
                            <?php
                            if ($role == "admin") {
                            ?>
                                <li><a href="documentation/administrateur.pdf" target="_parent">DOCUMENTATION ADMIN</a></li>
                                <li><a href="documentation/headmaster.pdf" target="_parent">DOCUMENTATION HEADMASTER</a></li>
                                <li><a href="documentation/teacher.pdf" target="_parent">DOCUMENTATION TEACHER</a></li>
                                <li><a href="documentation/comptable.pdf" target="_parent">DOCUMENTATION ACCOUNTANT</a>
                                </li>




                            <?php
                                # code...
                            } elseif ($role == "headmaster") {
                            ?>
                                <li><a href="documentation/headmaster.pdf" target="_parent">DOCUMENTATION</a></li>

                            <?php

                                # code...
                            } elseif ($role == "teacher") {
                            ?>
                                <li><a href="documentation/teacher.pdf" target="_parent">DOCUMENTATION</a></li>

                            <?php

                                # code...
                            } elseif ($role == "comptable") {
                            ?>
                                <li> <a href="documentation/comptable.pdf" target="_parent">DOCUMENTATION</a>
                                </li>

                            <?php

                                # code...
                            }
                            ?>
                        </ul>
                    </li>



                    <?php
                    if ($role == "admin") { ?>

                        <li class=""><a href="#"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="GESTION SCOLAIRE">USERS</span></a>
                            <ul class="menu-content">
                                <li><a href="page-users-list.php"><span class="menu-item" data-i18n="Liste des utilisateurs">List of users</span></a>
                                </li>
                                <li><a href="page-users-edit.php"><span class="menu-item" data-i18n="Ajouter un utilisateur">Add a new user</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class=""><a href="#"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="GESTION SCOLAIRE">SCHOOL MANAGEMENT</span></a>
                            <ul class="menu-content">
                                <li><a href="management.php"><span class="menu-item" data-i18n="NOUVELLE SESSION">NEW ACADEMIC SESSION</span></a></li>
                            </ul>
                        </li>

                    <?php
                    }
                    ?>
                    <?php
                    if ($role == 'comptable') { ?>
                        <li class=""><a href="comptable.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="COMPTABILITE">ACCOUNTANCY</span></a>
                        </li>
                    <?php
                        # code...
                    }
                    ?>
                    <!-- <li class=""><a href="dashboard-analytics.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Analytics">Analytics</span></a>
                        </li> -->
                </ul>
            </li>

            <li class=" navigation-header"><span>Academic</span>
                <?php
                if ($role != "admin") { ?>
            <li class=" nav-item"><a href="../../../html/ltr/vertical-menu-template-dark/index.php"><i class="menu-livicon" data-icon="desktop"></i><span class="menu-title" data-i18n="">Academic Admin</span><span class="badge badge-light-danger badge-pill badge-round float-right mr-2">7</span></a>
                <ul class="menu-content">
                    <li class="active"><a href="student.php"> <i class="menu-livicon" data-icon="user"></i><span class="menu-item" data-i18n="Analytics">STUDENTS</span></a>
                    </li>
                    <?php
                    if ($role == "admin" or $role == "headmaster" or $role == "secretary" or $role == "comptable") {
                    ?>
                        <li class=""><a href="classe.php"><i class="menu-livicon" data-icon="grid"></i><span class="menu-item" data-i18n="Analytics">SPECIALITY</span></a>
                        </li>

                    <?php
                        # code...
                    }

                    ?>
                    <?php
                    if ($role == "headmaster" or $role == "secretary") { ?>
                        <li><a href="level.php"><i class="menu-livicon" data-icon="briefcase"></i><span class="menu-item" data-i18n="eCommerce">LEVEL</span></a>
                        </li>
                        <li class=""><a href="matiere.php"><i class="menu-livicon" data-icon="square"></i><span class="menu-item" data-i18n="Analytics">SUBJECTS</span></a>
                        </li>
                        <li class=""><a href="teacher.php"><i class="menu-livicon" data-icon="user"></i><span class="menu-item" data-i18n="Analytics">TEACHER</span></a>
                        </li>
                        <li class=""><a href="room.php"><i class="menu-livicon" data-icon="expand"></i><span class="menu-item" data-i18n="Analytics">ROOMS</span></a>
                        </li>
                        <li class=""><a href="exam.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Analytics">EXAM NOTES</span></a>
                        </li>
                        <li class=""><a href="report.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Analytics">EXAM Average Result</span></a>
                        </li>
                        <!-- <li class=""><a href="bulletin.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Analytics">Notes Reports</span></a>
                        </li> -->
                </ul>
            </li>
    <?php
                        # code...
                    }
                }
    ?>

        </ul>
    </div>
</div>