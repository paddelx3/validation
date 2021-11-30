<?php

namespace Rakit\Validation\Rules;

use Rakit\Validation\Rule;

class Before extends Rule
{
    use Traits\DateUtilsTrait;

    /** @var string */
    protected $message = "The :attribute must be a date before :time.";

    /** @var array */
    protected $fillableParams = ['time'];

    /**
     * Check the $value is valid
     *
     * @param mixed $value
     * @return bool
     */
    public function check($value): bool
    {
        $this->requireParameters($this->fillableParams);
        $time = $this->parameter('time');

        if (!$this->isValidDate($value)) {
            return false;
        }

        return $this->getTimeStamp($time) > $this->getTimeStamp($value);
    }
}
