<?php

namespace ArticleBundle\Services;

Class mailService
{
	private $mailer;

	public function __construct($mailer)
	{
		$this->mailer=$mailer;
	}

	public function send($subject, $body, $mailTo, $mailFrom)
	{
		$message= \Swift_Message::newInstance();

		$message->setSubject($subject)
				->setBody($body)
				->setTo($mailTo)
				->setFrom($mailFrom);

		$this->mailer->send($message);
	}
}