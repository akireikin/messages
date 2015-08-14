<?php
/**
 * PublicationIndexCommand.php
 *
 * @author Aleksei Akireikin <opexus@gmail.com>
 */

namespace app\tests\codeception\_support\fakes\messages;

use app\core\messages\Message;

/**
 * Class PublicationIndexCommand
 *
 * @property int    $limit
 * @property        $offset
 * @property string $q
 * @property int[]  $categories
 *
 * @package app\tests\codeception\_support\fakes\messages
 */
class PublicationIndexCommand extends Message {}
