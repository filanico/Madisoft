<?php

 require('alunnoservice.php');

 $classe = new Classe();
 $alunnoservice = new AlunnoService();



 // 1. Classe vuota -> aggiungo alunno
 $alunno = new Alunno("FLNNLN83B19A669E");
 $alunnoservice->aggiungiAlunno($alunno,$classe);
 // $as->aggiungiAlunno($a,$c);
 var_dump($classe);

 if(true){
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
	 $alunnoservice->aggiungiAlunno($alunno,$classe);
 }

 ?>