<?php

class FlowConnect
{
	/**
	* Name of the block source of the flow
	* @var string $fromblock
	*/
	public $fromblock;

	/**
	* Name of the flow on the block source of the flow
	* @var string $fromflow
	*/
	public $fromflow;

	/**
	* Name of the block sink of the flow
	* @var string $toblock
	*/
	public $toblock;

	/**
	* Name of the flow on the block sink of the flow
	* @var string $toflow
	*/
	public $toflow;

	/**
	* Byte ordering can be "msb" or "lsb", default value is "msb"
	* @var string $order
	*/
	public $order;
	
	function __construct($xml=null)
	{
		$this->order='msb';
		if($xml) $this->parse_xml($xml);
	}
	
	protected function parse_xml($xml)
	{
		$this->fromblock = (string)$xml['fromblock'];
		$this->fromflow = (string)$xml['fromflow'];
		$this->toblock = (string)$xml['toblock'];
		$this->toflow = (string)$xml['toflow'];
		if(isset($xml['order'])) $this->order = (string)$xml['order']; else $this->order = 'msb';
	}
	
	public function getXmlElement($xml)
	{
		$xml_element = $xml->createElement("flow_connect");
		
		// fromblock
		$att = $xml->createAttribute('fromblock');
		$att->value = $this->fromblock;
		$xml_element->appendChild($att);
		
		// fromflow
		$att = $xml->createAttribute('fromflow');
		$att->value = $this->fromflow;
		$xml_element->appendChild($att);
		
		// toblock
		$att = $xml->createAttribute('toblock');
		$att->value = $this->toblock;
		$xml_element->appendChild($att);
		
		// toflow
		$att = $xml->createAttribute('toflow');
		$att->value = $this->toflow;
		$xml_element->appendChild($att);
		
		// order
		$att = $xml->createAttribute('order');
		$att->value = $this->order;
		$xml_element->appendChild($att);
		
		return $xml_element;
	}
}

?>