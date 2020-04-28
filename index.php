<?php

require('alunnoservice.php');

$tests=[1,1,1,1];
$test_idx=0;





if($tests[$test_idx++]){
	// 1. Classe vuota -> aggiungo alunno
	echo "TEST #{$test_idx}\t&nbsp;&nbsp;";
	$classe = new Classe();
	$alunnoservice = new AlunnoService();
	$alunno = new Alunno("FLNNLN83B19A669E");
	// $classe->aggiungiAlunno($alunno);
	$alunnoservice->aggiungiAlunno($alunno,$classe);
 	echo "*** OK !<br>\n";
	// var_dump($classe);
}

if($tests[$test_idx++]){
	// 2. Classe popolata  con clone-> aggiungo alunno
	echo "TEST #{$test_idx}\t&nbsp;&nbsp;";
	$classe = new Classe();
	$alunnoservice = new AlunnoService();
	$alunni = [
		new Alunno("FLNNLN83B19A669E"),
		new Alunno("FLNNLN83B19A669F"),
		new Alunno("FLNNLN83B19A669G"),
		new Alunno("FLNNLN83B19A669H"),
		new Alunno("FLNNLN83B19A669H"),	// <-- clone
	];
	// Popoliamo la classe
	foreach($alunni as $alunno)
		$classe->aggiungiAlunno($alunno);
	try{
		$alunnoservice->aggiungiAlunno($alunno,$classe);
	 	echo "*** OK !<br>\n";
	} catch (AlunnoGiaPresenteException $e_agp){
		echo "*** Alunno gia presente !<br>\n";
	} catch (TroppiAlunniException $e_ta){
	 	echo "*** Troppi alunni !<br>\n";
	}	
}

if($tests[$test_idx++]){
	// 3. Classe popolata senza clone-> aggiungo alunno
	$classe = new Classe();
	$alunnoservice = new AlunnoService();
	$alunno = new Alunno("FLNNLN83B19A669X");
	echo "TEST #{$test_idx}\t&nbsp;&nbsp;";
	$alunni = [
		new Alunno("FLNNLN83B19A669E"),
		new Alunno("FLNNLN83B19A669F"),
		new Alunno("FLNNLN83B19A669G"),
		new Alunno("FLNNLN83B19A669H"),	 	
	];
	// Popoliamo la classe
	foreach($alunni as $_alunno)
		$classe->aggiungiAlunno($_alunno);
	try{
		$alunnoservice->aggiungiAlunno($alunno,$classe);
 		echo "*** OK !<br>\n";
	} catch (AlunnoGiaPresenteException $e_agp){
		echo "*** Alunno gia presente !<br>\n";
	} catch (TroppiAlunniException $e_ta){
	 	echo "*** Troppi alunni !<br>\n";
	}	
}



if($tests[$test_idx++]){
	// 3. Classe popolata con 11 alunni
	$classe = new Classe();
	$alunnoservice = new AlunnoService();
	echo "TEST #{$test_idx}\t&nbsp;&nbsp;";
	$alunni = [
		new Alunno("FLNNLN83B19A669E"),
		new Alunno("FLNNLN83B19A669F"),
		new Alunno("FLNNLN83B19A669G"),
		new Alunno("FLNNLN83B19A669H"),	 	
		new Alunno("FLNNLN83B19A669I"),	 	
		new Alunno("FLNNLN83B19A669J"),	 	
		new Alunno("FLNNLN83B19A669K"),	 	
		new Alunno("FLNNLN83B19A669L"),	 	
		new Alunno("FLNNLN83B19A669M"),	 	
		new Alunno("FLNNLN83B19A669N"),	 	
		new Alunno("FLNNLN83B19A669O"),	 	
	];
	// Popoliamo la classe
	foreach($alunni as $alunno)
		$classe->aggiungiAlunno($alunno);
	try{
		$alunnoservice->aggiungiAlunno($alunno,$classe);
 		echo "*** OK !<br>\n";
	} catch (AlunnoGiaPresenteException $e_agp){
		echo "*** Alunno gia presente !<br>\n";
	} catch (TroppiAlunniException $e_ta){
	 	echo "*** Troppi alunni !<br>\n";
	}	
}

?>