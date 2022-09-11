<?
	
	session_start();
	ob_start();
	include("sql/db_connection.php");	#MySQL Connection
	


?>

<!doctype html>
<html lang="tr">
<head>
<title>İnjectshell Ücretsiz Hizmet Platformu - Ücretsiz Müzik Botu</title>
<meta name="keywords" content="shell script şifrele,script şifreleme,bash script şifreleme,sh script sifreleme,online script şifreleme,bash compiler,bash encrypter" />

<?	include("pages/head.php"); ?>
</head>
<body>

<?

	// Oturum Kontrolü
	
		if($_SESSION['login']!= "OK"){
			
					echo "
		<script>    
          sweetAlert({
                title:'Hata!',
                text: 'Bu sayfayı görebilmek için giriş yapmış olmanız gerekmektedir.',
                type:'warning',
				confirmButtonText: 'OK'
				
          },function(isConfirm){
            window.location.href = 'anasayfa';
			
          });</script>";
		  return;
		}

?>





<?
		
		
$rightstoml = '
		
		# Rights declaration file
# For more information about syntax and structure see here:
# https://github.com/Splamy/TS3AudioBot/wiki/Rights

"+" = [
	# Basic stuff
	"cmd.help",
	"cmd.pm",
	"cmd.subscribe",
	"cmd.unsubscribe",
	"cmd.kickme",
	
	# Getting song info
	"cmd.link",
	"cmd.song",
	"cmd.repeat",
	"cmd.random",

	# Conditionals and basic scripting
	"cmd.if",
	"cmd.print",
	"cmd.rng",
	"cmd.eval",
	"cmd.take",
	"cmd.xecute",
	"cmd.getmy.*",
	"cmd.json.*",
	"cmd.bot.use",
	"cmd.rights.can",
]

# Admin rule
[[rule]]
	# Set your admin Group Ids here
	groupid = [ '.htmlspecialchars($_POST["group"]).' ]
	# And/Or your admin Client Uids here
	useruid = [ "'.$_POST["uniq"].'" ]

	"+" = "*"

# Playing rights
[[rule]]
	# Set Group Ids you want to allow here
	groupid = [ '.htmlspecialchars($_POST["group"]).' ]
	# And/Or Client Uids here
	useruid = [ "'.htmlspecialchars($_POST["uniq"]).'" ]
	# Or remove groupid and useruid to allow for everyone

	"+" = [
		# Play controls
		"cmd.play",
		"cmd.pause",
		"cmd.stop",
		"cmd.seek",
		"cmd.volume",

		# Playlist management
		"cmd.list.*",
		"cmd.add",
		"cmd.clear",
		"cmd.previous",
		"cmd.next",
		"cmd.random.*",
		"cmd.repeat.*",

		# History features
		"cmd.history.add",
		"cmd.history.from",
		"cmd.history.id",
		"cmd.history.last",
		"cmd.history.play",
		"cmd.history.till",
		"cmd.history.title",
	]

	# Remove this if you want to allow users to save playlist locally
	"-" = [ "cmd.list.save" ]
		
		
		';
		
$botdefaulttoml = '

#This field will be automatically set when you call "!bot setup".
#The bot will use the specified group to set/update the required permissions and add himself into it.
#You can set this field manually if you already have a preexisting group the bot should add himself to.
bot_group_id = 0
#Tries to fetch a cover image when playing.
generate_status_avatar = true
#The language the bot should use to respond to users. (Make sure you have added the required language packs)
language = "en"
#Defines how the bot tries to match your !commands. Possible types:
# - exact : Only when the command matches exactly.
# - substring : The shortest command starting with the given prefix.
# - ic3 : "interleaved continuous character chain" A fuzzy algorithm similar to hamming distance but preferring characters at the start.
command_matcher = "ic3"

[connect]
#The address, ip or nickname (and port; default: 9987) of the TeamSpeak3 server
address = "'.htmlspecialchars($_POST['connect_ipport']).'"
#Default channel when connecting. Use a channel path or "/<id>".
#Examples: "Home/Lobby", "/5", "Home/Afk \/ Not Here".
channel = ""
#The client badges. You can set a comma seperated string with max three GUID"s. Here is a list: http://yat.qa/ressourcen/abzeichen-badges/
badges = ""
#Client nickname when connecting.
name = "'.htmlspecialchars($_POST['botname']).'"

#The server password. Leave empty for none.
[connect.server_password]
pw = ""
hashed = false
autohash = false

#The default channel password. Leave empty for none.
[connect.channel_password]
pw = ""

#Overrides the displayed version for the ts3 client. Leave empty for default.
[connect.client_version]

[connect.identity]
#The client identity security level which should be calculated before connecting
#or -1 to generate on demand when connecting.
level = -1
#||| DO NOT MAKE THIS KEY PUBLIC ||| The client identity. You can import a teamspeak3 identity here too.
#key = "MCkDAgbAAgEgAiBlGXnAFm1qzd7ufIaX8aKy6pnOxCFB9OeDNt1XGhVUUQ=="
#The client identity offset determining the security level.
#offset = 1715

[audio]
#The maximum volume a normal user can request. Only user with the "ts3ab.admin.volume" permission can request higher volumes.
max_user_volume = 100.0
#Specifies the bitrate (in kbps) for sending audio.
#Values between 8 and 98 are supported, more or less can work but without guarantees.
#Reference values: 16 - poor (~3KiB/s), 24 - okay (~4KiB/s), 32 - good (~5KiB/s), 48 - very good (~7KiB/s), 64 - not noticeably better than 48, stop wasting your bandwith, go back (~9KiB/s)
bitrate = 128
#How the bot should play music. Options are:
# - whisper : Whispers to the channel where the request came from. Other users can join with "!subscribe".
# - voice : Sends via normal voice to the current channel. "!subscribe" will not work in this mode.
# - !... : A custom command. Use "!xecute (!a) (!b)" for example to execute multiple commands.
send_mode = "voice"

#When a new song starts the volume will be trimmed to between min and max.
#When the current volume already is between min and max nothing will happen.
#To completely or partially disable this feature, set min to 0 and/or max to 100.
[audio.volume]
default = 100.0

[playlists]
#Path to the folder where playlist files will be saved.
path = "Playlists"

[history]
#Enable or disable history features completely to save resources.
enabled = true
#Whether or not deleted history ids should be filled up with new songs.
fill_deleted_ids = true

[events]

';
		
		
		
		

?>




<?



		set_include_path(get_include_path() . PATH_SEPARATOR . 'api/phpseclib');
		include('Net/SSH2.php');
		
		$server = new Net_SSH2('35.231.8.225');
		if (!$server->login('root', 'antalya.com')) {
			exit("~Audio Sunucusuna Baglanilamadi");
		}
		
		$u_email = $_SESSION['email'];
		$u_password = $_SESSION['password'];
		
		$veri = $sql->prepare("SELECT * FROM users Where email=? AND password=?");
		$veri->execute(array($u_email,$u_password));
		$user_info = $veri->fetch(PDO::FETCH_ASSOC);
		
		$user_id = $user_info['id'];
		
		
		
		$botvarmi = $sql->prepare("SELECT * FROM audiobot WHERE whoisthebot=?");
		$botvarmi->execute(array($user_id));
		$varmibot = $botvarmi->rowCount();
		$botbilgi = $botvarmi->fetch(PDO::FETCH_ASSOC);
		
		
		
		
		if(isset($_POST['bot_olustur'])){
		
		
			if($varmibot > 0){
				
		echo "
		<script>    
          sweetAlert({
                title:'Hata!',
                text: 'Zaten aktif bir botunuz var.',
                type:'warning',
				confirmButtonText: 'OK'
				
          },function(isConfirm){
            window.location.href = 'audiobot-olustur';
			
          });</script>";
		  return;
				
			}
			
			$rand = rand(1,50000);
			mkdir("../audiobot.injectshell.com/botx$rand",0777);
			touch("../audiobot.injectshell.com/botx$rand/rights.toml");
			touch("../audiobot.injectshell.com/botx$rand/bot_default.toml");
			
			$bot_right_toml = fopen("../audiobot.injectshell.com/botx$rand/rights.toml","a");
			$bot_default_toml = fopen("../audiobot.injectshell.com/botx$rand/bot_default.toml","a");
			
			fwrite($bot_right_toml,$rightstoml);
			fwrite($bot_default_toml,$botdefaulttoml);
			
			fwrite($bot_right_toml,"\r\n");
			fwrite($bot_default_toml,"\r\n");
			
			fclose($bot_right_toml);
			fclose($bot_default_toml);
			
			
			$bot_add = $sql->prepare("INSERT INTO audiobot SET botfolder = ?, whoisthebot = ?");
			$add_bot = $bot_add->execute(array("botx$rand",$user_id));

			$server->exec("./botkur $rand");
			
		echo "	<script>    
          sweetAlert({
                title:'Tebrikler!',
                text: 'Tebrikler botunuz kuruldu. Sunucunuza otomatik olarak giriş yapacaktır.',
                type:'success',
				confirmButtonText: 'OK'
				
          },function(isConfirm){
            window.location.href = 'audiobot-olustur';
			
          });</script>";
				
			
			
			
			
			
			
			
		}
		


?>



<!-- Navbar !-->
<? include("pages/navbar.php"); ?>
<!-- Navbar !-->



<div class="container"><!-- Container !-->
	<div class="row mb-3"><!-- Row !-->

		
<div class="col-md-9 offset-md-0">

		<!-- Slider !-->
		<? include("pages/slider.php"); ?>
		<!-- Slider !-->
			
<?

	$botklasor = $botbilgi['botfolder']; 

	if(isset($_POST['botstart'])){
		
		$server->exec("cd $botklasor && screen -AmdS $botklasor mono TS3AudioBot.exe");
		$server->exit;
			echo "	<script>    
          sweetAlert({
                title:'Tebrikler!',
                text: 'Tebrikler. Botunuz başlatıldı.',
                type:'success',
				confirmButtonText: 'OK'
				
          },function(isConfirm){
            window.location.href = 'audiobot-olustur';
			
          });</script>";
		
	}
	
	if(isset($_POST['botstop'])){
		
		$server->exec("screen -S $botklasor -X quit");

			echo "	<script>    
          sweetAlert({
                title:'Tebrikler!',
                text: 'Tebrikler. Botunuz durduruldu.',
                type:'success',
				confirmButtonText: 'OK'
				
          },function(isConfirm){
            window.location.href = 'audiobot-olustur';
			
          });</script>";
		
	}
	
	
	
?>			
			<?if($varmibot>0){?>
			<div class="card mb-3" align="center">
			
			<form  name="botprocess" method="post" action="audiobot-olustur">
			
							<input class="btn btn-success btn-sm " name="botstart" type="submit" value="Botu Başlat">
							<input class="btn btn-warning btn-sm " name="botstop" type="submit" value="Botu Durdur">
							
			</form>
			
			</div>
							
			<div class="card mb-3">
				<h5 class="card-header">Bot Dosyalarınız</h5>
				<div class="card-body">
				<code>Bot Config Dosyası [~ "<? echo $botbilgi['botfolder']."/"."bot_default.toml"; ?>" ~] </code>
<? 

	
	
	if($_POST['botdefaultupdates']){
		
		
		$open = fopen("../audiobot.injectshell.com/$botklasor/bot_default.toml","w+");
		$text = $_POST['update'];
		fwrite($open,$text);
		fclose($open);
		
		$server->exec("screen -S $botklasor -X quit && sleep 1 && cd $botklasor/Bots && rm -rf bot_default.toml && wget http://audiobot.injectshell.com/$botklasor/bot_default.toml && cd .. && screen -AmdS $botklasor mono TS3AudioBot.exe");
								$server->exit;
		echo "	<script>    
          sweetAlert({
                title:'Tebrikler!',
                text: 'Tebrikler bot ayarlarınız başarılı bir şekilde güncellendi. Otomatik olarak yeniden sunucunuza bağlanacaktır.',
                type:'success',
				confirmButtonText: 'OK'
				
          },function(isConfirm){
            window.location.href = 'audiobot-olustur';
			
          });</script>";
		  

		  
	}else{
		
		$file = file("../audiobot.injectshell.com/$botklasor/bot_default.toml");
echo "<form action=\"".$PHP_SELF."\" method=\"post\">"; 
echo "<textarea style='width:100%; height:700px;' Name=\"update\" cols=\"50\" rows=\"10\">";
		foreach($file as $text) {
		echo $text;
		}  		
		echo "</textarea><br>"; 
		echo "<input class='btn btn-info' name='botdefaultupdates' type='submit' value='Kaydet'>\n</form>"; 
	 
	}
?>
	<br>
				<code>Bot Config Dosyası [~ "<? echo $botbilgi['botfolder']."/"."rights.toml"; ?>" ~] </code>	
<? 


	
	
	if($_POST['rightstomlupdates']){
		
		
		$open = fopen("../audiobot.injectshell.com/$botklasor/rights.toml","w+");
		$text = $_POST['update'];
		fwrite($open,$text);
		fclose($open);
		$server->exec("screen -S $botklasor -X quit && sleep 1 && cd $botklasor/Bots && rm -rf rights.toml && wget http://audiobot.injectshell.com/$botklasor/rights.toml && cd .. && screen -AmdS $botklasor mono TS3AudioBot.exe");
		$server->exit;
		
		echo "	<script>    
          sweetAlert({
                title:'Tebrikler!',
                text: 'Tebrikler bot ayarlarınız başarılı bir şekilde güncellendi. Otomatik olarak yeniden sunucunuza bağlanacaktır.',
                type:'success',
				confirmButtonText: 'OK'
				
          },function(isConfirm){
            window.location.href = 'audiobot-olustur';
			
          });</script>";
		  

		  
	}else{
		
		$file = file("../audiobot.injectshell.com/$botklasor/rights.toml");
echo "<form action=\"".$PHP_SELF."\" method=\"post\">"; 
echo "<textarea style='width:100%; height:700px;' Name=\"update\" cols=\"50\" rows=\"10\">";
		foreach($file as $text) {
		echo $text; 
		}  
		echo "</textarea><br>"; 
		echo "<input class='btn btn-info' name='rightstomlupdates' type='submit' value='Kaydet'>\n</form>"; 
		
	}
?>

				
				
				
				
				
				
			</div>
			</div>
			<?}else{?>
				
										
							
							                   <div class="card">
											           	<form  name="createbot" method="post" action="audiobot-olustur">
                                    <div class="card-header">
                                        <strong>Free Teamspeak3</strong> Audiobot
                                    </div>
                                    <div class="card-body card-block">
                             
								<div class="form-group">
                                                <label for="exampleInputName2" class="pr-1  form-control-label">~</label>
                                                <input type="text" id="exampleInputName2" name="botname" placeholder="Botun Adını Giriniz" required="" class="form-control" >
									</div>
									
									<div class="form-group">
                                                <label for="exampleInputName2" class="pr-1  form-control-label">~</label>
                                                <input type="text" id="exampleInputName2" name="connect_ipport" placeholder="Teamspeak3 IP:Port ~ Örnek: 127.0.0.1:9987" required="" class="form-control" >
									</div>
	
	
									<div class="form-group">
                                                <label for="exampleInputName2" class="pr-1  form-control-label">~</label>
                                                <input type="text" id="exampleInputName2" name="uniq" placeholder="Unique ID ( Botun Atanacağı Kimlik(Kişi) )" required="" class="form-control">
									</div>
									

									<div class="form-group">
                                                <label for="exampleInputName2" class="pr-1  form-control-label">~</label>
                                                <input type="text" id="exampleInputName2" name="group" placeholder="Group ID  ( Botun Atanacağı Yetki )" required="" class="form-control">
									</div>
				
									
                                    </div>
									
                                    <div class="card-footer">
                                        <button type="submit" name="bot_olustur" class="btn btn-primary btn-sm">
                                            <i class="fa fa-dot-circle-o"></i> Bot Oluştur
                                        </button>
                                    </div>
										</form>
                                </div>
							
							

				
			<?}?>
	
	
	
			
			
			
			
			
			
		</div>
		
		
		<!-- Col Right !-->
		<?include("pages/col-right.php");?>
		<!-- Col Right !-->
		
		
	</div><!-- Row !-->
</div><!-- Container !-->

		
<!-- Footer -->
<? include("pages/footer.php"); ?>
<!-- Footer -->


    <!-- Javascript Bootstrap <4.0> !-->
<?include("pages/javascript.php");?>
	<!-- !-->
  </body>
</html>
