<?php
namespace App\Tracker\Answers;

/**
 * Class HtmlHandler
 * @package App\Answers
 */
class HtmlHandler implements HandlerInterface
{
    /**
     * @param Answer $answer
     * @return string
     */
    public function __invoke(Answer $answer)
    {
        return $answer->getData()['body'];
    }
}
