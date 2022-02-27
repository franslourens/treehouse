<?php
session_start();

require_once('sql.class.php');
require_once('./input/validation.class.php');
require_once('./input/input.class.php');
require_once('./input/text.class.php');
require_once('./input/submit.class.php');
require_once('submission.class.php');

class Form extends Validation  {
	private $method;
	private $action;
	private $name;
	private $elements;
	private $html;
	private $validation;
	private $errors;

	public function __construct($name= "", $method = "post", $action = "", $validation = array()) {
		$this->name = $name;
		$this->action = $action;
		$this->validation = $validation;

		if(trim(strtolower($method)) == "post" || trim(strtolower($method)) == "get") {
			$this->method = trim(strtolower($method));
		} else {
			$this->errors[] = "Form method not allowed.";
		}

	}

	public function add($element){
		$this->elements[$element->id] = $element;
	}

	private function javascript() {
		$js = '
		<script type="text/javascript">
			$(document).ready(function(){
				$("#'.$this->name.' #form_loader").hide();
				$("#'.$this->name.'")
					.validate({
						rules: '. json_encode($this->validation["rules"]) .',
						messages: '. json_encode($this->validation["messages"]) .',
						success: "valid",
						event: "blur",
						errorElement : "div",
						submitHandler: function(form){
							$("#'.$this->name.' #form_loader").show();
							form.submit();
						}
					});
			});
		</script>';

		return $js;
	}

	public function show(){
		foreach ($this->elements as $id => $input) {
			$this->html[$id] = $input->show();
		}

		$this->html['start'] = $this->start();
		$this->html['end'] = $this->end();

		return $this->html;
	}

	public function errors() {
		return $this->errors;
	}

	private function start() {
		$_SESSION['token'] = md5(uniqid(mt_rand(), true));
		$start = '<form action="'. $this->action .'" method="'. $this->method .'" id="'. $this->name.'" enctype="multipart/form-data">';
		$start .= '<input type="hidden" name="token" value="' . $_SESSION['token'] . '"/>';

		if($this->validation) {
				$start .= $this->javascript();
		}

		return $start;
	}

	private function end(){
		return '</form>';
	}

	public function save($data) {
			$token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
			if (!$token || $token !== $_SESSION['token']) {
			    header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
			    exit;
			} else {

			$submission = new Submission($data);
			$result = $submission->save();

			if(!$result) {
				$this->errors = $submission->errors;
			}
		}
	}

}
