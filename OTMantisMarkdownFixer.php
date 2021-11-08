<?php

class OTMantisMarkdownFixerPlugin extends MantisPlugin
{
	public function register(): void
	{
		$this->name = 'OT Mantis Markdown Fixer';
		$this->description = 'Fixes the markdown issue';
		$this->version = '0.0.1';
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
			'EVENT_DISPLAY_FORMATTED' => 'display_formatted_hook'
		];
	}

	public function display_formatted_hook( $p_event, $p_string, $p_multiline = true ) {
		$p_string = str_replace('&amp;', '&', $p_string);
		$p_string = str_replace('&quot;', '"', $p_string);
		$p_string = str_replace('&lt;', '<', $p_string);
		return $p_string;
	}
}
