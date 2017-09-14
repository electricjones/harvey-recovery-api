<?php
namespace App\Tracker\Answers;

/**
 * Class ContentMapLoader
 * @package App\Answers
 */
class ContentMapLoader
{
    /** @var string */
    private $path;

    /**
     * ContentMapLoader constructor.
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = $path;
    }

    /**
     * Loads and parses the JSON from the map
     * @return array
     */
    public function load()
    {
        $json = file_get_contents($this->path);
        return json_decode($json, true);
    }
}
