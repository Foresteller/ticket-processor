<?php
namespace src\traits;

trait Reservable
{
    private bool $isReserved = false;

    public function reserve(): void
    {
        if ($this->isReserved) {
            echo "Билет уже зарезервирован)\n";
            return;
        }

        echo "Билет зарезервирован\n";
        $this->isReserved = true;

        if (method_exists($this, 'logInfo')) {
            $this->logInfo("Билет успешно зарезервирован!");
        }
    }

    public function isReserved(): bool
    {
        return $this->isReserved;
    }
}
