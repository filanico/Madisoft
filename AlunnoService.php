<?php
/**
 * Riscrivere le classi migliorandole sotto ogni aspetto (sintassi, struttura...)
 * Le classi devono poter funzionare con php >= 7.3
 */

class Alunno
{
    private $codiceFiscale;

    /* 
    Per testare devo valorizzare codice fiscale e posso farlo     
    1. Dichiarando un metodo con un parametro 
    (opzione valida)
    2. Dichiarando un metodo setter 
    (opzione consigliabile perchè consente di gestire il valore salvato nella variabile)
    3. Dichiarando "public" la variabile $codiceFiscale 
    (opzione sconsigliabile dal momento che si perderebbe il controllo
    su chi scrive)

    Scelgo l'opzione 1. perchè mi consente di istanziare l'oggetto ed impostare la variabile $codiceFiscale nello stesso tempo
    */
    public function Alunno(string $_codfisc){        
        $this->codiceFiscale = $_codfisc;
    }

    public function getCodiceFiscale()
    {
        return $this->codiceFiscale;
    }

}

class Classe
{
    private $alunni = NULL;

    // Forziamo il tipo del parametro su Alunno
    public function aggiungiAlunno(Alunno $alunno)
    {
        //Delego la lettura dell'array al getter
        $alunni = $this->getAlunni();
        $this->alunni[$alunno->getCodiceFiscale()] = $alunno;
    }

    public function getAlunni()
    {
        /*
         Controllo che 'alunni' non sia NULL
         in tal caso creo un array vuoto
        */
        if( $this->alunni == NULL)
            $this->alunni=[];
        return $this->alunni;
    }
}

class AlunnoService
{

    public function aggiungiAlunno(Alunno $alunno, Classe $classe)
    {
        /*
            Dovendo leggere almeno 2 volte il risultato del metodo
            è conveniente memorizzare l'array in un'apposita
            variabile
        */
        $alunni = $classe->getAlunni();
        
        if (count($alunni) < 10) 
        {
            /*
                Utilizziamo un array associativo che 
                risulta più comodo..
            */
            if(!isset($alunni[$alunno->getCodiceFiscale()]))
            {
                $classe->aggiungiAlunno($alunno);
            }
            else
            {
                throw new AlunnoGiaPresenteException();                
            }
        }
        else
        {
            throw new TroppiAlunniException();
        }
    }

}

class AlunnoGiaPresenteException extends Exception
{

}

class TroppiAlunniException extends Exception
{

}