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


	public function createBoat(){


			$boat = $this->memberView->getBoatData();

			if ($boat and $boat->isValid()) {
				$this->boatclubFacade->addBoat($boat);
				return \view\NavigationView::RedirectToShowMember();
			}


			return $this->memberView->showCreateBoat();
		}


	public function showMember(){


			$memberId = $this->boatclubFacade->getSession();
			$boats = $this->boatclubFacade->getBoatsByMemberId($memberId);
			$member = $this->boatclubFacade->getMemberById($memberId);

			if($this->memberView->goToCreateBoat()){
				return \view\NavigationView::RedirectToCreateBoat();
			}

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
					return \view\NavigationView::RedirectToShowMember();
				}



			// TA BORT båt.
				if($this->memberView->deleteBoat()){
					$boatId = $this->memberView->getBoatToDelete();
					$this->boatclubFacade->deleteBoat($boatId);
					return \view\NavigationView::RedirectToShowMember();
				}

			// UPPDATERA båt.
				$boatToUpdate = $this->memberView->getBoatToUpdate();
				if ($boatToUpdate and $boatToUpdate->isValid()) {
					$this->boatclubFacade->updateBoat($boatToUpdate);
					return \view\NavigationView::RedirectToShowMember();
				}

			return $this->memberView->showMember($member, $boats);
		}
}