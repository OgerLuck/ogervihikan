<?php
	include "connection.php";

    $token = "369826729:AAEBzQRWF8KSdxYGwcUZRr4k2lIEHq81nbo";
    $web = "https://api.telegram.org/bot".$token;
    $update = file_get_contents("php://input");
    $updateArray = json_decode($update, TRUE);
    //print_r($updateArray);
    $chatID = $updateArray["message"]["chat"]["id"];
    $answer = $updateArray["message"]["text"];
    //file_put_contents("chatID.txt", $request);

	if ($answer == "/start"){
		$replay = "Welcome to Guess Lyric Game.";
		sendMessage($chatID, $replay);
    	//file_get_contents($web."/sendmessage?chat_id=".$chatID."&text=".$replay);
    	$qA = qAGenerator($chatID, $conn);
    	$q = $qA["q"];
    	sendMessage($chatID,$q);
    	//file_get_contents($web."/sendmessage?parse_mode=html&chat_id=".$chatID."&text=".$q);
	} else {
		$statusAnswer = checkAnswer($chatID, $answer, $conn);
		if ($statusAnswer==true){
			$replay = "<b>".$answer."</b> is the correct answer";
			sendMessage($chatID, $replay);
    		//file_get_contents($web."/sendmessage?parse_mode=html&chat_id=".$chatID."&text=".$replay);

    		$qA = qAGenerator($chatID, $conn);
	    	$q = $qA["q"];
/*    	    $fp = fopen('results.json', 'w');
			fwrite($fp, json_encode($q));
			fclose($fp);*/
	    	sendMessage($chatID,$q);
	    	//file_get_contents($web."/sendmessage?parse_mode=html&chat_id=".$chatID."&text=".$q);
		}
		
	}

	function sendMessage ($chatId, $message) {
       	$token = "369826729:AAEBzQRWF8KSdxYGwcUZRr4k2lIEHq81nbo";
    	$web = "https://api.telegram.org/bot".$token;
      	$url = $web."/sendMessage?parse_mode=html&chat_id=" . $chatId . "&text=" . $message;
       	$ch = curl_init();
       	curl_setopt($ch, CURLOPT_URL, $url);
       	curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
       	curl_setopt($ch, CURLOPT_HEADER, 0);
       	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
       	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
       	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
       	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        
       	$result = curl_exec($ch);
       	if($result===FALSE){
           	$error = curl_error($ch);
       	}
       	curl_close($ch);
        
       	return $result;
	}

	function qAGenerator($chatID, $conn){
		$results = array();
		$max_play = 5;
		$random_q_ID = 0;
		$stat = true;
		$play_ID=0;
		//Nyari play_ID
	    $query_check_play = $conn->query("SELECT ID, `status` FROM tb_play WHERE ID = (SELECT MAX(ID) FROM tb_play) AND chat_ID=$chatID;");
	    if ($query_check_play->num_rows < 1){
	    	$query_insert_play = $conn->query("INSERT INTO tb_play(chat_ID, `time`) VALUES($chatID, NOW());");
			$play_ID = $conn->insert_id;
			
		} else {
			while ($row = $query_check_play->fetch_assoc()) {
		        if ($row["status"]==0){
		        	$query_insert_play = $conn->query("INSERT INTO tb_play(chat_ID, `time`) VALUES($chatID, NOW());");
		        	$play_ID = $conn->insert_id;
		        } else{
		        	$play_ID = $row["ID"];
		        }
		    }
			
		}

		//Nyari udah berapa kali main, max = $max_play.
		$query_check_total_play = $conn->query("SELECT COUNT(play_ID) as 'total' FROM tb_play_detail WHERE play_ID=$play_ID;");
		while ($row = $query_check_total_play->fetch_assoc()) {
			if($row["total"]<$max_play){
				//Nyari soal.
				while($stat){
					$query_random = $conn->query("SELECT ID FROM tb_qa AS r1 JOIN (SELECT CEIL(RAND() * (SELECT MAX(ID) FROM tb_qa)) AS ID2) AS r2 WHERE r1.ID >= r2.ID2 ORDER BY r1.ID ASC LIMIT 1;") or $conn->error;
					while ($row = $query_random->fetch_assoc()) {
				        $random_q_ID = $row["ID"];
				    }
				    $query_check_question = $conn->query("SELECT ID FROM tb_play_detail WHERE play_ID=$play_ID AND qa_ID=$random_q_ID;");
					if ($query_check_question->num_rows < 1){
						$query_insert_rand_qa = $conn->query("INSERT INTO tb_play_detail(play_ID, qa_ID) VALUES($play_ID, $random_q_ID);");
						$stat = false;
					} else {
						$stat = true;
					}
				}
				$query_get_qa = $conn->query("SELECT artist, song, question FROM tb_artists JOIN tb_songs 
					ON tb_artists.`ID` = tb_songs.`artist_ID` JOIN tb_qa
					ON tb_songs.`ID` = tb_qa.`song_ID`
					WHERE tb_qa.`ID` = $random_q_ID");
				while ($row = $query_get_qa->fetch_assoc()) {
				   	$q = "\\n".$row["question"];
				   	$q = str_replace("\\n", "\n", $q);
				   	$artist = str_replace("&","&amp;", $row["artist"]);
				   	$song =  $row["song"];
				   	$q = urlencode("<b>".$artist." - ".$song."</b>".$q);
				}
			} else{
				$query_update_play = $conn->query("UPDATE tb_play SET `status` = 0 WHERE ID = $play_ID");
				$q = "Game's Finish, Your Score is xxx";
			}
		}
		
/*	    $fp = fopen('debug_question.txt', 'w');
		fwrite($fp, $q);
		fclose($fp);*/
		$results["q"] = $q;
		return $results;
	}

	function checkAnswer($chatID, $a, $conn){
		$query_check_answer = $conn->query("SELECT answer FROM tb_qa JOIN tb_play_detail 
			ON tb_qa.`ID` = tb_play_detail.`qa_ID` JOIN tb_play
			ON tb_play_detail.`play_ID` = tb_play.`ID`
			WHERE tb_play_detail.`play_ID`=(SELECT ID FROM tb_play WHERE chat_ID=$chatID AND `status`=1) AND tb_play_detail.`ID` = (SELECT MAX(tb_play_detail.`ID`));");
		while ($row = $query_check_answer->fetch_assoc()) {
	        $answer = $row["answer"];
	    }
	    if(strtolower($answer)==strtolower($a)){
	    	return true;
	    } else{
	    	return false;
	    }
	}
    
?>