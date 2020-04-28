<?php

 require('alunnoservice.php');

 $c = new Classe();
 $as = new AlunnoService();



 // 1. Classe vuota -> aggiungo alunno
 $a = new Alunno("FLNNLN83B19A669E");
 $as->aggiungiAlunno($a,$c);
 // $as->aggiungiAlunno($a,$c);
 var_dump($c);

 if(false){
	 // 2. Classe popolata -> aggiungo alunno
	 $alunni = [
	 	new Alunno("FLNNLN83B19A669E"),
	 	new Alunno("FLNNLN83B19A669F"),
	 	new Alunno("FLNNLN83B19A669G"),
	 	new Alunno("FLNNLN83B19A669H"),
	 	new Alunno("FLNNLN83B19A669H"),
	 ];
	 // Popoliamo la classe
	 foreach($alunni as $alunno)
	 	$classe->aggiungiAlunno($alunno);
	 $as->aggiungiAlunno($a,$c);
 }

 ?>