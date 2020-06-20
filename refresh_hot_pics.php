<?php
require_once "config.php";
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $sql = "SELECT * from travelimage order by rand() limit 0,6";
    $stm = $pdo->prepare($sql);
    if ($stm->execute()) {
        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
            echo
                '<article>
                <header class="pic-title">
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                    width="50" height="50"
                    viewBox="0 0 172 172"
                    style=" fill:#000000;"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><path d="M0,172v-172h172v172z" fill="none"></path><g fill="#f35200"><path d="M86,114.853l-30.99583,18.71217l8.22733,-35.26l-27.39817,-23.736l36.04117,-3.06017l14.1255,-33.33217l14.1255,33.33217l36.04117,3.06017l-27.39817,23.736l8.22733,35.26z" opacity="0.3"></path><path d="M165.21317,64.51433l-56.9535,-4.83033l-22.25967,-52.51733l-22.25967,52.51733l-56.9535,4.83033l43.25083,37.46733l-12.99317,55.685l48.9555,-29.54817l48.9555,29.54817l-12.99317,-55.685zM86,111.37717l-27.27633,16.46183l7.23833,-31.03167l-24.10867,-20.88367l31.7125,-2.6875l12.43417,-29.34033l12.43417,29.34033l31.7125,2.6875l-24.10867,20.89083l7.23833,31.03167z"></path></g></g></svg>
                <p>' . $row['Title'] . '</p>
                </header>
                <a href="detail.php?imageid='.$row['ImageID'].'">
                    <img class="hot-pic" src="img/travel-images/normal/medium/' . $row['PATH'] . '" alt="img1">
                    <div class="pic-intro">
                        <p>' . $row['Description'] . '</p>
                        </div>
                </a>
            </article>';
        }
    }
