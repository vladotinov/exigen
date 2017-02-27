<?php 
Head('Регистрация') ?>
<body>
<div class="wrapper">
<div class="header"></div>
<div class="content">
<?php Menu();
MessageShow() ?>
<div class="Page">
<form method="POST" action="/account/register">
<br/><input type="text" name="login" placeholder="Логин"/>
<br/><input type="email" name="email" placeholder="E-Mail" />
<br/><input type="password" name="password" placeholder="Пароль" required>
<br/><input type="text" name="name" placeholder="Имя" required>
<br/><select size="1" name="breed"><option value="0">Не скажу</option><option value="1">Белая</option><option value="2">Черный нигер</option><option value="3">Лысик</option><option value="4">А х его знает</option></select>
<br/><input type="file" name="avatar"/>
<br/><input type="text" name="captcha" placeholder="Каптча"/>
<img src="/resource/captcha.php" alt="Капча" />
<br><br><input type="submit" name="enter" value="Регистрация"> <input type="reset" value="Очистить">
</form>
</div>
</div>

<?php Footer() ?>
</div>
</body>
</html>