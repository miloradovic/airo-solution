<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Quotation extends Model
{
    private const FIXED_RATE = 3;

    public function __construct(string $age, string $currency, string $startDate, string $endDate) {
        $this->age = $age;
        $this->currency = $currency;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * Instead of id from DB
     * Returns random value
     */
    public function getQuotationId(): int
    {
        return random_int(1, 9999999);
    }

    public function calculateTotal(): float
    {
        $total = 0;

        $age_input = explode(',', $this->age);

        $diff = $this->getLengthOfTrip($this->startDate, $this->endDate);

        foreach ($age_input as $age) {
            $total += self::FIXED_RATE * $diff * AgeLoadTable::getAgeLoadValue($age);
        }

        return $total;
    }

    private function getLengthOfTrip(string $tripStarts, string $tripEnds): int
    {
        $startDateFormat = Carbon::createFromFormat('Y-m-d', $tripStarts);
        $endDateFormat = Carbon::createFromFormat('Y-m-d', $tripEnds);
        return $endDateFormat->diffInDays($startDateFormat, true) + 1;
    }
}
