<?php

namespace controller;

require_once('view/ListView.php');
require_once('model/BoatclubFacade.php');



class ListController{

private $listView;
private $boatclubFacade;
private $members;



	public function __construct(){
		$this->boatclubFacade = new \model\BoatclubFacade();
		$this->listView = new \view\ListView($this->boatclubFacade);

		$this->members = $this->boatclubFacade->getMembers();
	}


	public function showCompact(){
		

		if($this->listView->goToShowMember()){
			$this->boatclubFacade->setSession($this->listView->getMemberId());
			return \view\NavigationView::RedirectToShowMember();
		}

		return $this->listView->showCompact($this->members);
	}


	public function showDetailed(){


		if($this->listView->goToShowMember()){
			$this->boatclubFacade->setSession($this->listView->getMemberId());
			return \view\NavigationView::RedirectToShowMember();
		}

		return $this->listView->showDetailed($this->members);
	}

}