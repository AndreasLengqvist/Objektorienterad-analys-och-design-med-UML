<?php

namespace controller;

require_once('model/BoatclubFacade.php');
require_once('view/MemberView.php');



class MemberController{

private $memberView;
private $boatclubFacade;



	public function __construct(){
		$this->boatclubFacade= new \model\BoatclubFacade();
		$this->memberView = new \view\MemberView($this->boatclubFacade);
	}



	public function createMember(){


				$member = $this->memberView->getMemberData();

				if ($member and $member->isValid()) {
					$this->boatclubFacade->addMember($member);
					return \view\NavigationView::RedirectToHome();
				}

			return $this->memberView->showCreateMember();
		}


	public function showMember(){
			$memberId = $this->boatclubFacade->getSession();
			$boats = $this->boatclubFacade->getBoatsByMemberId($memberId);
			$member = $this->boatclubFacade->getMemberById($memberId);


			// TA BORT medlem.
				if($this->memberView->deleteMember()){
					$memberId = $this->memberView->getMemberToDelete();
					$this->boatclubFacade->deleteMember($memberId);
					return \view\NavigationView::RedirectToHome();
				}

			// UPPDATERA medlem.
				$memberToUpdate = $this->memberView->getMemberToUpdate();
				if ($memberToUpdate and $memberToUpdate->isValid()) {
					$this->boatclubFacade->updateMember($memberToUpdate);
					return \view\NavigationView::RedirectToHome();
				}


			return $this->memberView->showMember($member, $boats);
		}
}