<?php

namespace Viber\Api;

/**
 * The keyboard can be attached to any message type or sent on it’s on.
 * Once received, the keyboard will appear to the user instead of the device’s
 * native keyboard. The client will always display the last keyboard
 * that was sent to it.
 *
 * @see https://developers.viber.com/tools/keyboards/index.html
 */
class Keyboard
{
    /**
     * Array containing all keyboard buttons by order
     * 
     * @var array
     */
    protected $Buttons;

    /**
     * Background color of the keyboard (HEX)
     *
     * @var string
     */
    protected $BgColor;

    /**
     * When true - the keyboard will always be displayed with the same height
     * as the native keyboard.When false - short keyboards will be displayed
     * with the minimal possible height. Maximal height will be native
     * keyboard height
     *
     * @var boolean
     */
    protected $DefaultHeight;
}
