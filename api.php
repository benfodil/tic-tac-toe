<?php
include_once('db.php');
	// X&O API
	// err = 0 = show and update
	// err = 1 = show
	// err = 2 = code or player error
	// err = 3 = code not found
	// err = 4 = see done
	// err = 5 = board over raid 
	isset($_GET["p"]) ? $p = $_GET["p"] : $p = 0; // player id
	isset($_GET["b"]) ? $b = $_GET["b"] : $b = null; // board pos now
	isset($_GET["code"]) ? $code = $_GET["code"] : $code = 0; // invet code
	isset($_GET["s"]) ? $s = $_GET["s"] : $s = 0; // update active
	
	if($code != 0 && $p != 0){
	
		$qr = mysqli_num_rows(mysqli_query($connect,"SELECT * FROM xo_game WHERE code='$code' and val='1' "));
	
		if($s == 2){ // update just see
			$p == 1 ? mysqli_query($connect,"UPDATE xo_game SET up1='0' WHERE code='$code' and val='1'") : null;
			$p == 2 ? mysqli_query($connect,"UPDATE xo_game SET up2='0' WHERE code='$code' and val='1'") : null;
			$err = 4;
			$a = array('status' => array('err' => $err));
		}elseif($qr != 0){
			if($s == 1){ // update board
				$xox = mysqli_fetch_object(mysqli_query($connect,"SELECT * FROM xo_game WHERE code='$code' and val='1'"));
				$xxx = 'b'.$b;
				$xxx = $xox->$xxx;
				if($xxx == 0){
					mysqli_query($connect,"UPDATE xo_game SET up1='1' WHERE code='$code' and val='1'");
					mysqli_query($connect,"UPDATE xo_game SET up2='1' WHERE code='$code' and val='1'");
					if($p == 1){
						mysqli_query($connect,"UPDATE xo_game SET p_now='2' WHERE code='$code' and val='1'");
						mysqli_query($connect,"UPDATE xo_game SET b$b='1' WHERE code='$code' and val='1'");
					}elseif($p == 2){
						mysqli_query($connect,"UPDATE xo_game SET p_now='1' WHERE code='$code' and val='1'");
						mysqli_query($connect,"UPDATE xo_game SET b$b='2' WHERE code='$code' and val='1'");
					}
					$err = 0;
				}else{
					$err = 5;
				}
				
			}else{
				$err = 1;
			}
			$xo = mysqli_fetch_object(mysqli_query($connect,"SELECT * FROM xo_game WHERE code='$code' and val='1' "));
			$up1 = $xo->up1;
			$up2 = $xo->up2;
			$pub = $xo->pub;
			$now = $xo->p_now;
			$win = $xo->win;
			$w0 = $xo->w0;
			$w1 = $xo->w1;
			$w2 = $xo->w2;
			$a = array(1,'status' => array('err' => $err, 'up1' => $up1, 'up2' => $up2, 'now' => $now,'win' => $win, 'pub' => $pub));
			
			for ($x=0;$x<9;$x++){
				$b = 'b'.$x;
				$a['board'][$x] = $xo->$b;
			}
			$s = win($a,$err);
			$a['status']['win'] = $s[0];
			$a['win'] = $s[1];
		}else{
			$err = 3;
			$a = array('status' => array('err' => $err));
		}
	
	}else{
		$err = 2;
		$a = array('status' => array('err' => $err));
		
	}
	echo json_encode($a);



function win($a,$err){
	global $connect,$code;
	if($err == 0 || $err == 1){
		$a = $a['board'];
		$p_win = 0;
		$a_win = array(0,0,0);
		for($p=1;$p<=2;$p++){
			if($a[0] == $p && $a[1] == $p && $a[2] == $p){
				$a_win = array(0,1,2);
				$p_win = $p;
			}elseif($a[3] == $p && $a[4] == $p && $a[5] == $p){
				$a_win = array(3,4,5);
				$p_win = $p;
			}elseif($a[6] == $p && $a[7] == $p && $a[8] == $p){
				$a_win = array(6,7,8);
				$p_win = $p;
			}elseif($a[0] == $p && $a[3] == $p && $a[6] == $p){
				$a_win = array(0,3,6);
				$p_win = $p;
			}elseif($a[1] == $p && $a[4] == $p && $a[7] == $p){
				$a_win = array(1,4,7);
				$p_win = $p;
			}elseif($a[2] == $p && $a[5] == $p && $a[8] == $p){
				$a_win = array(2,5,8);
				$p_win = $p;
			}elseif($a[0] == $p && $a[4] == $p && $a[8] == $p){
				$a_win = array(0,4,8);
				$p_win = $p;
			}elseif($a[2] == $p && $a[4] == $p && $a[6] == $p){
				$a_win = array(2,4,6);
				$p_win = $p;
			}
		}

		$acount = count(array_keys($a, 0));
		if($p_win == 0 && $acount == 0){
			$p_win = 3;
		}

		if($p_win != 0){
			mysqli_query($connect,"UPDATE xo_game SET w0='$a_win[0]' WHERE code='$code' and val='1'");
			mysqli_query($connect,"UPDATE xo_game SET w1='$a_win[1]' WHERE code='$code' and val='1'");
			mysqli_query($connect,"UPDATE xo_game SET w2='$a_win[2]' WHERE code='$code' and val='1'");
			mysqli_query($connect,"UPDATE xo_game SET win='$p_win' WHERE code='$code' and val='1'");
		}
		$s = array($p_win,$a_win);
		return $s;
	}
}


?>