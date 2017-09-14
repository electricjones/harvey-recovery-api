<?php
class AnswersTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_it_deals_with_the_json_answers()
    {
        $responses = [
            'food' => 'Yes, I need short-term supplies',
            'fema' => 'Have insurance and need contact info and reporting tips',
            'missing' => 'This should be ignored',
        ];

        $map = (new \App\Tracker\Answers\ContentMapLoader(__DIR__ . '/../../content.en.json'))->load();

        $builder = new \App\Tracker\Answers\Builder();
        $answers = $builder->build($responses, $map);

        $this->assertTrue(array_key_exists('do', $answers));
        $this->assertTrue(array_key_exists('know', $answers));

        $this->assertTrue($answers['do'][1] instanceof \App\Tracker\Answers\Answer);
        $this->assertTrue($answers['do'][1]->getType() === 'html');
        $this->assertTrue($answers['do'][1]->getData()['body'] === 'If <strong>your home is flooded</strong> the first thing you should do is <a href="https://stationhouston.zendesk.com/hc/en-us/articles/115001746874" target="_blank">register with FEMA</a>, even if you do not need housing. They will have disaster relief funds you may be entitled to. Next, please <a href="https://stationhouston.zendesk.com/hc/en-us/articles/115001820393" target="_blank">follow this guide</a> to begin the recovery process.');
    }

    public function test_it_renders_answers()
    {
        $answer = \App\Tracker\Answers\Answer::from([
            'type' => 'html',
            'body' => '<b>This is some html</b>'
        ], 'know');

        $value = (string) $answer;

        $this->assertEquals('<b>This is some html</b>', $value);
    }
}
