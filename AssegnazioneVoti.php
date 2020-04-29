<?php

	class Alunno{
		private $id;
		private $email;
		public function Alunno($id,$email){
			$this->id = $id;
			$this->email = $email;
		}
		public function getId()
		{
			return $this->id;
		}
	}

	class Voto{
		private $id;
		private $punteggio;
		private $dataValutazione;

		public function Voto($punteggio)
		{
			$this->punteggio = $punteggio;
			$this->dataValutazione = new DateTime();
			/**
				Per ragioni di test imposto la data del voto a 2 giorni fa, 
				anche se questo sarà un valore dipendente dalla tupla nella tabella 
				DB
			*/			
			$di = new DateInterval("P2D");
			$di->invert = 1;
			$this->dataValutazione = $this->dataValutazione->add($di);
		}

		public function GetDataValutazione(){
			return $this->dataValutazione;
		}

		public function GetPunteggio(){
			return $this->punteggio;
		}
	}

	class Service{		
		const REVOKE_VOTE_WITHIN_DAYS=2;
		private static $instance = NULL; 
		private $voti=NULL;
		
		public static function Get(){
			if( self::$instance == NULL)
				self::$instance = new Service();
			return self::$instance;
		}

		public function Service(){
			$this->voti = [];
		}

		private function SendMail(string $templateName, array $varsValues){
			// ..::.. //
		}

		public function massAssignVoto(array $alunni, int $punteggio){
			foreach($alunni as $alunno)
			{
				$voto = new Voto($punteggio);
				$this->voti[$alunno->getId()] = $voto;
				$this->SendMail('tpl_mail_vote_added',[
					'subj' => "Voto assegnato",
					'idAlunno' => $alunno->getId(),
					'voto' => $voto
				]);
			}
		}

		public function revokeVoto($alunno,$dataCancellazione){
			$today = new DateTime();
			$totCancellati=0;
			foreach($this->voti as $idAlunno => $voto){
				if( $today->diff($dataCancellazione)->d <= self::REVOKE_VOTE_WITHIN_DAYS ){
					if( $dataCancellazione->diff($voto->GetDataValutazione())->d == 0 ){
						$totCancellati++;
						$sDate = $voto->GetDataValutazione()->format('d/M/Y');
						echo "Eliminato voto {$voto->GetPunteggio()} 
						del {$sDate} 
						assegnato ad alunno {$idAlunno}<br>";
						unset($this->voti[$idAlunno]);
						$this->SendMail('tpl_mail_vote_revoked',[
							'subj' => "Voto eliminato",
							'idAlunno' => $idAlunno,
							'voto' => $voto
						]);
					}
					// echo "Data voto: ".$dataCancellazione->format('d/M/Y');
				}				
				else
				{
					throw new SonoPassatiTroppiGiorniException();				
				}
			}
			echo "Eliminati: {$totCancellati} voti <br>";
		}

	}

	class SonoPassatiTroppiGiorniException extends Exception{}

	/************************** TEST ****************************************************/
	$svc = Service::Get();
	$id_alunno = 0;
	$alunni = [
		new Alunno($id_alunno++,"nomecognome_${id_alunno}@libero.it"),
		new Alunno($id_alunno++,"nomecognome_${id_alunno}@libero.it"),
		new Alunno($id_alunno++,"nomecognome_${id_alunno}@libero.it"),
		new Alunno($id_alunno++,"nomecognome_${id_alunno}@libero.it"),
	];
	$svc->massAssignVoto($alunni,5);
	$dataValutazioneRevoca = new DateTime();
	$di = new DateInterval("P2D");
	$di->invert = 1;
	$dataValutazioneRevoca = $dataValutazioneRevoca->add($di);
	try{
		$svc->revokeVoto($alunni[0],$dataValutazioneRevoca);
	} catch (\SonoPassatiTroppiGiorniException $e_sptg){
		echo "ERRORE: impossibile cancellare: sono passati troppi giorni..";
	}
	/************************* TEST ******************************************************/

?>