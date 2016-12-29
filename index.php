<html>
    <head>
        <title>Reverse Ip Lookup</title>
    </head>
    
<body>
<h2 style="text-align: center; color: #42b9f4;">Reverse Ip Lookup coded by 504w</h2>
    <form action="" method="POST" style="text-align: center;">
        <input type="text" name="host" placeholder=" Put Domain Here" style="width: 20%; height: 25px;" />
        <input type="submit" name="sub" style="width: 70px; height: 25px; border:none; background-color: red; color:#ffffff;" />
    </form>

<div style="float: left; width: 20%; margin-top:100px;">
<?php
set_time_limit(0); // set kardane zamane ejra be 0 sanie
$php = file_get_contents("https://sourceforge.net/p/simplehtmldom/code/HEAD/tree/trunk/simple_html_dom.php?format=raw"); //daryafte classe htmldom
$file = fopen("html2.php","w");//zakhire an dar file html2.php
fwrite($file , $php);
fclose($file);
include("html2.php"); 
@$host = $_POST['host']; // alamate @ baraye jologiri az namayesh khata baraye in line
@$ip = gethostbyname($host);//Url to ip
$n = -1;
$i = 0;
function reverseiplookup($ip , $n , $i){
                $n=$n+1;
                $bing = "http://www.bing.com/search?q=ip%3a".$ip."&first=".$n."1&FORM=PERE";
                $html  = file_get_html($bing);//daryafte source link $bing
                foreach($html ->find("cite") as $site){ // visit: http://simplehtmldom.sourceforge.net/
                        $i = $i+1;
                        $website = explode("/" , $site);// explode baraye jodasazi yek string va rikhtane khoruji dar ye array => $site
                        $a = str_replace("<" , "" , $website[0]);//str_replace baraye replace kardane megdari ba megdare digar dar string
                        $a = str_replace("cite>" , "" , $a);
                        echo '<a href=http://'.$a.' target="_blank" >'.$a.'</a><br />';
                }
                $GLOBALS['n'] = $n;//globals baraye tarife motaghayer jahayi ke be shekle mamuli be surate local hast mesle dakhele function ha
                $GLOBALS['html'] = $html;
                $GLOBALS['i'] = $i;
}
while(true){
    reverseiplookup($ip , $n , $i);
    if(strpos($html , "Next page")===false){ //dar inja az strpos be onvane preg_match estefade kardam
          break;
    }
}

?>

</div> <br />
<div style="margin-left: 44%; "><?php echo $i."<b>    Domains Found</b>" ?></div>
</body>
</html>
