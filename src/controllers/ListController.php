<?php
/**
 * Mailchimp Subscribe plugin for Craft CMS 3.x
 *
 * Simple Craft plugin for subscribing to a MailChimp list.
 *
 * @link      https://www.vaersaagod.no
 * @copyright Copyright (c) 2017 André Elvan
 */

namespace publiq\mailjetsubscribe\controllers;

use publiq\mailjetsubscribe\MailjetSubscribe as Plugin;

use Craft;
use craft\web\Controller;

/**
 * @author    André Elvan
 * @package   MailchimpSubscribe
 * @since     2.0.0
 */
class ListController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = true;

    // Public Methods
    // =========================================================================

    /**
     * Controller action for subscribing an email to a list
     *
     * @return null|\yii\web\Response
     */
    public function actionSubscribe()
    {
        $this->requirePostRequest();
        $request = Craft::$app->getRequest();

        // get post variables
        $email = $request->getParam('email', '');
        $formListId = Plugin::getInstance()->getSettings()->listId;

        // call service method
        $result = Plugin::$plugin->mailjetSubscribe->subscribe($email, $formListId);

        // if this was an ajax request, return json
        /*if ($request->getAcceptsJson()) {
            return $this->asJson($result);
        }*/

        // if a redirect variable was passed, do redirect
        if ($redirect !== '' && $result['success']) {
            return $this->redirectToPostedUrl(array('mailjetSubscribe' => $result));
        } else {
            // set route variables and return
            Craft::$app->getUrlManager()->setRouteParams([
                'variables' => ['mailjetSubscribe' => $result]
            ]);
        }

        return null;
    }
}
