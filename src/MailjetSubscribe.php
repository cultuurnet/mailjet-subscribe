<?php
/**
 * Mailjet Subscribe plugin for Craft CMS 3.x
 *
 * Simple Craft plugin for subscribing to a Mailjet list.
 *
 */

namespace publiq\mailjetsubscribe;

use Craft;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;

/**
 * Class MailjetSubscribe
 *
 */
class MailjetSubscribe extends Plugin
{
    // Static Properties
    // =========================================================================

    public $hasCpSettings = true;

    /**
     * @var MailjetSubscribe
     */
    public static $plugin;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;
        
        //$this->set('mailjetSubscribe', '\publiq\mailjetsubscribe\services\MailjetSubscribeService');
        
        /*Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {

                $variable = $event->sender;
                $variable->set('mailjetSubscribe', MailjetSubscribeVariable::class);
            }
        );*/
        
    }
    
    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

    protected function settingsHtml()
    {
        return \Craft::$app->getView()->renderTemplate('structured-data/settings', [
            'settings' => $this->getSettings()
        ]);
    }

}
