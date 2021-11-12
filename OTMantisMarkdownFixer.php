<?php

if(!class_exists('Parsedown')){
	require_once realpath(dirname(__FILE__))."/Parsedown.php";
}

class OTMantisMarkdownFixerPlugin extends MantisPlugin
{
	public function register(): void
	{
		$this->name = 'OT Mantis Markdown Fixer';
		$this->description = 'Fixes the markdown issue, adds syntax highlighting to code blocks when language is indicated.';
		$this->version = '0.0.2';
		$this->requires = [
			'MantisCore' => '2.0.0',
		];

		$this->author = 'Our Town America';
		$this->contact = 'it@ourtownamerica.com';
		$this->url = 'https://ourtownamerica.com/';
	}

	public function hooks(): array
	{
		return [
			'EVENT_DISPLAY_FORMATTED' => 'display_formatted_hook',
			'EVENT_LAYOUT_RESOURCES' => 'layout_resources_hook'
		];
	}

	public function display_formatted_hook( $p_event, $p_string, $p_multiline = true ) {
		$Parsedown = new Parsedown();
		return $Parsedown->text($p_string);
	}
	
	public function layout_resources_hook() {
		return '<link rel="stylesheet" type="text/css" href="' . plugin_file('prism.css') . '&v=' . $this->version . '" />'
				. '<script async type="text/javascript" src="' . plugin_file( 'prism.js' ) . '&v=' . $this->version . '"></script>';
	}
}
