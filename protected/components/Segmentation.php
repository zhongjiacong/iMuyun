<?php
/**
 * split the sentence to words
 */
class Segmentation {
	protected $so;
	private static $instance;
	
	private function __construct() {
		$this->so = scws_new();
		$this->so->set_charset('utf8');   // default charset
	}
	
	// singleton pattern
	static public function getInstance() {
		if(!isset(self::$instance)) {
			$c = __CLASS__;
			self::$instance = new $c;
		}
		return self::$instance;
	}
   
	// prohibit user copy object instance
	public function __clone() {
		trigger_error('Clone is not allowed.', E_USER_ERROR);
	}
   
	// get the segmentation results(array form)
	public function getWords($text) {
		$this->so->send_text($text);
		$result = array();
		while($tmp = $this->so->get_result()) {
			$result[] = $tmp;
		}
		return $result;
	}
   
	public function setCharset($charset) {
		$this->so->set_charset($charset);
	}

	public function __destruct() {
		$this->so->close();
	}
}