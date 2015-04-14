<?php

class ctrl
{
	public function __construct()
	{
		$this->db = new Db();
	}

	public function out($tplname, $nested = false)
	{
		if ( ! $nested) {
			$this->tpl = $tplname;
			include 'tpl/main.php';
		}
		else
			include "tpl/" . $tplname;
	}
}

class App
{
	public function __construct($path)
	{
		$this->route = explode('/', $path);
		
		$this->run();
	}

	private function run()
	{
		$url = array_shift($this->route);

		if ( ! preg_match('#^[a-zA-Z0-9.,-]*$#', $url)) {
			throw new Exception('Invalid path');
		}
		$ctrlName = 'ctrl' . ucfirst($url);
		if (file_exists('app/' . $ctrlName)) {
			$this->runController($ctrlName);
		} else {
			array_unshift($this->route, $url);
			$this->runController('ctrlIndex');
		}
	}

	private function runController($ctrlName)
	{
		include 'app/' . $ctrlName . '.php';

		$ctrl = new $ctrlName();

		if (empty($this->route) || empty($this->route[0])) {
			$ctrl->index();
		} else {
			if (empty($this->route)) {
				$method = 'index';
			} else {
				$method = array_shift($this->route);
				if (method_exists($ctrl, $method)) {
					$ctrl->$method();
				} else {
					throw new Exception('Error 404');
				}
			}
		}
	}
}