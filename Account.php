<?php

class Account
{
    private $balance;

    public function setBalance(int $balance)
    {
        $this->balance = $balance;
    }

    public function getBalance(): int
    {
        // mancava un return
        return $this->balance;
    }
}

class Client
{
    public function deposit(Account $account, int $amount)
    {
        $balance = $account->getBalance();        
        $account->setBalance($balance + $amount);
    }

    public function withdraw(Account $account, int $amount)
    {
        $balance = $account->getBalance();
        if ($balance >= $amount) {
            // Qui è possibile utilizzare il metodo appena dichiarato
            // anzichè clonare codice simile alle righe 23,24
            $account->deposit($amount * -1);
            // $newBalance = $balance - $amount;
            // $account->setBalance($balance);
        } else {
            throw new \Exception('Credito insufficiente');
        }
    }
}
