<?php

App::uses('AppController', 'Controller');


class PagesController extends AppController {

	public $uses = array('Chaussure','Stock','Souscategorie','User','Marque');

    public function beforeFilter() 
    {
        parent::beforeFilter();
        $this->Auth->allow('home');
    }
 
	public function home() {

		$new_chaussures = $this->Chaussure->find('all', array(
					'order' => array('Chaussure.id' => 'desc'),
					'limit' => 4,
					'recursive' => -1
					));

		$this->set('new_chaussures', $new_chaussures);


		$hot_chaussures = $this->Chaussure->find('all', array(
					'order' => array('Chaussure.nbr_vente' => 'desc'),
					'limit' => 4,
					'recursive' => -1
					));

		$this->set('hot_chaussures', $hot_chaussures);
	
	}
}
