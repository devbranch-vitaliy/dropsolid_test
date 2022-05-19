<?php

namespace Drupal\dropsolid_dependency_injection;

use Drupal\Core\Mail\MailManager;

/**
 * Override of the Mail plugin manager.
 *
 * @see \Drupal\Core\Mail\MailManager
 */
class DropsolidMailManager extends MailManager {

  /**
   * {@inheritDoc}
   */
  public function doMail($module, $key, $to, $langcode, $params = [], $reply = NULL, $send = TRUE) {
    // Always send mails to a certain e-mail address.
    //
    // Notice: This is an example of how to replace a standard service with
    // a custom one. But it's better to use such a solution if we want
    // to implement major changes. For a similar small fix it is better to use
    // hook_mail_alter().
    $to = 'nope@doesntexist.com';
    return parent::doMail($module, $key, $to, $langcode, $params, $reply, $send);
  }

}
