<?php

namespace model;

require_once('model/MemberRepository.php');
require_once('model/BoatRepository.php');


class BoatclubFacade{


	private $session = "session";
	private $memberRepository;
	private $boatRepository;


	public function __construct(){
		$this->memberRepository = new \model\MemberRepository();
		$this->boatRepository = new \model\BoatRepository();
	}



	public function getMembers(){
		return $this->memberRepository->getMembers();
	}


	public function getMemberById($id){
		return $this->memberRepository->getMemberById($id);
	}


	public function getBoatsByMemberId($id){
		return $this->boatRepository->getBoatsByMemberId($id);
	}


	public function addMember($member){
		$this->memberRepository->addMember($member);
	}

	public function addBoat($boat){
		$this->boatRepository->addBoat($boat);
	}

	public function updateMember($member){
		$this->memberRepository->updateMember($member);
	}


	public function deleteMember($member){
		$this->memberRepository->deleteMember($member);
	}


	public function updateBoat($boat){
		$this->boatRepository->updateBoat($boat);
	}


	public function deleteBoat($boat){
		$this->boatRepository->deleteBoat($boat);
	}


	public function sessionIsset(){
		return isset($_SESSION[$this->session]);
	}


	public function setSession($session){
		$_SESSION[$this->session] = $session;		
	}


	public function getSession(){
		if ($this->sessionIsset()) {
			return $_SESSION[$this->session];
		}
	}


	public function unsetSession(){
		unset($_SESSION[$this->session]);
	}
}