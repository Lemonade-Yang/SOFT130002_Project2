<?php
function echo_already_login(){
    return
        '<li class="dropdown"><a href="#" id="profile"><img src="img/profile2.png" alt="profile">'.$_SESSION['UserName']. '</a>
                <ul class="dropdown-content">
                    <li><a href="upload.php"><img src="img/upload.png" alt="upload">上传</a></li>
                    <li><a href="myphoto.php"><img src="img/myphoto.png" alt="myphoto">我的照片</a></li>
                    <li><a href="myfav.php"><img src="img/myfav.png" alt="myfav">我的收藏</a></li>
                    <li><a href="logout.php"><img src="img/login.png" alt="logout">登出</a></li>
                </ul>
            </li>';
}
function echo_not_login(){
    return
        '<li><a href="login.php" id="profile"><img src="img/profile.png" alt="login">登录</a></li>';
}