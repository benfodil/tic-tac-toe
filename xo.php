<?php
include_once('db.php');
if(isset($_GET['q']) && $_GET['q'] == 1){
	$code = $_SESSION["code"];
	mysqli_query($connect,"UPDATE xo_game SET val='0' WHERE code='$code' and val='1'");
	$_SESSION["code"] = '';
	header("Refresh:0; url=index.php");
}
if(isset($_POST['creat'])){
	$code = rand(1000,9999);
	$_SESSION["code"] = $code;
	$_SESSION["p_id"] = 1;
	mysqli_query($connect,"INSERT INTO xo_game (val,pub,code,p_now) VALUES (1,1,$code,1) ");
	$_SESSION["p_char1"] = "X";
	$_SESSION["p_char2"] = "O";
	header("Refresh:0");
}elseif(isset($_POST['join'])){
	if($_POST['code'] != ''){
		$code = $_POST['code'];
		$qq = mysqli_query($connect,"SELECT code,val FROM xo_game WHERE code='$code' and val='1' and pub='1'");
		$qr = mysqli_num_rows($qq);
		if($qr != 0){
			mysqli_query($connect,"UPDATE xo_game SET pub='0' WHERE code='$code' and val='1'");
			$_SESSION["p_char1"] = "O";
			$_SESSION["p_char2"] = "X";
			$_SESSION["code"] = $code;
			$_SESSION["p_id"] = 2;
			header("Refresh:0");
		}else{
			$err = 'code0';
		}
	}else{
		$err = 'code0';
	}
}

if(isset($_SESSION["code"])){$code = $_SESSION["code"];}else{$code = '';}
$qq = mysqli_query($connect,"SELECT * FROM xo_game WHERE code='$code' and val='1'");
$qwa = mysqli_fetch_object($qq);
$qr = mysqli_num_rows($qq);
isset($qwa->p_now) ? $prop = $qwa->p_now : $prop = null;
isset($qwa->pub) ? $pub = $qwa->pub : $pub = null;

if($qr == 0){
?>
						<form action="" method="POST">
						<div class="note note-info border-success note1 my-3">
							<h5 class="my-0">HOST GAME</h5>
						</div>

						<div class="row">
							<div class="col">
								
							</div>
							<div class="col">
							<button type="submit" name="creat" class="btn btn-success btn-block">CREATE</button>
							</div>
							<div class="col">
								
							</div>
						</div>
						</form>
						<div class="note note-info border-success note1 my-3">
							<h5 class="my-0">Play With Friend</h5>
						</div>
						<form action="" method="POST">
						<div class="row">
							<div class="col-8">
								<div class="mb-3">
									<input type="text" name="code" class="form-control" placeholder="like this ( 1234 )">
								</div>
							</div>
							<div class="col-4">
								<button type="submit" name="join" class="btn btn-primary btn-block">PLAY</button>
							</div>
						</div>
						</form>
<script>
document.getElementById('title-text').innerHTML = 'Tic Tac Toe';
document.getElementById('btn-menu').innerHTML = 'Tic Tac Toe';
</script>
						<?php 
						if(isset($err) && $err == 'code0'){
							echo '
							<div class="note note-warning border-danger note1 my-3">
								<h5 class="my-0">The Invite CODE Invalid !</h5>
							</div>
							';
						}
						?>

<?php }else{ ?>
			
			<div class="row">
				<div class="col-6">
					<div class="note note-info border-success note1 mb-3">
					  <h5 class="text-center my-0">Me <span class="fw-bold en">[ <?php echo $_SESSION["p_char1"]; ?> ]</span></h5>
					  <input type="hidden" id="playerID" value="<?php echo $_SESSION["p_id"]; ?>">
					  <input type="hidden" id="prop" value="<?php echo $prop; ?>">
					  <input type="hidden" id="pub" value="0">
					  <input type="hidden" id="win" value="0">
					</div>
				</div>
				<div class="col-6">
					<div id="player2note" class="note offline-color border-danger mb-3">
						<h5 class="text-center my-0">Player <span class="fw-bold en">[ <?php echo $_SESSION["p_char2"]; ?> ]</span></h5>
					</div>
				</div>
			</div>
			
			<div id="table-gen" class="container text-center border rounded border-info border-2 mb-3">
				<div class="row">
					<div id="b0" onclick="clicki(0)" class="col-4 border-bottom border-2 py-4 w-xo border-info"><span class="fas fa-times icon-inv"></span></div>
					<div id="b1" onclick="clicki(1)" class="col-4 border-bottom border-2 py-4 w-xo border-start border-end border-info"><span class="fas fa-times icon-inv"></span></div>
					<div id="b2" onclick="clicki(2)" class="col-4 border-bottom border-2 py-4 w-xo border-info"><span class="fas fa-times icon-inv"></span></div>
				</div>
				<div class="row">
					<div id="b3" onclick="clicki(3)" class="col-4 border-bottom border-2 py-4 w-xo border-info"><span class="fas fa-times icon-inv"></span></div>
					<div id="b4" onclick="clicki(4)" class="col-4 border-bottom border-2 py-4 w-xo border-start border-end border-info"><span class="fas fa-times icon-inv"></span></div>
					<div id="b5" onclick="clicki(5)" class="col-4 border-bottom border-2 py-4 w-xo border-info"><span class="fas fa-times icon-inv"></span></div>
				</div>
				<div class="row">
					<div id="b6" onclick="clicki(6)" class="col-4 py-4 w-xo border-2 border-info"><span class="fas fa-times icon-inv"></span></div>
					<div id="b7" onclick="clicki(7)" class="col-4 py-4 w-xo border-2 border-start border-end border-info"><span class="fas fa-times icon-inv"></span></div>
					<div id="b8" onclick="clicki(8)" class="col-4 py-4 w-xo border-2 border-info"><span class="fas fa-times icon-inv"></span></div>
				</div>
			</div>
			
			<?php
			for ($x=0;$x<9;$x++){
				$b = 'b'.$x;
				echo '<input type="hidden" id="bb'.$x.'" value="'.$qwa->$b.'">';
			}
			?>
			
			<div id="notemsg" class="note note-info border-warning note1 mb-1">
				<div class="row px-2">
					<div class="col-8">
						<h5 class="my-0" id="msg">Invite CODE</h5>
					</div>
					<div class="col-4">
						<h5 class="my-0 en fw-bold text-start">#<?php echo $code;?></h5>
						<input type="hidden" id="code" value="<?php echo $code;?>">
					</div>
				</div>
			</div>
			



<?php }?>


<script>
document.getElementById('title-text').innerHTML = 'Tic Tac Toe';
document.getElementById('btn-menu').innerHTML = 'Tic Tac Toe';

var bn = '<span class="fas fa-times icon-inv"></span>';
var bx = '<span class="fas fa-times text-dark"></span>';
var bo = '<span class="far fa-circle text-dark"></span>';
var bxw = '<span class="fas fa-times text-success"></span>';
var bow = '<span class="far fa-circle text-success"></span>';
var bxl = '<span class="fas fa-times text-danger"></span>';
var bol = '<span class="far fa-circle text-danger"></span>';
// in load
<?php
for ($x=0;$x<9;$x++){
	$bb = 'b'.$x;
	$b = $qwa->$bb;
	if( $b == 0){
		echo "document.getElementById('b".$x."').innerHTML = bn;";
	}elseif( $b == 1){
		echo "document.getElementById('b".$x."').innerHTML = bx;";
	}elseif( $b == 2){
		echo "document.getElementById('b".$x."').innerHTML = bo;";
	}
}
?>
// end in load


function clicki(palece){
	var id = document.getElementById('playerID').value;
	var prop = document.getElementById('prop').value;
	var pub = document.getElementById('pub').value;
	var wiiin = document.getElementById('win').value;
	if(pub == 1 && wiiin == 0){
		if(document.getElementById('bb'+palece).value == 0){
			if(prop == id){
				if(id == 1){
					document.getElementById('b'+palece).innerHTML = bx;
					document.getElementById('bb'+palece).value = 1;
					document.getElementById('prop').value = 2;
					document.getElementById('msg').innerHTML = "Waiting TURN!";
				}else if(id == 2){
					document.getElementById('b'+palece).innerHTML = bo;
					document.getElementById('bb'+palece).value = 2;
					document.getElementById('prop').value = 1;
					document.getElementById('msg').innerHTML = "Your TURN !";
				}
				reqwest(id,palece,1);
			}
		}
	}
}

function reqwest(id,palece,s){
	var code = document.getElementById('code').value;
	$.ajax({url: "api.php?&code="+code+"&p="+id+"&s="+s+"&b="+palece,dataType: 'json', success: function(result){
		
    }});
}


function reupdate(){
	var id = document.getElementById('playerID').value;
	var code = document.getElementById('code').value;
	var pub = document.getElementById('pub').value;
	$.ajax({url: "api.php?code="+code+"&p="+id,dataType: 'json', success: function(result){

		var p_win = result['status']['win'];
		var wiin = document.getElementById('win').value;
		if((p_win == 1 || p_win == 2) && wiin == 0){
			var w0 = result['win']['0'];
			var w1 = result['win']['1'];
			var w2 = result['win']['2'];
			document.getElementById('prop').value = 3;
			if(id == p_win){
				document.getElementById('msg').innerHTML = "WIN !";
				document.getElementById('notemsg').classList.remove("note-info");
				document.getElementById('notemsg').classList.add("note-success");
				document.getElementById('notemsg').classList.remove("border-warning");
				document.getElementById('notemsg').classList.add("border-success");
				document.getElementById('table-gen').classList.remove("border-info");
				document.getElementById('table-gen').classList.add("border-success");
			}else{
				document.getElementById('msg').innerHTML = "LOSS !";
				document.getElementById('notemsg').classList.remove("note-info");
				document.getElementById('notemsg').classList.add("note-danger");
				document.getElementById('notemsg').classList.remove("border-warning");
				document.getElementById('notemsg').classList.add("border-danger");
				document.getElementById('table-gen').classList.remove("border-info");
				document.getElementById('table-gen').classList.add("border-danger");
			}

			if(p_win == 1){
				if(id == 1){
					document.getElementById('b'+w0).innerHTML = bxw;
					document.getElementById('b'+w1).innerHTML = bxw;
					document.getElementById('b'+w2).innerHTML = bxw;
				}else{
					document.getElementById('b'+w0).innerHTML = bxl;
					document.getElementById('b'+w1).innerHTML = bxl;
					document.getElementById('b'+w2).innerHTML = bxl;
				}
			}else if(p_win == 2){
				if(id == 1){
					document.getElementById('b'+w0).innerHTML = bol;
					document.getElementById('b'+w1).innerHTML = bol;
					document.getElementById('b'+w2).innerHTML = bol;
				}else{
					document.getElementById('b'+w0).innerHTML = bow;
					document.getElementById('b'+w1).innerHTML = bow;
					document.getElementById('b'+w2).innerHTML = bow;
				}
			}

			document.getElementById('win').value = 1;
		}

		var now = result['status']['pub'];
		var wwiin = document.getElementById('win').value;
		if(now == 0 && pub == 0){
			document.getElementById('pub').value = 1;
			document.getElementById('player2note').classList.remove("offline-color");
			document.getElementById('player2note').classList.add("note-info");
			if(wwiin == 0){
				if(result['status']['now'] == id){
				document.getElementById('msg').innerHTML = "Your TURN !";
				}else{
					document.getElementById('msg').innerHTML = "His TURN !";
				}
			}
		}
		if(result['status']['err'] == 3){
			document.getElementById('pub').value = 0;
			document.getElementById('msg').innerHTML = "Player OUT !";
			document.getElementById('player2note').classList.remove("note-info");
			document.getElementById('player2note').classList.add("offline-color");
			document.getElementById('notemsg').classList.remove("note-info");
			document.getElementById('notemsg').classList.add("offline-color");
		}

		if(result['status']['up'+id] == 1 && wwiin == 0){
			var bb = result['board'];
			document.getElementById('prop').value = result['status']['now'];
			if(result['status']['now'] == id){
				document.getElementById('msg').innerHTML = "Your TURN !";
			}else{
				document.getElementById('msg').innerHTML = "His TURN !";
			}
			for (x=0;x<9;x++){
				b = bb[x];
				if( b == 0 ){
					document.getElementById('b'+x).innerHTML = bn;
					document.getElementById('bb'+x).value = 0;
				}else if( b == 1){
					document.getElementById('b'+x).innerHTML = bx;
					document.getElementById('bb'+x).value = 1;
				}else if( b == 2){
					document.getElementById('b'+x).innerHTML = bo;
					document.getElementById('bb'+x).value = 2;
				}
			}
			$.ajax({url: "api.php?code="+code+"&p="+id+"&s=2",dataType: 'json', success: function(rrr){}});
		}

		var p_win2 = result['status']['win'];
		if(p_win2 == 3){
			document.getElementById('msg').innerHTML = "DRAW !";
			document.getElementById('notemsg').classList.remove("note-info");
			document.getElementById('notemsg').classList.add("note-secondary");
			document.getElementById('notemsg').classList.remove("border-warning");
			document.getElementById('notemsg').classList.add("border-secondary");
			document.getElementById('table-gen').classList.remove("border-info");
			document.getElementById('table-gen').classList.add("border-secondary");
				
		}

		var wiinn = document.getElementById('win').value;
		if(wiinn == 2){
			if(p_win == id){
				document.getElementById('msg').innerHTML = "WIN !";
				document.getElementById('table-gen').classList.remove("border-info");
				document.getElementById('table-gen').classList.add("border-success");
			}else{
				document.getElementById('msg').innerHTML = "LOSS !";
				document.getElementById('table-gen').classList.remove("border-info");
				document.getElementById('table-gen').classList.add("border-danger");
			}
		}

	}});
}

var refresh = function(){
	reupdate();
	setTimeout(refresh, 500);
}
refresh();

</script>