<?php 

class Perhitungan extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		if( !$this->session->userdata('id') ) redirect('auth/login');
	}
	public function index()
	{
		$origin['menu_list_id'] = 'perhitungan_index';
		$data['dosen']= $this->m_dosen->tampil_data()-> result();
		$data['skripsi'] = $this->m_skripsi->tampil_data_skripsi()->result();
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
		echo json_encode( $arrayDoc );
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
		// echo echo json_encode( $a ) ;
		redirect('katadasar/index');
	}
	public function proses(){
		$nama = $this->input->post('name');
		$nim = $this->input->post('registration_number');
		$judul = $this->input->post('title');

		$data_recomendation['name']					= $nama;
		$data_recomendation['registration_number']	= $nim;
		$data_recomendation['title']				= strtolower( $judul );

		$arrayDoc = array();
		foreach( $this->m_katadasar->tampil_data()-> result() as $item )
		{
			$arrayDoc []= $item->kata_dasar;
		}
		// die;
		// echo echo json_encode( $this->m_katadasar->tampil_data()-> result() );
		// echo '<br>';
		// echo '<br>';
		// echo echo json_encode( $arrayDoc );
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

		// $tokens = $this->removeNumericTokens($tokens);

		$k = 1;
		foreach ($tokens as $val)
		{
			$keyName = "q".$k;
			
			$result = $this->doSearch($val);
			
			if($result)
			{
				$data[$keyName] = $result;
				$k = $k + 1;
				// tampilan bila kata ditemukan dan tdak
				// echo "<p style='color:green;'>found for ".$val.' index : '.$result."</p>";
			}
			// else 
			// 	echo "<p style='color:red;'>No result found for ".$val."</p>";
		}
		// echo "tokens<br>";
		// echo json_encode($data);
		// echo "<br>";
		// echo "<br>";
		// die;
		$k = 1;
		foreach ($data as $val)
		{
			$keyName = "q".$k;
			// echo var_dump($val);
			// echo "<br>";
			$set = explode(" ", $val);
			// $set = explode(",", $val);
			$df = count($set);
			
			foreach ($set as $v)
			{
				$s = explode(":", $v);		
				$ready[$keyName][$s[0]]['tf'] = intval($s[1]);
				$ready[$keyName][$s[0]]['df'] = $df;		 
			}
			$k = $k + 1;
		}
		// die;

		// echo "ready<br>";
		// echo json_encode($ready);
		// echo "<br>";
		// echo "<br>";

		$finalArray = Array();
		//Merging each query arrays into one 1 array
		foreach ($ready as $key => $m)
		{
			$finalArray = $this->new_mergeArrays($finalArray,$m, $key );
		}

		// echo "finalArray<br>";
		// echo json_encode($finalArray);
		// echo "<br>";
		// echo "<br>";
		// Getting BM25 scores of each documents
		foreach ($finalArray as $document=>$fdata) {

			$finalArray[$document]['bm25_score'] = $this->new_BM25( $fdata, $document );
			// echo "<br>";
			// echo $finalArray[$document]['bm25_score'];
			// echo "<br>";
			$sortedArray[$document] = $finalArray[$document]['bm25_score'];
		}
		// die;


		arsort($sortedArray);

		$time_end = microtime(true);
		$time = $time_end - $time_start;
		// echo "<br /><br />Search time is : <b> ".round($time,2)." microseconds</b>";
		// echo "<br />Total documents retrieved: <b>".count($sortedArray)."</b>";
		// echo json_encode($sortedArray);
		// die;
		foreach ($sortedArray as $key=>$val)
		{
			$peminatan[] = $key;
			$score[] = number_format($finalArray[$key]['bm25_score'],2) . ' -> ' . $key . ' --  ';

			// Menampilkan Hasil dari BM25 (Kata Dasar)
			// echo "<div style='background-color: #F5F5F5;
			// margin-top: 2px;
			// border-bottom-style: solid;
			// border-bottom-width: thin;
			// height: 50px;
			// padding-left: 10px;	' ><p class='b1'><b>Doc ID: </b>".$key."</p><p class='b2'><b>BM25 score: </b>".$finalArray[$key]['bm25_score']."</p><p class='b3'><b>Term Freq.: </b>".$finalArray[$key]['tf']."</p><p class='b4'><b>Doc. Freq.: </b>".$finalArray[$key]['df']."</p></div>";
			// die;
		}
		// echo json_encode($peminatan);
		// die;
		
		// echo "<br>";

		// dosen pembimbing 1, penguji 1
		$list_dosen_ketua = $this->m_dosen->dosen_ketua( $peminatan[0] )->result();
		foreach ($list_dosen_ketua as $key => $dosen) {
			$dosen_id[] = $dosen->id;
		}
		switch (count($peminatan)) {
			case 2:
				$list_dosen = $this->m_dosen->dosen_berdasarkan_peminatan( $peminatan[1], $dosen_id[0], $dosen_id[1] )->result();
				break;
			case 3:
				foreach ($peminatan as $key=>$val)
				{
					$list_dosen[] = $this->m_dosen->dosen_berdasarkan_peminatan( $val, $dosen_id[0], $dosen_id[1] )->row();					
				}
				break;
			default:
				$list_dosen = $this->m_dosen->dosen_berdasarkan_peminatan( $peminatan[0], $dosen_id[0], $dosen_id[1] )->result();
				break;
		}
		// dosen 2, 4, 5
		$list_dosen = $this->m_dosen->dosen_berdasarkan_peminatan( $peminatan, NULL, $dosen_id[0], $dosen_id[1] )->result();

		// urut dosen
		$data['score'] = $score;
		$data['nama'] = $nama;
		$data['nim'] = $nim;
		$data['judul'] = $judul;
		$data['peminatan'] = $peminatan;
		$data['rekomendasi_dosen'] = array(
			$list_dosen_ketua[0],
			$list_dosen[0],
			$list_dosen_ketua[1],
			$list_dosen[1],
			$list_dosen[2],
		);

		$dosens = $this->m_dosen->tampil_data()->result();
		foreach ($dosens as $key => $dsn) {
			$select_dosen[ $dsn->id ] = $dsn->nama;
		}
		// hilangkan dosen yang sudah ada
		foreach ($data['rekomendasi_dosen'] as $key => $dsn) {
			unset( $select_dosen[ $dsn->id ] );
		}
		$data['list_dosen'] = $select_dosen;
		

		$origin['menu_list_id'] = 'perhitungan_index';
		$this->load->view('template/header', $origin);
		$this->load->view('template/sidebar');
		$this->load->view('tampil_saran', $data);
		$this->load->view('template/footer');
	} 

	public function idf( $N, $Nqi )
	{
		// echo 'N : '.json_encode( $N - $Nqi + 0.5 );
		// echo '<br>';	
		// echo 'Nqi : '.json_encode( ($N - $Nqi + 0.5) / ($Nqi + 0.5) );
		// echo '<br>';	
		$x = ($N - $Nqi + 0.5) / ($Nqi + 0.5);
		return abs( log10( $x ) );
	}
	public function new_BM25( $datas, $_document )
	{	
		// $content = file_get_contents("content/".$did.".txt"); // reading giving document
		$where = array ('kategori'=>$_document);
		$content = $this->m_katadasar->edit_data($where, 'tb_katadasar')->result();
		// echo json_encode( $content );
		// echo '<br>';
		//$doc_length = strlen($content); // length of the giving document
		$tokens_content = explode(' ', $content);
		$tokens_content = $this->removeDuplicateElements($tokens_content);
		$tokens_content = $this->stripPunctuations($tokens_content);
		$tokens_content = $this->removeStopWords($tokens_content);
		// $tokens_content = $this->removeNumericTokens($tokens_content);
		$doc_length = count($tokens_content);	
		
		 // initializing bm25 score variable
		$tfWeight = 1.2; // Term frequency weightage -> k1
		$dlWeight = 0.75; // Document frequency weightage -> b
		$total_docs = 3; // Total number of documents in the corpus

		$docs = $this->m_katadasar->tampil_data()->result();
		$sum = 0 ;
		foreach ($docs as $value) {
			$x = explode(' ', $value->kata_dasar);
			$sum += count( $x );
		}
		$avg_dl = $sum / 3; // average document length of corpus with normalization of tokens
		// echo 'avg_dl : '.$avg_dl .'<br>';
		// echo '<br>';

		$sum_BM25 = 0;
		foreach ($datas as $key => $data) {
			// echo json_encode( [ $key, $data ] );
			// echo '<br>';
			$idf = $this->idf( $total_docs , $data['df'] );
			// echo 'idf : '.$idf;
			// echo '<br>';
			$num = ($tfWeight + 1) * $data['tf'] ;
			// echo 'num : '.$num ;
			// echo '<br>';
			$denom = $tfWeight * ((1 - $dlWeight) + $dlWeight * ($doc_length / $avg_dl)) + $data['tf'];
			// echo 'denom : '.$denom ;
			// echo '<br>';
			$bm25 = $idf * ($num/$denom);
			// echo 'bm25 : '.$bm25;
			// echo '<br>';
			$sum_BM25 += $bm25;

		}
		// echo '<br>';
		// echo 'total score : '.$sum_BM25;
		// echo '<br>';

		return $sum_BM25;
		
	}

	// This function is mering query terms arrays in to one array
	// Function used in queryManager.php
	public function new_mergeArrays($main,$temp, $_key)
	{
		// echo json_encode($_key);
		// echo "<br>";	

		foreach ($temp as $doc=>$val)
		{
			// echo json_encode($key);
			// echo "<br>";
			if(array_key_exists($doc, $main) == TRUE)
			{	
				if(array_key_exists( $_key, $main[$doc] ) == TRUE)
				{	
					$main[$doc][$_key]['tf'] = $main[$doc][$_key]['tf'] + $temp[$doc]['tf'];		
					$main[$doc][$_key]['df'] = $main[$doc][$_key]['df'] + $temp[$doc]['df'];
				}
				else
				{
					$main[$doc][$_key]['tf'] = $temp[$doc]['tf'];		
					$main[$doc][$_key]['df'] = $temp[$doc]['df'];
				}
				
			}
			else
			{
				$main[$doc][$_key] = 
				[
					'tf' => $temp[$doc]['tf'],
					'df' => $temp[$doc]['df'],
				];
			}	
		}
		return $main;		
	}

	public function tambah_skripsi(  )
	{
		$skripsi = array(
			'nama' => $this->input->post('nama'),
			'nim' => $this->input->post('nim'),
			'judul_skripsi' => $this->input->post('judul'),
		);
		$this->m_skripsi->tambah_data( $skripsi );
		$dosen = $this->m_skripsi->skripsi_terbaru()->row();
		$keterangan = ['', 'Pembimbing', 'Pembimbing', 'Penguji', 'Penguji', 'Penguji'];
		for ($i=1; $i < 6; $i++) { 
			$data[] = array(
				'skripsi_id' => $dosen->id,
				'dosen_id' => $this->input->post('dosen_id' . $i),
				'keterangan' => $keterangan[$i],
			);
		}
		$this->m_skripsi->tambah_data_relasi( $data );
		redirect('perhitungan');
	}

	public function dosen( $skripsi_id )
	{
		$origin['menu_list_id'] = 'perhitungan_index';
		$data['dosen']= $this->m_seminar->tampil_data( $skripsi_id )-> result();
		$this->load->view('template/header', $origin);
		$this->load->view('template/sidebar');
		$this->load->view('dosen_seminar', $data);
		$this->load->view('template/footer');
	}

	public function hapus( $skripsi_id )
	{
		// hapus di tabel seminar
		$where['skripsi_id'] = $skripsi_id;
		$this->m_seminar->hapus_data( $where, 'tb_seminar' );

		// hapus di tabel skripsi
		$where = array(
			'id' => $skripsi_id
		);
		$this->m_skripsi->hapus_data( $where, 'tb_skripsi' );
		redirect('perhitungan');
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
		$whatToStrip = array("?","!",",",";",'"','"...', '(', ')','-');
		
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


}


