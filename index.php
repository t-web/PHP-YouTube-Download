<?php
 /******************************************************\
 	@AUTHOR			PMESCO CREATIONS
 	@ABOUT			YOUTUBE DOWNLOADER
 	@VERSION		1.0
 	@WEBSITE		WWW.WAPMON.COM
	@CONTACT		SUPPORT@WAPMON.COM
 \******************************************************/

if(!empty($_GET['id'])){
	
$data = getpage('https://www.youtube.com/watch?v='.$_GET['id'].'');

preg_match('/ytplayer.config = {(.*?)};/',$data,$match);

$o = json_decode('{'.$match[1].'}') ;
$player = explode('s.ytimg.com/yts/jsbin/html5player-',$o->assets->js);
$player = explode('/html5player.js',$player[1]);
$player = $player[0];
$json = ''.$player.'.json';
if (!file_exists($json)) {
$algos = file_get_contents('http://developers.wapmon.com/api/youtube/algo?player_id='.$player.'');
$fp = fopen($json, "a");
if(flock($fp, LOCK_EX)){
fwrite($fp, $algos);
flock($fp, LOCK_UN);}
fclose($fp);
}

    $stream_map = $o->args->url_encoded_fmt_stream_map;
	echo '<img src="https://i.ytimg.com/vi/'.$_GET['id'].'/default.jpg"/><br/>';
    generate_directlink($stream_map,$player);
	
}

function decipher($sig,$player)
{
	$algo = file(''.$player.'.json');
	$algo = explode('O',$algo[0]);
	foreach($algo as $arrange)
	{
		$signature = str_split($sig);
		$decrypt .= $signature[$arrange];
		}
		return $decrypt;
		}

function generate_directlink($stream_map,$player)
{
	$links = explode(',',$stream_map);
	foreach($links as $link)
    {
        parse_str($link,$r);
        $dllink = explode('.googlevideo.com/',$r['url']);
        $dllink = 'http://redirector.googlevideo.com/'.$dllink[1].'&title=TITLE_HERE'; // Change TITLE_HERE of your desired title.
        echo '<a href="'.$dllink."&signature=".decipher($r['s'],$player).'">Download video-'.$r['itag'].'</a><br />';
    }
}

function getpage($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}

if(empty($_GET['id'])){
	echo '<form action=""><input type="text" name="id" placeholder="YOUTUBE ID" value=""><input type="submit" value="Search"></form>';
}

?>
