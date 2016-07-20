<?php
error_reporting(0);
set_time_limit(0);
ob_start();

$ext = array(
  '.com' => array('whois.crsnic.net','No match for'),
  '.net' => array('whois.crsnic.net','No match for'), 
  '.biz' => array('whois.biz','Not found'),
  '.mobi' => array('whois.dotmobiregistry.net', 'NOT FOUND'),
  '.tv' => array('whois.nic.tv', 'No match for'),
  '.in' => array('whois.inregistry.net', 'NOT FOUND'),
  '.info' => array('whois.afilias.net','NOT FOUND'), 
  '.co.uk' => array('whois.nic.uk','No match'), 
  '.co.ug' => array('wawa.eahd.or.ug','No entries found'), 
  '.or.ug' => array('wawa.eahd.or.ug','No entries found'),
  '.nl' => array('whois.domain-registry.nl','not a registered domain'),
  '.ro' => array('whois.rotld.ro','No entries found for the selected'),
  '.com.au' => array('whois.ausregistry.net.au','No data Found'),
  '.ca' => array('whois.cira.ca', 'AVAIL'),
  '.org.uk' => array('whois.nic.uk','No match'),
  '.name' => array('whois.nic.name','No match'),
  '.us' => array('whois.nic.us','Not Found'),
  '.ac.ug' => array('wawa.eahd.or.ug','No entries found'),
  '.ne.ug' => array('wawa.eahd.or.ug','No entries found'),
  '.sc.ug' => array('wawa.eahd.or.ug','No entries found'),
  '.ws' => array('whois.website.ws','No Match'),
  '.be' => array('whois.ripe.net','No entries'),
  '.com.cn' => array('whois.cnnic.cn','no matching record'),
  '.net.cn' => array('whois.cnnic.cn','no matching record'),
  '.org.cn' => array('whois.cnnic.cn','no matching record'),
  '.no' => array('whois.norid.no','no matches'),
  '.se' => array('whois.nic-se.se','No data found'),
  '.nu' => array('whois.nic.nu','NO MATCH for'),
  '.com.tw' => array('whois.twnic.net','No such Domain Name'),
  '.net.tw' => array('whois.twnic.net','No such Domain Name'),
  '.org.tw' => array('whois.twnic.net','No such Domain Name'),
  '.cc' => array('whois.nic.cc','No match'),
  '.nl' => array('whois.domain-registry.nl','is free'),
  '.pl' => array('whois.dns.pl','No information about'),
  '.pt' => array('whois.dns.pt','No match'),
  '.org'=> array('whois.publicinterestregistry.net','NOT FOUND'),
  '.edu'=> array('whois.internic.net','No match'),
  '.gr'=> array('whois.ripe.net','No entries found')
);

$website=$_REQUEST['website'];


if(strlen($website) > 0)
{

    unset($buffer);
    preg_match('@^(http://www\.|http://|www\.)?([^/]+)@i', $website, $matches);
    $domain = $matches[2];

    $tld = explode('.', $domain, 2);
    $extension = strtolower(trim($tld[1]));

    if(strlen($domain) > 0 && 
      array_key_exists('.' . $extension, $ext))
    {
      $server = $ext['.' .$extension][0];

      $sock = fsockopen($server, 43) or 
        die('Error Connecting To Server:' . $server);
      fputs($sock, "$domain\r\n");

     while( !feof($sock) )
     {
       $buffer .= fgets($sock,128);
     }

     fclose($sock);
    

     if(eregi($ext['.' . $extension][1], $buffer)) { 
       echo "available"; 
     }
     else 
     { 
       echo "taken";
     }
    }
    else
    {
      if(strlen($domain) > 0) { echo "invalid"; }
    }

    ob_flush();
    flush();
    
  
}


?>

