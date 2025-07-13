<?php
require __DIR__ . '/vendor/autoload.php';
use src\utilits\LoggerFabric;
use Monolog\Logger;

class Ticket
{
    private int $idTicket;
    private string $nameFilm;
    private float $amount;
    private bool $isReserved = false;

    public function __construct(int $idTicket, string $nameFilm, float $amount)
    {
        $this->idTicket = $idTicket;
        $this->nameFilm = $nameFilm;
        $this->amount = $amount;
    }

    public function reserveTicket()
    {
        echo "Ticket for '{$this->nameFilm}' reserved\n";
        $this->isReserved = true;
    }

    public function isReserved()
    {
        return $this->isReserved;
    }

    public function getIdTicket()
    {
        return $this->idTicket;
    }

    public function getNameFilm()
    {
        return $this->nameFilm;
    }

    public function getAmount()
    {
        return $this->amount;
    }
}

interface PaymentMethod
{
    public function pay(): void;
}

class BankTransferPayment implements PaymentMethod
{
    public function pay(): void
    {
        echo "Bank Transfer '8448' Payment\n";
    }
}

class ApplePayPayment implements PaymentMethod
{
    public function pay(): void
    {
        echo "Apple Pay '8448' Payment\n";
    }
}

class GooglePayPayment implements PaymentMethod
{
    public function pay(): void
    {
        echo "Google Pay '8448' Payment\n";
    }
}

interface Notifier
{
    public function notify(): void;
}

class PushNotification implements Notifier
{
    public function notify(): void
    {
        echo "Push Notification send\n";
    }
}

class EmailNotification implements Notifier
{
    public function notify(): void
    {
        echo "Email Notification send\n";
    }
}

class InAppNotification implements Notifier
{
    public function notify(): void
    {
        echo "App Notification send\n";
    }
}

class TicketProcessor
{
    private Ticket $ticket;
    private PaymentMethod $paymentMethod;
    private Notifier $notifier;
    private Logger $logger;

    public function __construct(Ticket $ticket, PaymentMethod $paymentMethod, Notifier $notifier, Logger $logger)
    {
        $this->ticket = $ticket;
        $this->paymentMethod = $paymentMethod;
        $this->notifier = $notifier;
        $this->logger = $logger;
    }

    public function process(): void
    {
        $this->logger->info("Начало обработки билета!");
        $this->logger->info("Попытка зарезервировать билет ID: {$this->ticket->getIdTicket()} Фильм: {$this->ticket->getNameFilm()} Стоимость: {$this->ticket->getAmount()}");
        $this->logger->info("Билет на фильм {$this->ticket->getNameFilm()} зарезрвирован");
        $this->logger->info("Оплата произвелась с банка: " . get_class($this->paymentMethod));
        $this->logger->info("Уведомление об получении билета на: " . get_class($this->notifier));
        $this->notifier->notify();
        $this->paymentMethod->pay();
        $this->ticket->reserveTicket();

    }
}

$ticket = new Ticket(228322, 'Death Note', 1488);
$payment = new GooglePayPayment();
$notifier = new InAppNotification();
$logger=LoggerFabric::createLogger("ticket");
$ticketProcessor = new TicketProcessor($ticket, $payment, $notifier, $logger);
$ticketProcessor->process();






































