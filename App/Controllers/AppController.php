<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {

	public function list() {

		$this->validateLogin();

		echo 'Login Validado!';

		$tweet = Container::getModel('Tweet');
		$tweet->__set('id_users', $_SESSION['id']);
		$this->view->tweets = $tweet->getAll();

		$user = Container::getModel('user');
		$user->__set('id', $_SESSION['id']);

		$this->view->nome = $user->getInfouser();
		$this->view->total_tweets = $user->getTotaltweets();
		$this->view->seguindo = $user->getTotalSeguindo();
		$this->view->seguidores = $user->getTotalSeguidores();

		$this->render('timeline');
	}

	public function enroll() {

		$this->validateLogin();

		$tweet = Container::getModel('Tweet');

		$tweet->__set('tweet', $_POST['tweet']);
		$tweet->__set('id_users', $_SESSION['id']);

		$tweet->salvar();

		header('Location: /timeline');

		
	}

	public function validateLogin() {

		session_start();

		if(!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['name']) || $_SESSION['name'] == '') {
			header('Location: /?login=erro');
		}

		
	}

	public function acao() {

		$this->validateLogin();

		$acao = isset($_GET['acao']) ? $_GET['acao']  : '';
		$id_user_seguindo = isset($_GET['id_user']) ? $_GET['id_user']  : '';
		$nome = isset($_SESSION['pesquisar']) ? $_SESSION['pesquisar']  : '';

		$user = Container::getModel('user');
		$user->__set('id', $_SESSION['id']);

		if( $acao == 'seguir' ) {

			$user->seguiruser($id_user_seguindo);

		} else if ( $acao == 'deixar_de_seguir' ) {

			$user->deixarSeguiruser($id_user_seguindo);
			
		}

		//header('Location: /quem_seguir');
		header('Location: /quem_seguir?pesquisar='.$nome);
		
	}

}


?>