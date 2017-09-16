<?php
/*
 * Initialize our system
*/
require 'app/init.php';

$userInput = json_decode(file_get_contents('php://input'), true);

$user = new Users($userInput["message"]["chat"]["id"]);

switch ($user->getStatus()) { 
	case '0': //Activatiecode dient te worden ingevoerd
		new StartCommand($user->getChatId(), $userInput["message"]["text"]);

		//Check if activation token is right
		new TokenCommand($user->getChatId(), $userInput["message"]["text"]);
		break;
	
	case '1':
	//new ZermeloInstituteCommand //submit de zermelo institute

		break;

	case '2':
	//new ZermeloTokenCommand //submit de zermelo token EN wissel deze om naar een API key, store de api key
		
		break;

	case '3':
		new NicknameCommand($user->getChatId(), $userInput["message"]["text"]);
		break;

}

switch ($user->getRank()) {
	case '2':
		//moderator
		break;
	
	case '3':
		//admin
		new AlertCommand($user->getChatId(), $userInput["message"]["text"]);
		new LockdownCommand($user->getChatId(), $userInput["message"]["text"]);
		break;
}


