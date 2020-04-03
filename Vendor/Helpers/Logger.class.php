<?php


class Logger {
    private  $message;

    public function __construct($msg=null)
    {
        $this->message = $msg;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function shout($msg=null){
        if($msg==null) die($this->getMessage());
        die($msg);
    }

    public function debugAndDie($data){
        var_dump($data);
        die($this->getMessage());
    }


}