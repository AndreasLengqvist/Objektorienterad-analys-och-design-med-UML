<?php

namespace controller;

require_once('controller/BoatController.php');
require_once('controller/MemberController.php');
require_once('controller/ListController.php');
require_once('view/NavigationView.php');

// http://yuml.me/50cb5134

class NavigationController{



	public function doNavigation(){

	// Hanterar navigering av alla kontrollrar.
		try {

			switch (\view\NavigationView::getUrlAction()) {


				// Lista kompakt.
				case \view\NavigationView::$actionShowCompact:
					$controller = new ListController();
					return $controller->showCompact();
				break;

				// Lista detaljerad.
				case \view\NavigationView::$actionShowDetailed:
					$controller = new ListController();
					return $controller->showDetailed();
				break;

				// Visa medlem.
				case \view\NavigationView::$actionShowMember:
					$controller = new MemberController();
					return $controller->showMember();
				break;
				
				// Skapa ny medlem.
				case \view\NavigationView::$actionCreateMember:
					$controller = new MemberController();
					return $controller->createMember();
				break;
				

				// Skapa båt.
				case \view\NavigationView::$actionCreateBoat:
					$controller = new MemberController();
					return $controller->createBoat();
				break;


				default:
					return \view\NavigationView::actionShowCompact();
				break;
			}

		} catch (Exception $e) {
			echo $e;
			die();
		}
	}
}