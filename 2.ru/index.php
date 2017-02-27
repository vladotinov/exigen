<?php
include_once 'setting.php';
session_start();
$CONNECT = mysqli_connect(HOST, USER, PASS, DB);

if ($_SESSION['USER_LOGIN_IN'] != 1 and $_COOKIE['user']) {
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id`, `name`, `regdate`, `email`, `breed`, `avatar`, `login`,  FROM `users` WHERE `password` = '$_COOKIE[user]'"));
$_SESSION['USER_LOGIN'] = $Row['login'];
$_SESSION['USER_ID'] = $Row['id'];
$_SESSION['USER_NAME'] = $Row['name'];
$_SESSION['USER_REGDATE'] = $Row['regdate'];
$_SESSION['USER_EMAIL'] = $Row['email'];
$_SESSION['USER_BREED'] = $Row['country'];
$_SESSION['USER_AVATAR'] = $Row['avatar'];
$_SESSION['USER_LOGIN_IN'] = 1;
}


if ($_SERVER['REQUEST_URI'] == '/') {
$Page = 'index';
$Module = 'index';
} else {
$URL_Path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$URL_Parts = explode('/', trim($URL_Path, ' /'));
$Page = array_shift($URL_Parts);
$Module = array_shift($URL_Parts);


if (!empty($Module)) {
$Param = array();
for ($i = 0; $i < count($URL_Parts); $i++) {
$Param[$URL_Parts[$i]] = $URL_Parts[++$i];
}
}
}




function MessageSend($p1,$p2)
{
    if($p1 == 1) $p1 = 'Ошибка';
     else if($p1 == 2) $p1 = 'Подсказка';
      if($p1 == 3) $p1 = 'Информация';
    $_SESSION['message'] = "<div class='MessageBlock'><b>".$p1."</b>: ".$p2."</div> ";
    
    exit(header('Location:'.$_SERVER['HTTP_REFERER'])); // редирект на запрос
}

function MessageShow()
{
    if($_SESSION['message']) $Message = $_SESSION['message'];
    echo $Message;
    $_SESSION['message'] = array(); // clean
}



if ($Page == 'index') include('page/index.php');
else if ($Page == 'login') include('page/login.php');
else if ($Page == 'register') include('page/register.php');

else if ($Page == 'account') include('form/account.php');
else if ($Page == 'profile') include('page/profile.php');
// еше парочку подключить нужно
else if ($Page == 'chat') include('page/chat.php');

else if ($Page == 'search')include('module/search/search.php');
else if ($Page == 'sresult_1')include ('module/search/sresult_1.php');
else if ($Page == 'sresult_2')include ('module/search/sresult_2.php');

else if($Page == 'api') include('page/api.php');


function FormChars ($p1) {
return nl2br(htmlspecialchars(trim($p1), ENT_QUOTES), false);
}


function GenPass ($p1, $p2) {
return md5('Vados'.md5('111'.$p1.'222').md5('333'.$p2.'444'));
}


function Head($p1) {
echo '<!DOCTYPE html><html><head><meta charset="utf-8" /><title>'.$p1.'</title><meta name="keywords" content="" /><meta name="description" content="" /><link href="resource/style.css?2" rel="stylesheet"></head>';
}


function Menu () {
if($_SESSION['USER_LOGIN_IN'] != 1) '<div class="MenuHead"><a href="/"><div class="Menu">Главная</div></a><a href="/register"><div class="Menu">Регистрация</div></a><a href="/login"><div class="Menu">Вход</div></a><a href="/search"><div class="Menu">Поисковик</div></a></div>';
else { echo '<div class="MenuHead"><a href="/"><div class="Menu">Главная</div></a><a href="/register"><div class="Menu">Регистрация</div></a><a href="/profile"><div class="Menu">Профиль</div></a><a href="/chat"><div class="Menu">Чат</div></a><a href="/search"><div class="Menu">Поисковик</div></a></div>';
}}


function Footer () {
echo '<footer class="footer">Отинов Влад ПК-14-1 Exigen Services / Практика</footer>';
}
?>