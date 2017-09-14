<?php
namespace App\Tracker\Answers;

use App\Tracker\Answers\Handlers\HtmlHandler;

/**
 * Class Answer
 * @package App\Answers
 */
class Answer implements \JsonSerializable
{
    /** @var string */
    protected $type;

    /** @var string */
    protected $handler;

    /** @var array */
    protected $data;

    /** @var string */
    protected $section;

    /**
     * Factory to create Answer from the json blcok
     * @param array $given
     * @param string $section
     * @return Answer
     */
    public static function from(array $given, $section)
    {
        $answer = new Answer();
        $answer->setType($given['type']);
        unset($given['type']);

        $answer->setSection($section);
        $answer->setData($given);
        $answer->setHandler(new HtmlHandler());

        return $answer;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @param string $handler
     */
    public function setHandler($handler)
    {
        $this->handler = $handler;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * @param string $section
     */
    public function setSection($section)
    {
        $this->section = $section;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return (string) $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return call_user_func($this->handler, $this);
    }
}
