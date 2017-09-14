<?php
namespace App\Tracker\Answers;

/**
 * Class HandlerInterface
 * @package App\Answers
 */
interface HandlerInterface
{
    /**
     * @param Answer $answer
     * @return string
     */
    public function __invoke(Answer $answer);
}