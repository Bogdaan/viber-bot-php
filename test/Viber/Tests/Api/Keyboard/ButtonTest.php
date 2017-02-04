<?php

namespace Viber\Tests;

use Viber\Tests\TestCase;

/**
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class ButtonTest extends TestCase
{
    public function testToArray()
    {
        $btn = new \Viber\Api\Keyboard\Button();
        $btn
        ->setColumns(1)
        ->setRows(1)
        ->setBgColor('#000')
        ->setBgMediaType('picture')
        ->setBgMedia('https://some.url')
        ->setBgLoop(true)
        ->setActionType('reply')
        ->setActionBody('btn')
        ->setImage('https://some.url')
        ->setText('btn text')
        ->setTextVAlign('top')
        ->setTextHAlign('center')
        ->setTextOpacity(50)
        ->setTextSize('small');

        $this->assertEquals([
          'Columns' => 1,
          'Rows' => 1,
          'BgColor' => '#000',
          'BgMediaType' => 'picture',
          'BgMedia' => 'https://some.url',
          'BgLoop' => true,
          'ActionType' => 'reply',
          'ActionBody' => 'btn',
          'Image' => 'https://some.url',
          'Text' => 'btn text',
          'TextVAlign' => 'top',
          'TextHAlign' => 'center',
          'TextOpacity' => 50,
          'TextSize' => 'small',
        ], $btn->toApiArray(), "Equal Button constructor", 0.0, 1,true);
    }
}
