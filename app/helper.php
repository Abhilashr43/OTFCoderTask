<?php
if (!function_exists('pdf')) {
	function pdf()
	{
		return new PDFParser();
	}
}

if (!function_exists('null_check')) {
	function null_check($string)
	{
		return (!isset($string) || trim($string) == '');
	}
}

class PDFParser
{
	public function parseFile($file)
	{
	}
}
