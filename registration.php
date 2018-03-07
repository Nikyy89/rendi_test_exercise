<?php
include 'config.php';
include 'regist_check.php';

$sql="INSERT INTO users (nick_name, password, email_address) VALUES ($1,$2,$3)";
$stmt=pg_prepare('insert_new_user',$sql);


if(isset($_POST['regisztracio']))
{
    if(reg_check($_POST) == "OK")
    {
        $result=pg_execute('insert_new_user',array($_POST['nick_name'],md5($_POST['password']),$_POST['email_address']));
        if (!$result) echo pg_last_error();
        else
        {
            echo "The registration is successful!";
        }
    }
    else echo reg_check($_POST);
}
?>

<form method="post" action="">
	 Nick name: <input type="text" name="nick_name" id="nick_name"> <br />
	 Email address: <input type="text" name="email_address" id="email_address"> <br />
	 Password: <input type="password" name="password" id="password"> <br/>
	 Password again: <input type="password" name="password_again" id="password_again"> <br />
	 <input type="submit" name="regisztracio" value="Regisztrálok"> <br />
	 <a href="index.php">Vissza</a>
</form>