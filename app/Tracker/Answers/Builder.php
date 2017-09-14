<?php
namespace App\Tracker\Answers;

/**
 * Class Builder
 * @package App\Answers
 */
class Builder
{
    /**
     * Build the answers from the responses and the map
     *
     * @param array $responses
     * @param array $map
     * @return array
     * @todo: refactor to reduce code duplication
     */
    public function build(array $responses, array $map)
    {
        $return = [];
        $already = [];

        // Pop of the _all
        $all = [];
        if (isset($map['_all'])) {
            $all = $map["_all"];
            unset($map["_all"]);
        }

        // Handle the answers
        foreach ($responses as $key => $response) {

            // Handle multiple responses
            if (strpos($response, '.,')) {
                $response = array_map(function($value) {
                    return rtrim($value, ".") . ".";
                }, explode('.,', $response));
            } else {
                $response = [$response];
            }

            foreach ($response as $single_response) {

                $single_response = trim($single_response);

                // Does the response qualify?
                if (array_key_exists($key, $map) && array_key_exists($single_response, $map[$key])) {

                    $sections = $map[$key][$single_response];
                    foreach ($sections as $section => $answers) {
                        // Create the Section
                        if (!array_key_exists($section, $return)) {
                            $return[$section] = [];
                            $already[$section] = [];
                        }

                        // Go through the answers and add them to the section
                        foreach ($answers as $answer) {
                            $this->addAnswer($answer, $section, $already, $return);
                        }
                    }
                }
            }
        }

        // Add the conditionals
        foreach ($map as $question => $answer) {
            if (array_key_exists($question, $responses)) {
                foreach ($answer as $condition => $sections) {
                    if (starts_with($condition, '>')) {
                        $given_number = (int) $responses[$question];
                        $check_against = (int) str_replace('>', '', $condition);

                        if ($given_number > $check_against) {
                            foreach ($sections as $section => $answers) {
                                // Create the Section
                                if (!array_key_exists($section, $return)) {
                                    $return[$section] = [];
                                    $already[$section] = [];
                                }

                                // Go through the answers and add them to the section
                                foreach ($answers as $answer) {
                                    $this->addAnswer($answer, $section, $already, $return);
                                }
                            }
                        }
                    }
                }
            }
        }

        // Now, add the "_alls" for the sections
        foreach ($map as $question => $answers) {
            foreach ($answers as $answer => $sections) {
                if ($answer === "_all") {
                    foreach ($sections as $section => $answers) {

                        if (!array_key_exists($section, $return)) {
                            $return[$section] = [];
                            $already[$section] = [];
                        }

                        foreach ($answers as $answer) {
                            $this->addAnswer($answer, $section, $already, $return);
                        }
                    }
                }
            }
        }

        // Add the global "_all"s
        foreach ($all as $section => $answers) {
            // Create the Section
            if (!array_key_exists($section, $return)) {
                $return[$section] = [];
                $already[$section] = [];
            }

            foreach ($answers as $answer) {
                $this->addAnswer($answer, $section, $already, $return);
            }
        }

        return $return;
    }

    /**
     * Adds the answer to the return array
     * @param array $answer
     * @param string $section
     * @param array $already
     * @param array $return
     */
    protected function addAnswer(array $answer, $section, array &$already, array &$return)
    {
        // Build and Add that Answer
        $answer = Answer::from($answer, $section);

        // Add that answer, if it doesn't already exist for this section
        if (!array_key_exists((string)$answer, $already[$section])) {
            $already[$section][(string)$answer] = true;
            $return[$section][] = $answer;
        }
    }
}
