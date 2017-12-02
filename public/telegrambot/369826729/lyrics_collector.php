<?php
	include "connection.php";

	$size=10;
	$api_key = "d43a40e9985acd825f3d7ab143cf3112";
	$top_chart = "chart.tracks.get?page=1&page_size=".$size."&country=us&f_has_lyrics=1";
	$web = "http://api.musixmatch.com/ws/1.1/";

	$request_chart = $web.$top_chart."&apikey=".$api_key;
	$chart_content = file_get_contents($request_chart);
	
	$chart_content = json_decode($chart_content, TRUE);
	//print_r($chart_content);
	for($x=0; $x<$size; $x++){
		$artist_name = $chart_content["message"]["body"]["track_list"][$x]["track"]["artist_name"];
		$artist_mm_id = $chart_content["message"]["body"]["track_list"][$x]["track"]["artist_id"];
		$track_name = $chart_content["message"]["body"]["track_list"][$x]["track"]["track_name"];
		$track_mm_id = $chart_content["message"]["body"]["track_list"][$x]["track"]["track_id"];

		//sql escape string
		$artist_name = $conn->real_escape_string($artist_name);
		$track_name = $conn->real_escape_string($track_name);

		$artist_ID = 0;
		$song_ID = 0;
		//Insert ke database
		$query_artist = $conn->query("SELECT ID, musixmatch_ID FROM tb_artists WHERE musixmatch_ID = $artist_mm_id") or $conn->error;
		if ($query_artist->num_rows < 1){
			$query_insert_artist = $conn->query("INSERT INTO tb_artists(musixmatch_ID, artist) VALUES($artist_mm_id, '$artist_name');");
			$artist_ID = $conn->insert_id;
		} else{
			while ($row = $query_artist->fetch_assoc()) {
		        $artist_ID = $row["ID"];
		    }
		}

		$query_song = $conn->query("SELECT ID, musixmatch_ID FROM tb_songs WHERE musixmatch_ID = $track_mm_id") or $conn->error;
		if ($query_song->num_rows < 1){
			$query_insert_song = $conn->query("INSERT INTO tb_songs(musixmatch_ID, artist_ID, song) VALUES($track_mm_id, $artist_ID, '$track_name');");
			$song_ID = $conn->insert_id;
		} else{
			while ($row = $query_song->fetch_assoc()) {
		        $song_ID = $row["ID"];
		    }
		}

		$track_id = $track_mm_id;
		$get_lyric = "track.lyrics.get?track_id=".$track_id;
		$request_lyric = $web.$get_lyric."&apikey=".$api_key;
		$lyric_content = file_get_contents($request_lyric);
		
		$lyric_content = json_decode($lyric_content, TRUE);
		//print_r($content);
		$lyric = $lyric_content["message"]["body"]["lyrics"]["lyrics_body"];

		$array =  explode("\n", $lyric);

/*		for ($z=0; $z<count($array)-3; $z++){ //Kurang 3 untuk ngilangin label commercial use
			echo $array[$z]."<br>";
		}*/

		$q = "";
		$y=0;
		while ($y<count($array)-3){
			$string = $array[$y];
			if(strlen($string)!=0){
				$q = $q.$string." \\n";
			}
			
			if (($y+1)%4==0){
				$result = makeQA($q);
				//echo $result[0]."=========".$result[1];
				//echo "<br>";
				$question = $conn->real_escape_string($result[0]);
				$answer = $conn->real_escape_string($result[1]);
				//Insert ke database
				$query = $conn->query("SELECT ID FROM tb_qa WHERE answer = '$answer' AND song_ID = $song_ID") or $conn->error;
				if ($query->num_rows < 1){
					$query_insert = $conn->query("INSERT INTO tb_qa(song_ID, question, answer) VALUES($song_ID, '$question', '$answer');");
					
				}
				
				$q = "";
			}
			$y++;
		}
		//echo "<br>";
		$array = null;
	}

	function makeQA($q){
		$result = array();
		$q = str_replace(array('?', '!', ',', '"', '(', ')','-',':'), '', $q);
		$word = explode(" ", $q);

		$a = "";
		while (strlen($a)<2 OR $a =="\\n"){
			$chosen = rand(0, count($word)-1);
			$a = $word[$chosen];
		}

		$a = str_replace("\\n", '', $a);
		$a_length = strlen($a);
		$blank = "";
		for ($x=0; $x<$a_length; $x++){
			$blank.="_";
		}
		$word[$chosen] = $blank;
		$q_new = implode(" ", $word);
		$q_new = preg_replace('/((?=^)(\\n))/', '', $q_new);
		//echo $q_new."<br>";
		array_push($result, $q_new, $a);
		return $result;

	}

?>