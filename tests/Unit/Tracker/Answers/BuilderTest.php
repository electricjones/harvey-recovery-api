<?php
class BuilderTest extends TestCase
{
    public function test_it_builds_personal_answers_from_responses_and_a_map()
    {
        $responses = [
            'food' => 'Yes, I need short-term supplies',
            'fema' => 'Have insurance and need contact info and reporting tips',
            'missing' => 'This should be ignored',
        ];

        $map = [
            'food' => [
                'Yes, I need short-term supplies' => [
                    'do' => [
                        [
                            'type' => 'html',
                            'body' => 'Do for needs short-term supplies'
                        ],
                        [
                            'type' => 'html',
                            'body' => 'Another do for needs short-term supplies'
                        ]
                    ],
                    'know' => [
                        [
                            'type' => 'html',
                            'body' => 'A single know for needs short term supplies'
                        ]
                    ]
                ]
            ],
            'fema' => [
                'Have insurance and need contact info and reporting tips' => [
                    'do' => [
                        [
                            'type' => 'html',
                            'body' => 'a single do for fema'
                        ]
                    ]
                ]
            ],
            '_all' => [
                'know' => [
                    [
                        'type' => 'html',
                        'body' => 'This is an all'
                    ]
                ]
            ]
        ];

        $builder = new \App\Tracker\Answers\Builder();
        $answers = $builder->build($responses, $map);

        // Test for "Do"
        $this->assertTrue(array_key_exists('do', $answers));

        $this->assertTrue($answers['do'][0] instanceof \App\Tracker\Answers\Answer);
        $this->assertTrue($answers['do'][0]->getType() === 'html');
        $this->assertTrue($answers['do'][0]->getData()['body'] === 'Do for needs short-term supplies');

        $this->assertTrue($answers['do'][1] instanceof \App\Tracker\Answers\Answer);
        $this->assertTrue($answers['do'][1]->getType() === 'html');
        $this->assertTrue($answers['do'][1]->getData()['body'] === 'Another do for needs short-term supplies');

        $this->assertTrue($answers['do'][2] instanceof \App\Tracker\Answers\Answer);
        $this->assertTrue($answers['do'][2]->getType() === 'html');
        $this->assertTrue($answers['do'][2]->getData()['body'] === 'a single do for fema');


        $this->assertTrue(array_key_exists('know', $answers));

        $this->assertTrue($answers['know'][0] instanceof \App\Tracker\Answers\Answer);
        $this->assertTrue($answers['know'][0]->getType() === 'html');
        $this->assertTrue($answers['know'][0]->getData()['body'] === 'A single know for needs short term supplies');

        $this->assertTrue($answers['know'][1] instanceof \App\Tracker\Answers\Answer);
        $this->assertTrue($answers['know'][1]->getType() === 'html');
        $this->assertTrue($answers['know'][1]->getData()['body'] === 'This is an all');
    }

    public function test_it_handles_number_conditions()
    {
        $responses = [
            'a' => '3',
            'b' => '1',
        ];

        $map = [
            'a' => [
                '>2' => [
                    'do' => [
                        [
                            'type' => 'html',
                            'body' => 'This *should* show'
                        ]
                    ]
                ]
            ],
            'b' => [
                '>2' => [
                    'do' => [
                        [
                            'type' => 'html',
                            'body' => 'This *should not* show'
                        ]
                    ]
                ]
            ],
        ];

        $builder = new \App\Tracker\Answers\Builder();
        $answers = $builder->build($responses, $map);

        $this->assertTrue(array_key_exists('do', $answers));

        $this->assertCount(1, $answers['do'], "failed to return a single answer");
        $this->assertTrue($answers['do'][0] instanceof \App\Tracker\Answers\Answer);
        $this->assertTrue($answers['do'][0]->getType() === 'html');
        $this->assertTrue($answers['do'][0]->getData()['body'] === 'This *should* show');

    }
}
