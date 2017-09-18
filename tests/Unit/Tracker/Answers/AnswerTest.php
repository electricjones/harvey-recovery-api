<?php
class AnswerTest extends TestCase
{
    public function test_it_renders_answers_using_the_HTML_handler()
    {
        $answer = \App\Tracker\Answers\Answer::from([
            'type' => 'html',
            'body' => '<b>This is some html</b>'
        ], 'know');

        $value = (string) $answer;

        $this->assertEquals('<b>This is some html</b>', $value);
    }
}
