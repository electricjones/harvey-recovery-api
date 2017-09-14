<?php
namespace App;

/**
 * Class SMSServiceInterface
 * @package App\Http\Controllers
 */
interface SMSServiceInterface
{
    /**
     * @param string $number
     * @param string $message
     * @return mixed
     */
    public function send($number, $message);
}
