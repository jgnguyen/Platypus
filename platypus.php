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
	
	public function setFor($search, $template, $searchArray, $replaceArray)
	{
		$content = "";
		foreach ($replaceArray as $r) {
			if (count($r) == count($searchArray)) {
				$i = 0;
				$temp = new Platypus($template);
				foreach ($r as $string) {
					$temp->set($searchArray[$i], $string);
					++$i;
				}
				$content .= $temp->template();
			} else {
				$this->set($search, "ERROR: Non-matching arrays in setFor!");
				return;
			}
		}
		$this->set($search, $content);
	}

	public function setIf($search, $replace, $condition)
	{
		$this->tokens[$search] = ($condition) ? $replace : '';
	}

	public function setForIf($search, $template, $searchArray, $replaceArray, $condition)
	{
		if ($condition) {
			$this->setFor($search, $template, $searchArray, $replaceArray);
		} else {
			$this->set($search, '');
		}
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
