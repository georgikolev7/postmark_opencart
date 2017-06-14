<?php

require_once(DIR_HOME . 'vendors/postmark/autoload.php');

use Postmark\PostmarkClient;
use Postmark\Models\PostmarkException;

class Mail {
	protected $to;
	protected $from;
	protected $sender;
	protected $reply_to;
	protected $subject;
	protected $text;
	protected $html;
	protected $attachments = array();
	public $protocol = 'mail';
	public $smtp_hostname;
	public $smtp_username;
	public $smtp_password;
	public $smtp_port = 25;
	public $smtp_timeout = 5;
	public $newline = "\n";
	public $verp = false;
	public $parameter = '';

	public function __construct($config = array()) {
		foreach ($config as $key => $value) {
			$this->$key = $value;
		}
	}

	public function setTo($to) {
		$this->to = $to;
	}

	public function setFrom($from) {
		$this->from = $from;
	}

	public function setSender($sender) {
		$this->sender = $sender;
	}

	public function setReplyTo($reply_to) {
		$this->reply_to = $reply_to;
	}

	public function setSubject($subject) {
		$this->subject = $subject;
	}

	public function setText($text) {
		$this->text = $text;
	}

	public function setHtml($html) {
		$this->html = $html;
	}

	public function addAttachment($filename) {
		$this->attachments[] = $filename;
	}

	public function send() {
		if (!$this->to) {
			trigger_error('Error: E-Mail to required!');
			exit();
		}

		if (!$this->from) {
			trigger_error('Error: E-Mail from required!');
			exit();
		}

		if (!$this->sender) {
			trigger_error('Error: E-Mail sender required!');
			exit();
		}

		if (!$this->subject) {
			trigger_error('Error: E-Mail subject required!');
			exit();
		}

		if ((!$this->text) && (!$this->html)) {
			trigger_error('Error: E-Mail message required!');
			exit();
		}

		if (is_array($this->to)) {
			$to = implode(',', $this->to);
		} else {
			$to = $this->to;
		}

		try {
			$client = new PostmarkClient(POSTMARK_SERVER_API);
			$html = is_null($this->html);
			$key = ($html) ? 'TextBody' : 'HtmlBody';
			
			$message = [
			  'To' => 'petkov@windowslive.com',
			  'From' => $this->from,
			  'TrackOpens' => true,
			  'Subject' => $this->subject,
			  $key => ($key == 'TextBody') ? $this->text : $this->html,
			];
			
			$sendResult = $client->sendEmailBatch([$message]);
			
		} catch(PostmarkException $ex) {
			
			echo $ex->httpStatusCode;
			echo $ex->message;
			echo $ex->postmarkApiErrorCode;
			
		} catch(Exception $generalEx) {
		}
	}
}