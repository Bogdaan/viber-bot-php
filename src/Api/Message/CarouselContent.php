<?php

namespace Viber\Api\Message;

use Viber\Api\Message;

/**
 * Carousel content as message
 *
 * @author Vladislav Sakun <vladislav.sakun@gmail.com>
 */
class CarouselContent extends Message
{
    /**
     * API version required by clients
     *
     * @var integer
     */
    protected $min_api_version = 2;

    /**
     * Number of columns per carousel content block. Default 6 columns
     *
     * @var integer
     */
    protected $ButtonsGroupColumns;

    /**
     * Number of rows per carousel content block. Default 7 columns
     *
     * @var integer
     */
    protected $ButtonsGroupRows;

    /**
     * Background color of carousel content message
     *
     * @var string
     */
    protected $BgColor;

    /**
     * Array of buttons
     *
     * @var array
     */
    protected $Buttons;

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return Type::RICH_MEDIA;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray()
    {
        return array_merge(parent::toArray(), [
            'rich_media' => [
                'Type' => $this->getType(),
                'ButtonsGroupColumns' => $this->getButtonsGroupColumns(),
                'ButtonsGroupRows' => $this->getButtonsGroupRows(),
                'BgColor' => $this->getBgColor(),
                'Buttons' => $this->getButtonsApiArray()
            ]
        ]);
    }

    /**
     * Get the value of number of columns per carousel content block.
     *
     * @return string
     */
    public function getButtonsGroupColumns()
    {
        return $this->ButtonsGroupColumns;
    }

    /**
     * Set the value of number of columns per carousel content block.
     *
     * @param integer $value
     *
     * @return self
     */
    public function setButtonsGroupColumns($value)
    {
        $this->ButtonsGroupColumns = $value;

        return $this;
    }

    /**
     * Get the value of number of rows per carousel content block
     *
     * @return string
     */
    public function getButtonsGroupRows()
    {
        return $this->ButtonsGroupRows;
    }

    /**
     * Set the value of number of rows per carousel content block
     *
     * @param integer $value
     *
     * @return self
     */
    public function setButtonsGroupRows($value)
    {
        $this->ButtonsGroupRows = $value;

        return $this;
    }

    /**
     * Get the value of background color of carousel content message
     *
     * @return string
     */
    public function getBgColor()
    {
        return $this->BgColor;
    }

    /**
     * Set the value of background color of carousel content message
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
     * Get the rich media buttons
     *
     * @return array
     */
    public function getButtons()
    {
        return $this->Buttons;
    }

    /**
     * Set the rich media buttons
     *
     * @param array $Buttons
     *
     * @return self
     */
    public function setButtons($Buttons)
    {
        $this->Buttons = $Buttons;

        return $this;
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
}
