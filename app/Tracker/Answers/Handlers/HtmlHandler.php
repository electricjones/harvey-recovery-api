<?php
namespace App\Tracker\Answers\Handlers;

use App\Tracker\Answers\Answer;

/**
 * Class HtmlHandler
 * @package App\Answers
 */
class HtmlHandler implements HandlerInterface
{
    /**
     * This class is callable. It will return the markup for the answer
     * @param Answer $answer
     * @return string
     */
    public function __invoke(Answer $answer)
    {
        return $answer->getData()['body'];
    }
}
