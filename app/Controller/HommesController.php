<?php

App::uses('AppController', 'Controller');


class HommesController extends AppController {

	public $uses = array('Chaussure','Stock','Souscategorie','User','Marque');

    public function beforeFilter() 
    {
 		//$action = $this->request->params['action'];
        parent::beforeFilter();
        $this->Auth->allow('index','sub_category');
    }
 
    	public function index(){

		$this->set('chaussures', $this->Chaussure->find('all', array(
				'conditions' => array('Chaussure.categorie' => 'Homme'),
				 'recursive' => -1,
				 'order' => array('Chaussure.date_mise_en_ligne DESC')
				)
				
			)
		);

		$optionsbtn = array(
			'label' => 'Recherche avancée',
			'a' => array(
				'class' => 'btn btn-sm btn-primary',
				)
			);

		$this->set('optionsbtn' , $optionsbtn);

		$select_souscat = $this->Souscategorie->find('list' , array(
			'fields' => array('Souscategorie.nom')));
		
		$this->set('select_souscat' , $select_souscat);

		$select_marque = $this->Marque->find('list' , array(
			'fields' => array('Marque.nom')));
		
		$this->set('select_marque' , $select_marque);


		$attributes = array('legend' => false , 'separator' => '<br />', 'default' => false);

		$this->set('attributes' , $attributes);


		if($this->request->is('post')) {

		if(isset($this->request->data['Chaussure']['souscategorie_id']))
		{
		$souscat = $this->request->data['Chaussure']['souscategorie_id'];
		}

		if(isset($this->request->data['Chaussure']['marque_id']))
		{
		$marque = $this->request->data['Chaussure']['marque_id'];
		}

		if(isset($this->request->data['Chaussure']['couleur']))
		{
		$couleur = $this->request->data['Chaussure']['couleur'];
		}

		if(!empty($souscat) AND empty($marque) AND empty($couleur))
		{
			$this->set('chaussures', $this->Chaussure->find('all', array(
				'conditions' => array('Chaussure.categorie' => 'Homme' , 'Chaussure.souscategorie_id' => $souscat),
				 'recursive' => -1
				) 
			)
		);

			$attributes = array('legend' => false , 'separator' => '<br />');

			$this->set('attributes' , $attributes);
		}

		if(!empty($marque) AND empty($souscat) AND empty($couleur))
		{
			$this->set('chaussures', $this->Chaussure->find('all', array(
				'conditions' => array('Chaussure.categorie' => 'Homme' , 'Chaussure.marque_id' => $marque),
				 'recursive' => -1
				) 
			)
		);
		}	


		if(!empty($couleur) AND empty($souscat) AND empty($marque))
		{
		$this->set('chaussures', $this->Chaussure->find('all', array(
				'conditions' => array('Chaussure.categorie' => 'Homme' , 'Chaussure.couleur' => $couleur),
				 'recursive' => -1
				)
			)
		);
		}

		if(!empty($souscat) AND !empty($marque) AND empty($couleur))
		{
		$this->set('chaussures', $this->Chaussure->find('all', array(
				'conditions' => array('Chaussure.categorie' => 'Homme' , 'Chaussure.souscategorie_id' => $souscat, 'Chaussure.marque_id' => $marque ),
				 'recursive' => -1
				)
			)
		);
		}

		if(!empty($souscat) AND !empty($couleur) AND empty($marque))
		{
		$this->set('chaussures', $this->Chaussure->find('all', array(
				'conditions' => array('Chaussure.categorie' => 'Homme' , 'Chaussure.souscategorie_id' => $souscat, 'Chaussure.couleur' => $couleur),
				 'recursive' => -1
				)
			)
		);
		}

		if(!empty($souscat) AND !empty($marque) AND  empty($couleur))
		{
		$this->set('chaussures', $this->Chaussure->find('all', array(
				'conditions' => array('Chaussure.categorie' => 'Homme' , 'Chaussure.souscategorie_id' => $souscat, 'Chaussure.marque_id' => $marque ),
				 'recursive' => -1
				)
			)
		);
		}

		if(!empty($marque) AND !empty($couleur) AND empty($souscat))
		{
		$this->set('chaussures', $this->Chaussure->find('all', array(
				'conditions' => array('Chaussure.categorie' => 'Homme' , 'Chaussure.couleur' => $couleur, 'Chaussure.marque_id' => $marque ),
				 'recursive' => -1
				)
			)
		);
		}

		if(!empty($marque) AND !empty($couleur) AND !empty($souscat))
		{
		$this->set('chaussures', $this->Chaussure->find('all', array(
				'conditions' => array('Chaussure.categorie' => 'Homme' , 'Chaussure.couleur' => $couleur, 'Chaussure.marque_id' => $marque, 'Chaussure.souscategorie_id' => $souscat),
				 'recursive' => -1
				)
			)
		);
		}
			
		}

		
	}


    public function sub_category()
 	{
 		  $action = $this->request->params['pass'];

 		  $this->set('chaussures', $this->Chaussure->find('all', array(
				'conditions' => array('Chaussure.souscategorie_id' => $action , 'Chaussure.categorie' => 'Homme'),
				'recursive' => -1
				)
			)
		);

 		  $this->set('name_souscat', $this->Souscategorie->find('all', array(
				'conditions' => array('Souscategorie.id' => $action)
				)
			)
		);


 	}




}
