<?php

class users {
    private $usersCount;
    private $users;

    /**
     * users constructor.
     */
    public function __construct()
    {
        $this->usersCount = 0;
        $this->users = new ArrayObject();

        $this->addUser("root", "toor");
        $this->addUser("demo", "demo");
    }

    private function addUser($username, $password) {
        $this->users[$this->usersCount] = new stdClass();
        $this->users[$this->usersCount]->username = $username;
        $this->users[$this->usersCount]->password = $password;
        $this->usersCount++;
    }

    public function login($username, $password) {
        $status = false;
        for($i = 0; $i < $this->usersCount;$i++) {
            $tmpUsername = $this->users[$i]->username;
            $tmpPassword = $this->users[$i]->password;

            if($tmpUsername == $username && $tmpPassword == $password) {
                $status = true;
            }
        }

        return $status;
    }

    public function createSession($username, $password) {
        return md5($username.$password);
    }

    public function checkSession($sessionId) {
        $status = false;
        for($i = 0; $i < $this->usersCount;$i++) {
            $tmpUsername = $this->users[$i]->username;
            $tmpPassword = $this->users[$i]->password;

            if($sessionId == md5($tmpUsername.$tmpPassword)) {
                $status = true;
            }
        }

        return $status;
    }


}