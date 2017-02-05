<?php

namespace Viber\Api;

use Viber\Api\Entity;

/**
 * Message keyboard
 *
 * The keyboard can be attached to any message type or sent on it’s on.
 * Once received, the keyboard will appear to the user instead of the device’s
 * native keyboard. The client will always display the last keyboard
 * that was sent to it.
 *
 * @see https://developers.viber.com/tools/keyboards/index.html
 *
 * @author Novikov Bogdan <hcbogdan@gmail.com>
 */
class Keyboard extends Entity
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

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {
        return [
            'Type' => 'keyboard',
            'Buttons' => $this->getButtonsApiArray(),
            'BgColor' => $this->getBgColor(),
            'DefaultHeight' => $this->getDefaultHeight()
        ];
    }

    /**
     * Build buttons api array
     *
     * @return array
     */
    protected function getButtonsApiArray()
    {
        $buttons = [];
        foreach ($this->getButtons() as $i) {
            $buttons[] = $i->toApiArray();
        }
        return $buttons;
    }

    /**
     * Get the value of Array containing all keyboard buttons by order
     *
     * @return array
     */
    public function getButtons()
    {
        return $this->Buttons;
    }

    /**
     * Set the value of Array containing all keyboard buttons by order
     *
     * @param array Buttons
     *
     * @return self
     */
    public function setButtons(array $Buttons)
    {
        $this->Buttons = $Buttons;

        return $this;
    }

    /**
     * Get the value of Background color of the keyboard (HEX)
     *
     * @return string
     */
    public function getBgColor()
    {
        return $this->BgColor;
    }

    /**
     * Set the value of Background color of the keyboard (HEX)
     *
     * @param string BgColor
     *
     * @return self
     */
    public function setBgColor($BgColor)
    {
        $this->BgColor = $BgColor;

        return $this;
    }

    /**
     * Get the value of When true - the keyboard will always be displayed with the same height
     *
     * @return boolean
     */
    public function getDefaultHeight()
    {
        return $this->DefaultHeight;
    }

    /**
     * Set the value of When true - the keyboard will always be displayed with the same height
     *
     * @param boolean DefaultHeight
     *
     * @return self
     */
    public function setDefaultHeight($DefaultHeight)
    {
        $this->DefaultHeight = $DefaultHeight;

        return $this;
    }
}
