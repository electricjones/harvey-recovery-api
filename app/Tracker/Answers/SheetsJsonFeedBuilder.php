<?php
namespace App\Tracker\Answers;

/**
 * Class SheetsJsonFeedBuilder
 * @package App\Answers
 */
class SheetsJsonFeedBuilder
{
    /** @var string */
    protected $sheet_id;

    /** @var string  */
    protected $base_url = 'https://spreadsheets.google.com/feeds/list/{sheet_id}/od6/public/values?alt=json';

    /** @var \Parsedown */
    protected $parsedown;

    public function updateJsonFile($destination_path)
    {
        $content = $this->getSheetContent();
        $data = $this->parseSheetContent($content);
        $built = $this->buildJsonData($data);
        $this->saveJsonFile($built, $destination_path);
    }

    private function getSheetContent()
    {
        return json_decode(
            str_replace('$', '', file_get_contents(
                $this->getSheetUrl()
            )),
            true
        );
    }

    private function parseSheetContent($content)
    {
        $columns_of_interest = [
            'gsxalwaysdisplay' => 'always',
            'gsxdoknowmore' => 'section',
            'gsxqualtricsquestionsection' => 'question',
            'gsxswitch' => 'answer',
            'gsxtextmarkdownthatwilldisplaymustnotbeblankformsmustberightorwillshowerror' => 'body'
        ];

        $parsed = [];
        $row_id = 0;
        foreach ($content['feed']['entry'] as $row) {
            foreach ($row as $cell => $value) {
                if (!array_key_exists($row_id, $parsed)) {
                    $parsed[$row_id] = [];
                }

                if (array_key_exists($cell, $columns_of_interest)) {
                    $parsed[$row_id][$columns_of_interest[$cell]] = $value['t'];
                }
            }
            $row_id++;
        }

        return $parsed;
    }

    private function saveJsonFile($data, $destination_path)
    {
        file_put_contents($destination_path, json_encode($data));
    }


    /**
     * @return string
     */
    protected function getSheetUrl()
    {
        return str_replace('{sheet_id}', $this->getSheetId(), $this->getBaseUrl());
    }

    /**
     * @param string $base_url
     * @return SheetsJsonFeedBuilder
     */
    public function setBaseUrl($base_url)
    {
        $this->base_url = $base_url;
        return $this;
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->base_url;
    }

    /**
     * @param string $sheet_id
     * @return SheetsJsonFeedBuilder
     */
    public function setSheetId($sheet_id)
    {
        $this->sheet_id = $sheet_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getSheetId()
    {
        return $this->sheet_id;
    }

    /**
     * @param array $data
     * @return array
     */
    private function buildJsonData(array $data)
    {
        $built = [];
        foreach ($data as $row) {

            // Create the html
            $body = $row['body'];
            $body = str_replace('] (', '](', $body);
            $html_body = $this
                ->getParsedown()
                ->text($body);

            $clean_body = str_replace('<p>', '', $html_body);
            $clean_body = str_replace('</p>', '', $clean_body);

            $entry = [
                'type' => 'html',
                'body' => $clean_body
            ];

            // Is this always to be displayed?
            if ($row['always'] === "1") {
                $built['_all'][strtolower($row['section'])][] = $entry;
                continue;
            }

            if ($row['question'] === "") {
                continue;
            }

            // Add to the json file
            $built
                [$row['question']]
                    [str_replace('/', '', $row['answer'])]
                        [strtolower($row['section'])][] = $entry;
        }

        return $built;
    }

    private function getParsedown()
    {
        if (!$this->parsedown) {
            $this->parsedown = new \Parsedown();
        }

        return $this->parsedown;
    }
}
