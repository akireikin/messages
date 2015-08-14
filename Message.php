<?php
/**
 * Message.php
 *
 * @author Aleksei Akireikin <opexus@gmail.com>
 */

namespace app\core\messages;

use ReflectionClass;

/**
 * Class Message
 *
 * @package app\core\messages
 */
class Message
{
    /**
     * @var array
     */
    private $properties = [];

    /**
     * Constructor
     *
     * @param array $properties
     *
     * @throws \app\core\messages\MessageException
     */
    public function __construct(array $properties)
    {
        $names = $this->getPropertyNames();

        foreach ($names as $name) {

            if (false === isset($properties[$name])) {
                throw new MessageException('Every message property should be settled while constructing');
            }

            $this->properties[$name] = $properties[$name];
        }
    }

    /**
     * Get Class Annotations
     *
     * @see http://stackoverflow.com/questions/9742564/how-to-find-annotations-in-a-php5-object
     *
     * @return string[]
     */
    private function getClassAnnotations()
    {
        $reflectionClass = new ReflectionClass(static::class);
        $doc = $reflectionClass->getDocComment();

        // grab lines with annotations
        preg_match_all('#@(.*?)\n#s', $doc, $rawAnnotations);

        return $rawAnnotations[1];
    }

    /**
     * Is Property
     *
     * @param string $annotation
     *
     * @return bool
     */
    private function isProperty($annotation)
    {
        return 0 === strpos($annotation, 'property');
    }

    /**
     * Get Property Names
     *
     * @return array
     */
    private function getPropertyNames()
    {
        $annotations = $this->getClassAnnotations();

        $propertyAnnotations = array_filter($annotations, [$this, 'isProperty']);

        return array_map([$this, 'getPropertyName'], $propertyAnnotations);
    }

    /**
     * Get Property Name
     *
     * @param string $annotation
     *
     * @return string
     *
     * @throws \app\core\messages\MessageException
     */
    private function getPropertyName($annotation)
    {
        $parts = explode(' ', $annotation);
        foreach ($parts as $part) {
            if (0 === strpos($part, '$')) {
                return ltrim($part, '$');
            }
        }

        throw new MessageException('Every @property annotation of message object should contain ${name}.');
    }

    /**
     * Getter For All Properties
     *
     * @param $name
     *
     * @return mixed
     *
     * @throws \app\core\messages\MessageException
     */
    public function __get($name)
    {
        if (false === isset($this->properties[$name])) {
            throw new MessageException('Property $' . $name . ' does not exit.');
        }

        return $this->properties[$name];
    }
}
