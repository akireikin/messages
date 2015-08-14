<?php
namespace core\messages;

use app\tests\codeception\_support\fakes\messages\PublicationIndexCommand;
use Codeception\TestCase\Test;

/**
 * Class MessageTest
 *
 * @package core\messages
 */
class MessageTest extends Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function test()
    {
        $fields = [
            'limit' => 4,
            'offset' => 3,
            'q' => 'something',
            'categories' => [1, 3]
        ];

        $message = new PublicationIndexCommand($fields);

        foreach ($fields as $name => $value) {
            $this->assertEquals($value, $message->{$name});
        }
    }
}
