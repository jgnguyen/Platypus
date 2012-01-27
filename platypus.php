<?php

class Platypus
{
	private $template;
	private $tokens;
	
	public function __construct($template)
	{
		$this->template = $template;
	}
	
	public function set($search, $replace)
	{
		$this->tokens[$search] = $replace;
	}
	
	public function template()
	{
		if (!file_exists($this->template)) {
			return "ERROR: $this->template does not exist!";
		}
		
		$screen = file_get_contents($this->template);
		
		foreach ($this->tokens as $search => $replace)
			$screen = str_replace("[[: $search :]]", $replace, $screen);
			
		return $screen;
	}	
	
	public function printHTML()
	{
		echo $this->template();
	}
	
	public function merge($platypi)
	{
		$htmlCodes = array();
		foreach ($platypi as $p) {
			if (get_class($p) == "Platypus")
				$htmlCodes[] = $p->template();
			else
				return "ERROR: Incorrect class for merge!";
		}
			
		return join($htmlCodes);
	}
}