# Annotation based immutable messages

## Problem

There are no immutability and property typehinting in PHP out of the box. 

## Usage

1. Define message structure using annotations.

```php
/**
 * @property int    $limit
 * @property        $offset
 * @property string $q
 * @property int[]  $categories
 */
class PublicationIndexCommand extends Message {}
```

2. Fullfill message with some data.

```php
$fields = [
    'limit' => 4,
    'offset' => 3,
    'q' => 'something',
    'categories' => [1, 3]
];

$message = new PublicationIndexCommand($fields);
```

3. Enjoy immutability.

```php
echo $message->q; // prints 'something'
$message->q = 'foo' // MessageException
```
