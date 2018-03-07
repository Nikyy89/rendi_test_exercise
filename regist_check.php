<?php

function reg_check()
{
    if($_POST['nick_name'] == '' || $_POST['email_address'] == '' || $_POST['password'] == '')
    {
        return "All fields are required!";
    }
    elseif(preg_match('^[a-zA-Z\-\_Ã¡Ã©Ã­Ã³Ã¶Å‘Ã¼Å±Ã�Ã‰Ã�Ã“Ã–Å�ÃœÅ°]+$', $_POST['nick_anme']))
    {
        return "In nick only Hungarian alphabet small and capitals, numbers, and _ and - are allowed!";
    }
    elseif($_POST['email_address'] == (preg_match("^[_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2-6}$",$_POST['email_address'])))
    {
        return "Wrong e-mail address!";
    }
    elseif(pg_num_rows(pg_query("SELECT nick_name FROM users WHERE nick_name='".$_POST['nick_name']."' ")) > 0)
    {
        return "You have already registered with this nick name!";
    }
    elseif($_POST['password'] != $_POST['password_again'])
    {
        return "The two passwords do not match!";
    }
    else
    {
        return "OK";
    }
}
?>
