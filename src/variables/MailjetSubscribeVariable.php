<?php

namespace publiq\mailjetsubscribe\variables;

use publiq\mailjetsubscribe\MailjetSubscribe as Plugin;


/**
 * @author    André Elvan
 * @package   MailchimpSubscribe
 * @since     2.0.0
 */
class MailjetSubscribeVariable
{
    // Public Methods
    // =========================================================================

    /**
     * Check if email is subscribed to list
     *
     * @param string $email
     * @param null $listId
     *
     * @return array|mixed
     */
    public function checkIfSubscribed($email, $listId = null)
    {
        return Plugin::$plugin->mailjetSubscribe->checkIfSubscribed($email, $listId);
    }

}
