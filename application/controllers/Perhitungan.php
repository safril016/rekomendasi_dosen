<?php 

class Perhitungan extends CI_Controller{
	public function index()
	{
		$origin['menu_list_id'] = 'perhitungan_index';
		$data['dosen']= $this->m_dosen->tampil_data()-> result();
		$this->load->view('template/header', $origin);
		$this->load->view('template/sidebar');
		$this->load->view('rekomendasi_form', $data);
		$this->load->view('template/footer');
	}

	public function indexing(){
		$arrayDoc = array();
		foreach( $this->m_katadasar->tampil_data()-> result() as $item )
		{
			$arrayDoc [ $item->kategori ]= $item->kata_dasar;
		}
		// echo var_dump( $arrayDoc );
		$arrIndex = array();
		foreach( $arrayDoc as $category => $doc )
		{
			$tokens = explode(" ", $doc);
			foreach( $tokens as $word )
			{
				if( !isset( $arrIndex[ $word ] [ $category ] ) ) 
					$arrIndex[ $word ] [ $category ] = 0;

				$arrIndex[ $word ] [ $category ] ++;
			}
			// $arrIndex[ $word ] [ $category ] = $category.":".$arrIndex[ $word ] [ $category ];
		}

		$newArrIndex = array();
		foreach( $arrIndex as $word => $categories )
		{
			$s = [];
			foreach( $categories as $category => $value )
			{			
				$s []= $category.":".$value;
			}
			$newArrIndex[ $word ]= implode( $s, ' ' );
		}

		// echo '<br>';
		// echo '<br>';
		// echo json_encode( $newArrIndex );
		file_put_contents("./uploads/indexing.json",json_encode( $newArrIndex ));
		echo 'berhasil';
		// $txt = file_get_contents("./uploads/stopword.txt");
		// echo json_encode( $txt );
		// echo '<br>';
		// echo '<br>';
		// $a = explode( ' ', $txt );
		// echo var_dump( $a ) ;
	}
	public function proses(){
		$data_recomendation['name']					= $this->input->post('name');
		$data_recomendation['registration_number']	= $this->input->post('registration_number');
		$data_recomendation['title']				= strtolower( $this->input->post('title') );

		$arrayDoc = array();
		foreach( $this->m_katadasar->tampil_data()-> result() as $item )
		{
			$arrayDoc []= $item->kata_dasar;
		}
		// die;
		// echo var_dump( $this->m_katadasar->tampil_data()-> result() );
		// echo '<br>';
		// echo '<br>';
		// echo var_dump( $arrayDoc );
		// echo '<br>';
		// echo '<br>';
		// die;
		$time_start = microtime(true);
		error_reporting(0);

		$intersect = Array();

		$query = trim(htmlspecialchars( $data_recomendation['title'] ));

		$query = $this->applyLowerCase($query);

		$tokens = $this->makeQueryTokens($query);

		$tokens = $this->removeStopWords($tokens);

		$tokens = $this->removeNumericTokens($tokens);

		$k = 1;
		foreach ($tokens as $val)
		{
			$keyName = "q".$k;
			
			$result = $this->doSearch($val);
			
			if($result)
			{
				$data[$keyName] = $result;
				$k = $k + 1;
				echo "<p style='color:green;'>found for ".$val."</p>";

			}
			else 
				echo "<p style='color:red;'>No result found for ".$val."</p>";
		}

		$k = 1;
		foreach ($data as $val)
		{
			$keyName = "q".$k;
			
			$set = explode(",", $val);
			$df = count($set);
			
			foreach ($set as $v)
			{
				$s = explode(":", $v);		
				$ready[$keyName][$s[0]]['tf'] = intval($s[1]);
				$ready[$keyName][$s[0]]['df'] = $df;		 
			}
			$k = $k + 1;
		}

		$finalArray = Array();
		//Merging each query arrays into one 1 array
		foreach ($ready as $m)
		{
			$finalArray = $this->mergeArrays($finalArray,$m);
		}

		// Getting BM25 scores of each documents
		foreach ($finalArray as $key=>$fdata) {
			$finalArray[$key]['bm25_score'] = $this->BM25($finalArray[$key]['df'], $finalArray[$key]['tf'], $finalArray[$key]);
			$sortedArray[$key] = $finalArray[$key]['bm25_score'];
		}

		arsort($sortedArray);

		$time_end = microtime(true);
		$time = $time_end - $time_start;

		echo "<br /><br />Search time is : <b> ".round($time,2)." microseconds</b>";
		echo "<br />Total documents retrieved: <b>".count($sortedArray)."</b>";

		foreach ($sortedArray as $key=>$val)
		{
			echo "<div style='background-color: #F5F5F5;
			margin-top: 2px;
			border-bottom-style: solid;
			border-bottom-width: thin;
			height: 50px;
			padding-left: 10px;	' ><p class='b1'><b>Doc ID: </b>".$key."</p><p class='b2'><b>BM25 score: </b>".$finalArray[$key]['bm25_score']."</p><p class='b3'><b>Term Freq.: </b>".$finalArray[$key]['tf']."</p><p class='b4'><b>Doc. Freq.: </b>".$finalArray[$key]['df']."</p></div>";
		}
	} 


	public function removeDuplicateElements($content)
	{
		return array_unique($content);
	}


	// This function convert uppercase characters to lowercase
	public function applyLowerCase($content)
	{
		return strtolower($content);
	}


	// This function is removing whitespaces in terms
	public function removeWhiteSpaces($content)
	{
		return array_map('trim', $content);
	}


	public function stripPunctuations($content)
	{
		$whatToStrip = array("?","!",",",";",'"','"...', '(', ')' );
		
		foreach ($content as $k=>$val)
		{
			$content[$k] = str_replace($whatToStrip, "", $val);
		}
		
		return $content;	
	}


	// This function check if the given word is stropword or not
	public function removeStopWords($tokens)
	{
		// 177 stop words
		$txt = file_get_contents("./uploads/stopword.txt");
		$stopWords = explode( ' ', $txt );
		foreach ($tokens as $k=>$val)
		{
			$word = $val;
			if(in_array($word, $stopWords))
			{
				unset($tokens[$k]);
			} // END if			
		}
			
		$tokens = array_values($tokens);
		return $tokens;
	}


	// This function remove numerical words from tokens
	public function removeNumericTokens($tokens)
	{	
		foreach ($tokens as $k=>$val)
		{
			$word = $val;
			if(is_numeric($word) || empty($word) || !ctype_alpha($word))
			{
				unset($tokens[$k]);
			} // END if
		}	
		$tokens = array_values($tokens);
		return $tokens;
	}


	// Tokenization of query term
	public function makeQueryTokens($query)
	{
		$t = explode(" ", $query);
		return $t;
	}


	public function doSearch($word)
	{
		$final_index = file_get_contents("./uploads/indexing.json");
		$final_arr = json_decode($final_index,true);

		if(array_key_exists($word, $final_arr))
		{
			return $final_arr[$word];
		}
		else
		{
			return false;
		}	
	}

	// This function is mering query terms arrays in to one array
	// Function used in queryManager.php
	public function mergeArrays($main,$temp)
	{
		foreach ($temp as $key=>$val)
		{
			if(array_key_exists($key, $main) == TRUE)
			{	
				$main[$key]['tf'] = $main[$key]['tf'] + $temp[$key]['tf'];		
				$main[$key]['df'] = $main[$key]['df'] + $temp[$key]['df'];
			}
			else
			{
				$main[$key]['tf'] = $temp[$key]['tf'];
				$main[$key]['df'] = $temp[$key]['df'];
			}	
		}
		return $main;		
	}

	// This function calculated the bm25 scores of the document against givent query
	public function BM25($df,$tf,$did)
	{	
		$content = file_get_contents("content/".$did.".txt"); // reading giving document
		//$doc_length = strlen($content); // length of the giving document
		$tokens_content = explode(' ', $content);
		$tokens_content = $this->removeDuplicateElements($tokens_content);
		$tokens_content = $this->stripPunctuations($tokens_content);
		$tokens_content = $this->removeStopWords($tokens_content);
		$tokens_content = $this->removeNumericTokens($tokens_content);
		$doc_length = count($tokens_content);	
		
		
		$BM25 = 0; // initializing bm25 score variable
		$tfWeight = 1; // Term frequency weightage
		$dlWeight = 0.5; // Document frequency weightage
		$total_docs = 3; // Total number of documents in the corpus
		//$avg_dl = 123; // average document length of corpus without normalization of tokens
		$avg_dl = 40.42; // average document length of corpus with normalization of tokens
		
		$idf = log($total_docs/$df);
		$num = ($tfWeight + 1) * $tf;
		$denom = $tfWeight * ((1 - $dlWeight) + $dlWeight * ($doc_length / $avg_dl)) + $tf;
		$score = $idf * ($num/$denom);
		
		return $score;
	}

}


