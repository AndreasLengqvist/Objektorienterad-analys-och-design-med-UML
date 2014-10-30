<?php

namespace view;

require_once('model/Member.php');


class MemberView{

	private $session;
	private $errorMessage;

	private static $firstname = 'firstname';
	private static $lastname = 'lastname';
	private static $persId = 'persId';
	private static $memberId = 'memberId';

	private static $boattype = 'boattype';
	private static $length = 'length';
	private static $boatId = 'boatId';


	private static $goToCreateBoat = 'goToCreateBoat';
	private static $addBoat = 'addBoat';
	private static $editBoat = 'editBoat';
	private static $deleteBoat = 'deleteBoat';

	private static $addMember = 'addMember';
	private static $deleteMember = 'deleteMember';
	private static $editMember = 'editMember';

	private static $segelbat = 'Segelbåt';
	private static $motorbat = 'Motorbåt';
	private static $motorseglare = 'Motorseglare';
	private static $kajak = 'Kajak';
	private static $ovrigt = 'Övrigt';



	public function __construct($facade){
		$this->facade = $facade;
	}


	public function addMember(){
		return isset($_POST[self::$addMember]);
	}

	public function addBoat(){
		return isset($_POST[self::$addBoat]);
	}

	public function goToCreateBoat(){
		return isset($_POST[self::$goToCreateBoat]);
	}

	public function deleteMember(){
		return isset($_POST[self::$deleteMember]);
	}

	public function editMember(){
		return isset($_POST[self::$editMember]);
	}

	public function deleteBoat(){
		return isset($_POST[self::$deleteBoat]);
	}

	public function editBoat(){
		return isset($_POST[self::$editBoat]);
	}


	public function getBoatToDelete(){
		return $_POST[self::$boatId];		
	}

	public function getMemberToDelete(){
		return $_POST[self::$memberId];		
	}

	public function getMemberData(){
		if ($this->addMember()) {
			try {
				return new \model\Member(NULL, $_POST[self::$firstname], $_POST[self::$lastname], $_POST[self::$persId]);
			} catch (\Exception $e) {
				$this->errorMessage = "<p>" . $e->getMessage() . "</p>";
			}
		}
	}


	public function getBoatData(){
		if ($this->addBoat()) {
			try {
				return new \model\Boat($this->facade->getSession(), NULL, $_POST[self::$boattype], $_POST[self::$length]);
			} catch (\Exception $e) {
				$this->errorMessage = "<p>" . $e->getMessage() . "</p>";
			}
		}
	}


	public function getMemberToUpdate(){
		if ($this->editMember()) {
			try {
				return new \model\Member($_POST[self::$memberId], $_POST[self::$firstname], $_POST[self::$lastname], $_POST[self::$persId]);
			} catch (\Exception $e) {
				$this->errorMessage = "<p>" . $e->getMessage() . "</p>";
			}
		}
	}


	public function getBoatToUpdate(){
		if ($this->editBoat()) {
			try {
				return new \model\Boat($_POST[self::$memberId], $_POST[self::$boatId], $_POST[self::$boattype], $_POST[self::$length]);
			} catch (\Exception $e) {
				$this->errorMessage = "<p>" . $e->getMessage() . "</p>";
			}
		}
	}

	public function showMember(\model\Member $member, \model\Boats $boats){

		$memberId = $member->getMemberId();

		$ret = "
					<h1>Den glade piraten</h1>
					<a id='navbutton' href='?'>Tillbaks</a><br>

					<h2>" . $member->getFirstname() . " " .  $member->getLastname() . "</h1>
					<div class='member_div'>

					<form method='post'>
						<input type='submit' value='Ta bort medlem' name='" . self::$deleteMember . "'>
						<input type='hidden' value='" . $memberId . "' name='" . self::$memberId . "'>
						<div>
							<label for='firstname'>Förnamn</label>
						</div>
						<div>
							<input id='firstname' type='text' name='" . self::$firstname . "' value='" . $member->getFirstname() . "'>
						</div>
						<div>
							<label for='lastname'>Efternamn</label>
						</div>
						<div>
							<input id='lastname' type='text' name='" . self::$lastname . "' value='" . $member->getLastname() . "'>
						</div>
						<div>
							<label for='persId'>Personnummer</label>
						</div>
						<div>
							<input id='persId' type='text' name='" . self::$persId . "' value='" . $member->getPersId() . "'>
						</div>
						<div>
							<input type='submit' value='Redigera medlem' name='" . self::$editMember . "'>
						</div>
					</form>
				";

		foreach ($boats->getBoats() as $boat) {
			$boatId = $boat->getBoatId();
			$ret .= "	
						<form method='post'>
							<input type='hidden' value='" . $boatId . "' name='" . self::$boatId . "'>
							<input type='hidden' value='" . $memberId . "' name='" . self::$memberId . "'>
						<ul>
						<li>Båt: " . $boatId . "</li>
							<ul>
								<div>
									<label for='boattype'>Båttyp</label>
								</div>
								<div>
									<input id='boattype' type='text' name='" . self::$boattype . "' value='" . $boat->getBoattype() . "'>
								</div>
								<div>
									<label for='length'>Längd</label>
								</div>
								<div>
									<input id='length' type='text' name='" . self::$length . "' value='" . $boat->getLength() . "'>m
								</div>
							</ul>
						</ul>
						<input type='submit' value='Redigera båt' name='" . self::$editBoat . "'>
						<input type='submit' value='Ta bort båt' name='" . self::$deleteBoat . "'>
						</form>
					";
		}

		$ret .= "	
						<form method='post'>
							<input type='submit' value='Lägg till ny båt' name='" . self::$goToCreateBoat . "'>
						</div>
						</form>
					</div>


				";

		return $ret;
	}


	public function showCreateMember(){

		$errorMessage = $this->errorMessage;

		$ret = "
					<h1>Den glade piraten</h1>
					<a id='navbutton' href='?'>Tillbaks</a><br>

					<h2>Skapa medlem</h1>

					$errorMessage

					<form method='post'>
						<div>
							<label for='firstname'>Förnamn</label>
						</div>
						<div>
							<input id='firstname' type='text' name='" . self::$firstname . "'>
						</div>
						<div>
							<label for='lastname'>Efternamn</label>
						</div>
						<div>
							<input id='lastname' type='text' name='" . self::$lastname . "'>
						</div>
						<div>
							<label for='persId'>Personnummer</label>
						</div>
						<div>
							<input id='persId' type='text' name='" . self::$persId . "'>
						</div>

	    				<div>
							<input class='continueButton' type='submit' value='Skapa' name='" . self::$addMember . "'>
						</div>
					</form>

				";

		return $ret;
	}


	public function showCreateBoat(){

		$errorMessage = $this->errorMessage;

		$ret = "
					<h1>Den glade piraten</h1>
					<a id='navbutton' href='?'>Tillbaks</a><br>

					<h2>Skapa båt</h1>

					$errorMessage

					<form method='post'>
						<div>
							<label for='boattype'>Båttyp</label>
						</div>
						<div>
							<input id='boattype' type='text' name='" . self::$boattype . "'>
						</div>
							<label for='length'>Längd</label>
						</div>
						<div>
							<input id='length' type='text' name='" . self::$length . "'>m
						</div>
						<input class='continueButton' type='submit' value='Skapa' name='" . self::$addBoat . "'>
					</form>
				";

		return $ret;
	}
}