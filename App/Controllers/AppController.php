<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {

	public function list() {

		$this->validateLogin();

		$project = Container::getModel('Project');
		$project->__set('id', $_SESSION['id']);
		$this->view->projects = $project->getAll();

		$user = Container::getModel('User');
		$user->__set('id', $_SESSION['id']);

		$this->view->nome = $user->getInfouser();
		//$this->view->total_Projects = $user->getTotalProjects();

		$this->render('list');
	}

	public function enroll() {

		$this->validateLogin();

		$project = Container::getModel('Project');

		$project->__set('project', $_POST['project']);
		$project->__set('id_users', $_SESSION['id']);

		$project->salvar();

		header('Location: /list');

		
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

		if( $acao == 'delete_project' ) {

			$user->deleteProject($id_project);

		} else if ( $acao == 'delete_stage' ) {

			$user->deleteStage($id_stage);
		}
		
		header('Location: /list');
		
	}

}


?>