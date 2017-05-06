<?php
/** @author Kasia (based on Luca lab)**/
require_once '/Array2XML.php';
class View{
	
	private $model;
	private $controller;

	public function __construct($controller, $model){
		$this -> controller = $controller;
		$this -> model = $model;
	}
	//function from stack overflow
	public function array_2_csv($array) {
		$csv = array();
		foreach ($array as $item) {
			if (is_array($item)) {
				$csv[] = $this ->array_2_csv($item);
			} else {
				$csv[] = $item;
			}
		}
		return implode(',', $csv);
	}
	function create_xml($array){
	 return	$xml = Array2XML::createXML('<root_node_name>', $array);
	}
	
	public function xml_encode($mixed, $domElement=null, $DOMDocument=null) {
		if (is_null($DOMDocument)) {
			$DOMDocument =new DOMDocument;
			$DOMDocument->formatOutput = true;
			$this-> xml_encode($mixed, $DOMDocument, $DOMDocument);
			echo $DOMDocument->saveXML();
		}
		else {
			if (is_array($mixed)) {
				foreach ($mixed as $index => $mixedElement) {
					if (is_int($index)) {
						if ($index === 0) {
							$node = $domElement;
						}
						else {
							$node = $DOMDocument->createElement($domElement->tagName);
							$domElement->parentNode->appendChild($node);
						}
					}
					else {
						$plural = $DOMDocument->createElement($index);
						$domElement->appendChild($plural);
						$node = $plural;
						if (!(rtrim($index, 's') === $index)) {
							$singular = $DOMDocument->createElement(rtrim($index, 's'));
							$plural->appendChild($singular);
							$node = $singular;
						}
					}

					$this-> xml_encode($mixedElement, $node, $DOMDocument);
				}
			}
			else {
				$domElement->appendChild($DOMDocument->createTextNode($mixed));
			}
		}
	}

	public function jsonOutput(){
		return (json_encode($this -> model -> output));
	}


	public function xmlOutput(){
		return($this-> create_xml($this -> model -> output));

	}

	public function csvOutput(){
		return($this-> array_2_csv($this -> model -> output));
	}

	public function textOutput() {
		return print_r($this->model->output, true);
	}
	
	public function htmlOutput() {
		return file_get_contents("static/chart.html");
	}


	public function output($outputType) {
		switch ($outputType) {
			case "application/json":
				return $this->jsonOutput();
				break;
			case "application/csv":
				return $this->csvOutput();
				break;
			case "text/plain":
				return $this->textOutput();
				break;
			case "text/html":
				return $this->htmlOutput();
				break;
			case "application/xml":
				return $this->xmlOutput();
			default:
				return "Hello!!!!!!";
		}
	}
}

?>