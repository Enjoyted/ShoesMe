f<?php

class ChaussuresController extends AppController {

	public $uses = array('Chaussure','Stock');

	public function beforeFilter() 
	{
		parent::beforeFilter();
		$this->Auth->allow('addshoes', 'update','delete','addpointure','produit');
	}


// Systeme final pour l'ajout des chaussures

	public function addshoes(){
		
		/* On pourrait inventer un systeme pour les references. Je m'explique :
			- 1er pararm : genre. F pour femme, H pour homme, etc.
			- 2e param : la sous categorie. la on peut mettre l'id.
			- 3e param : la marque ?

			Ce qui donnerait : F2N par exemple pour une chaussure Nike de type Basket pour Femme.
			C'est juste une suggestion, la logique peut changer il faudrait juste en parler.
		*/

			if($this->request->is('post')) {

				// if($this->Chaussure->validates)
				// {
					if (is_uploaded_file($this->request->data['Chaussure']['Path']['tmp_name']))
					{
						$ext = substr($this->request->data['Chaussure']['Path']['name'], -3);
						if($ext = 'png' OR 'jpg' OR 'jpeg')
						{
							$directory = IMAGES . Chaussures . DS;

							move_uploaded_file(
								$this->request->data['Chaussure']['Path']['tmp_name'],
								$directory . $this->request->data['Chaussure']['Path']['name']
								);

							$this->request->data['Chaussure']['path'] = $this->request->data['Chaussure']['Path']['name'];



							$this->request->data['Chaussure']['date_mise_en_ligne'] = date('d-m-Y');

							if($this->Chaussure->saveAll($this->request->data['Chaussure'])) {

								$this->Session->setFlash(__('Chaussure ajoutée avec succes'));
								return $this->redirect('/admin');
							}
							else {
								echo "L'ajout ne s'est pas effectué";
							}
						
						}
						else
						{
							echo "Votre fichier n'est pas une image";
						}
					}
					else
					{
						$this->request->data['Chaussure']['date_mise_en_ligne'] = date('d-m-Y');
						$this->Chaussure->saveAll($this->request->data['Chaussure']);
						$this->Session->setFlash('Chaussure ajoutee avec succes. Pensez a ajouter une image.');
						return $this->redirect('/admin');
					}
				}
				// else
				// {
				// 	$this->Session->setFlash('La reference est deja utiliser');
				// 	return $this->redirect('/admin');
				// }
			}

// Systeme final pour l'ajout des pointures et stock


	public function addpointure(){

		if($this->request->is('post')) {

			$data = $this->request->data['Stock'];

			$data['chaussure_id'] = $this->request->data['Chaussure']['id'];

	//var_dump($data);

			if($this->Stock->save($data))
			{
				$this->Session->setFlash(__('Pointure et Stock ajoutés avec succés'));
				return $this->redirect('/admin');
			}

		}
	}
	

// Systeme d'update fonctionnel

	public function update(){
		if($this->request->is('post')) {
			$id = $this->request->data['Chaussure']['id'];
			$stock = $this->request->data['Stock']['stock'];
			$pointure = $this->request->data['Stock']['pointure'];
			$prix = $this->request->data['Chaussure']['prix'];


			if($this->Chaussure->updateAll(array('prix'=>$prix)))
			{
				$this->Session->setFlash(__('Prix mis à jour'));
				return $this->redirect('/admin');
			}

			if($this->Stock->updateAll(array('stock'=>$stock), array('chaussure_id'=>$id,'pointure' =>$pointure)))
			{
				$this->Session->setFlash(__('Stock mis a jour avec succés'));
				return $this->redirect('/admin');
			}
		}
	}

	public function updateprix()
	{
		if($this->request->is('post')) {
		$id = $this->request->data['Chaussure']['id'];
		$prix = $this->request->data['Chaussure']['prix'];


			$this->Chaussure->set(array(
                'id' => $id,
                'prix' => $prix,
                ));
            $this->Chaussure->save();
            return $this->redirect('/admin');

		}
	}


// Delete en cascade OK , delete chaussure = delete chaussure + stock

	public function delete(){
		if($this->request->is('post')) {
			$id = $this->request->data['Chaussure']['id'];

			if($this->Chaussure->delete($id)) {
				$this->Session->setFlash(__('Chaussure supprimée avec succés'));
				return $this->redirect('/admin');
			}
			else
			{
				echo 'ko';
			}
		}
	}

	public function produit(){

		$ref = $this->request->params['pass'];

		$this->set('chaussures', $this->Chaussure->find('all', array(
				'conditions' => array('Chaussure.ref' => $ref)
			)));


		$requete = $this->Chaussure->find('all', array(
				'conditions' => array('Chaussure.ref' => $ref)
			));

		$marque_id = $requete['0']['Chaussure']['marque_id'];

		$this->set('marques', $this->Marque->find('all', array(
				'conditions' => array('Marque.id' => $marque_id)
			)));


		$chaussure_id = $requete[0]['Stock']['chaussure_id'];
		
		$select = $this->Stock->find('list' , array(
			'fields' => array('Stock.pointure' , 'Stock.pointure'),
			'conditions' => array('Stock.stock >' => '0' , 'Stock.chaussure_id' => $chaussure_id)));

		$this->set('select' , $select);


	}



}


