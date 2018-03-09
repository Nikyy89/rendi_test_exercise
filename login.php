<?php
include "config.php";
include 'blocking.php';

$sql="SELECT * FROM users WHERE nick_name=$1 AND password=$2 ";
$stmt=pg_prepare('user',$sql);
//nincs belépve
if($_SESSION['belep'] !== true)
{
    if(isset($_POST['login']))
    {
        $nick_name = addslashes($_POST['name']);
        $password = md5($_POST['belep_password']);
        
        $result=pg_execute('user',array($nick_name,$password));
        
        if (!$result) echo pg_last_error();
        elseif(pg_num_rows($result) !== 0)
        {
            $_SESSION['nick_name'] = addslashes($_POST['name']);
            $_SESSION['belep'] = true;
            
            header("Location: ".$_SERVER['PHP_SELF']);
        }
        else
        {
            echo "Wrong nick name/password!";
        }
        /*
         set_time_limit(3600);
         if($_POST['login'] == 5)
         {
         $blockAddresses = array(
         '127.0.0.1'
         );
         
         if(blockUsers($blockAddresses))
         {
         echo "You tried 5 times, try it later!";
         die;
         }
         }
         */
    }
}
else
{//be van lépve
    include 'vedett.php';
}

if($_SESSION['belep'] !== true)
{
    ?>
<form method="post" action="">
Nick name: <input type="text" name="name" id="name">
Password: <input type="password" name="belep_password" id="belep_password">
<input type="submit" name="login" value="Belépés"> <br />
<a href="registration.php">Regisztráció</a>
</form>
<?php
}
?>