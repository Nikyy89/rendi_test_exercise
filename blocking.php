<?php
function blockUsers($ipAddresses) 
{
    $userOctets = explode('.', $_SERVER['REMOTE_ADDR']); 
    $userOctetsCount = count($userOctets);  
    
    $block = false; 
    
    foreach($ipAddresses as $ipAddress) 
    { 
        $octets = explode('.', $ipAddress);
        if(count($octets) != $userOctetsCount) 
        {
            continue;
        }
        
        for($i = 0; $i < $userOctetsCount; $i++) 
        {
            if($userOctets[$i] == $octets[$i] || $octets[$i] == '*') 
            {
                continue;
            } else 
            {
                break;
            }
        }
        
        if($i == $userOctetsCount) 
        { 
            $block = true;
            break;
        }
    }
    
    return $block;
}
?>