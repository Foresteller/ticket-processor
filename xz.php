<?php

//use Monolog\Logger;
//
//trait Animal
//{
//    public $name;*
//    public $age;
//}
//trait Rabits
//{
//    public $meh;
//    public function log(string $message) {
//        echo "[LOG]: $message\n";
//    }
//}
//class Rabbit
//{
//    use Animal, Rabits;
//    public function create() {
//        $this->log('Пользователь создан!');
//    }
//}
//$trait = new Rabbit();
//$trait->create();

trait FileLogger {
    public function logToFile($message) {
        file_put_contents('log.txt', $message . PHP_EOL, FILE_APPEND);
    }
}

class Payment {
    use FileLogger;

    public function pay() {
        $this->logToFile("Оплата выполнена!");
    }
}
