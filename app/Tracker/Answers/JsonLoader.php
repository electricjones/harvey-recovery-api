<?php
namespace App\Tracker\Answers;

/**
 * Class JsonLoader
 * @package App\Answers
 */
class JsonLoader
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function load()
    {
        $json = file_get_contents($this->path);
        return json_decode($json, true);
    }
}
