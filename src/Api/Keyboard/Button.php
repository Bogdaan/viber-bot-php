<?php

namespace Viber\Api\Keyboard;

/**
 * Keyboard button
 * @see https://developers.viber.com/tools/keyboards/index.html
 */
class Button
{
    /**
     * Button width in columns (1-6)
     *
     * @var integer
     */
    protected $Columns = 6;

    /**
     * Button height in rows (1-2)
     *
     * @var integer
     */
    protected $Rows = 1;

    /**
     * Background color of button
     *
     * @var string
     */
    protected $BgColor;

    /**
     * Type of the background media ("picture" or "gif")
     * For picture - JPEG and PNG files are supported.
     * Max size: 500 kb
     *
     * @var string
     */
    protected $BgMediaType;

    /**
     * URL for background media content.
     * Will be placed with aspect to fill logic.
     *
     * @var string
     */
    protected $BgMedia;

    /**
     * When true - animated background media (gif) will loop continuously.
     * When false - animated background media will play once and stop.
     *
     * @var boolean
     */
    protected $BgLoop;

    /**
     * Type of action pressing the button will perform.
     * "reply" - will send a reply to the PA.
     * "open-url" - will open the specified URL and send the URL as reply to the PA.
     *
     * @see https://developers.viber.com/tools/keyboards/index.html#replyLogic
     * @var string
     */
    protected $ActionType;

    /**
     * Text for reply ActionType OR URL for "open-url".
     * For ActionType reply - text
     * For ActionType open-url - Valid URL.
     * Max length: Android - 250 characters; iOS - 100 characters
     *
     * @var string
     */
    protected $ActionBody;

    /**
     * URL of image to place on top of background (if any). Can be a partially
     * transparent image that will allow showing some of the background.
     * Will be placed with aspect to fill logic.
     *
     * Valid URL. JPEG and PNG files are supported. Max size: 500 kb
     *
     * @var string
     */
    protected $Image;

    /**
     * Text to be displayed on the button. Can contain some HTML tags.
     *
     * Free text. Valid and allowed HTML tags Max 250 characters. If the text
     * is too long to display on the button it will be cropped and ended
     * with "..."
     *
     * @var string
     */
    protected $Text;

    /**
     * Vertical alignment of the text
     *
     * Avail: top, middle, bottom
     *
     * @var string
     */
    protected $TextVAlign;

    /**
     * Horizontal align of the text
     *
     * Avail: left, center, right
     *
     * @var string
     */
    protected $TextHAlign;

    /**
     * Text opacity. Range: 0-100
     *
     * @var integer
     */
    protected $TextOpacity;

    /**
     * Text size out of 3 available options: small, regular, large
     *
     * @var string
     */
    protected $TextSize;
}
