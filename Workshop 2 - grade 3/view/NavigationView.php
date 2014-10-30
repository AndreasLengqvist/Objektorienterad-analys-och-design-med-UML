<?php

namespace view;


class NavigationView{

	public static $action = 'action';
	public static $member = 'medlem';

	public static $actionShowCompact = 'visa/kompakt';
	public static $actionShowDetailed = 'visa/detaljerad';
	public static $actionShowMember = 'visa/medlem';
	public static $actionCreateMember = 'skapa/medlem';
	public static $actionEditMember = 'editera/medlem';
	public static $actionCreateBoat = 'skapa/båt';
	public static $actionEditBoat = 'editera/båt';



	// Kontrollerar vart användaren befinner sig genom att hämta aktuell action i URL:n.
	public static function getUrlAction(){
		if (isset($_GET[self::$action])) {
			return $_GET[self::$action];
		}
		return self::$actionShowCompact;
	}


	public static function RedirectToHome() {
		header('Location:  /' . \Config::$ROOT_PATH . '');
	}


	public static function RedirectToShowMember() {
		header('Location:  /' . \Config::$ROOT_PATH . '/?' . self::$action.'='.self::$actionShowMember);
	}

}