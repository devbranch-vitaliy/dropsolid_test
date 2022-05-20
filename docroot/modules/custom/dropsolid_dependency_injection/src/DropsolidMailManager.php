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
    // P.S: This is an example of how to replace a standard service with
    // a custom one. But it's better to use such a solution if we want
    // to implement major changes of the service. For a similar small custom
    // fix it is better to use hook_mail() or hook_mail_alter().
    //
    // P.S.S. But a much better solution would be to use some contrib module.
    // E.g. reroute_email.
    // @see https://www.drupal.org/project/reroute_email
    $to = 'nope@doesntexist.com';
    return parent::doMail($module, $key, $to, $langcode, $params, $reply, $send);
  }

}
