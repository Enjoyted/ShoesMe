<?php

App::uses('AppController', 'Controller');


class CommandesController extends AppController {

	public $uses = array('Chaussure','Stock','Souscategorie','User','Marque');

    public function beforeFilter() 
    {
        parent::beforeFilter();
        $this->Auth->allow();
    }
 
	public function index() {
		
	}

	public function updateadmin()
	{
		if($this->request->is('post')) {
			$id = $this->request->data['Commande']['id'];

			  $this->Commande->set(array(
                'id' => $id,
                'status' => 'Livré'
                ));
            $this->Commande->save();

            return $this->redirect('/admin');

		}
	}

	public function commander()
	{
		if($this->request->is('post')) {
			
			$CP = $this->request->data['Commande']['CP'] = $this->request->data['CP'];
			$ville = $this->request->data['Commande']['ville'] = $this->request->data['ville'];
			$payment = $this->request->data['Commande']['payment'] = $this->request->data['optionsPayment'];
			
			$panier = $this->Session->read('User.Panier');

			$items = array(); // array pour recup les id produits pour les mettre en base
			$total = 0; // prix total
			$poids = 0; // poids total
			$finish = false;

			foreach($panier as $product)
			{
				$items[] = $product['id'];
				$total += $product['prix'] * $product['quantity'];
				$poids += $product['poids'] * $product['quantity'];
			}
			$list_produits = implode(';',$items); // jimplode mon array items, histoire de concatener les id
			if($this->Session->check('Auth.User'))
			{
				$user = $this->Session->read('Auth.User');

				$data = array(
					'poids' => $poids,
					'prix' => $total,
					'user_id' => $user['id'],
					'adresse' => $this->request->data['Commande']['adresse'],
					'date_commande' => date("Y-m-d H:i:s"),
					'status' => 'en cours',
					'date_livraison' => date("Y-m-d H:i:s", strtotime('+7 days')),
					'produit_id' => $list_produits,
					'type_paiement' => $payment,
				);
				$this->Commande->save($data);
			
				$count = count($items);
				for($k=0;$k<$count;$k++)
				{
					$id = $items[$k];
					
					$find = $this->Chaussure->find('first', array(
						'conditions' => array('Chaussure.id' => $id),
						));
					
					$this->Chaussure->id = $id;

					$datas = array(
						'Chaussure' => array('id' => $id, 'nbr_vente' => $find['Chaussure']['nbr_vente'] + $panier[$k]['quantity']),
						'Stock' => array('id' => $find['Stock']['id'],  'stock' => $find['Stock']['stock'] - $panier[$k]['quantity']),
					);
					
					if($this->Chaussure->saveAssociated($datas))
					{
						$finish = true;
					}
				}

				if($finish)
				{
	        		App::uses('CakeEmail', 'Network/Email');
	                $CakeEmail = new CakeEmail('default');
	                $CakeEmail->to($user['email']);
	                $CakeEmail->subject('Votre commande a bien ete acceptee');
	                $CakeEmail->viewVars($user + array(
	                	)
	                );
	                $CakeEmail->emailFormat('text');
	                $CakeEmail->template('commande');
	                $CakeEmail->send();
					
					$this->Session->setFlash('Votre commande a correctement eté passée ! Un email vous a été envoyé.','flash',array('class' => 'success'));
					return $this->redirect(array('action' => 'finish'));
				}
				else
				{
					$this->Session->setFlash('Il y a eu une erreur. Veuillez reesayer plus tard.','flash',array('class' => 'danger'));
					return $this->redirect(array('controller' => 'paniers', 'action' => 'checkout'));
				}
			}
			else	
			{
				$data = array(
					'poids' => $poids,
					'prix' => $total,
					'user_id' => '0', // 0 pour les guest !
					'adresse' => $this->request->data['Commande']['adresse'],
					'email' => $this->request->data['Commande']['email'],
					'prenom' => $this->request->data['Commande']['prenom'],
					'nom' => $this->request->data['Commande']['nom'],
					'date_commande' => date("Y-m-d H:i:s"),
					'status' => 'en cours',
					'date_livraison' => date("Y-m-d H:i:s", strtotime('+7 days')), //tps de livraison : 7jours
					'produit_id' => $list_produits,
					'type_paiement' => $payment,
				);
				$this->Commande->save($data);

				$count = count($items);
				for($k=0;$k<$count;$k++)
				{
					$id = $items[$k];
					
					$find = $this->Chaussure->find('first', array(
						'conditions' => array('Chaussure.id' => $id),
						));

					$this->Chaussure->id = $id;
					
					$datas = array(
						'Chaussure' => array('id' => $id, 'nbr_vente' => $find['Chaussure']['nbr_vente'] + $panier[$k]['quantity']),
						'Stock' => array('id' => $find['Stock']['id'],  'stock' => $find['Stock']['stock'] - $panier[$k]['quantity']),
					);

					if($this->Chaussure->saveAssociated($datas))
					{
						$finish = true;
					}
				}

				if($finish)
				{
	        		App::uses('CakeEmail', 'Network/Email');
	                $CakeEmail = new CakeEmail('default');
	                $CakeEmail->to($this->request->data['Commande']['email']);
	                $CakeEmail->subject('Votre commande a bien ete acceptee');
	                $CakeEmail->viewVars(array(
	                	)
	                );
	                $CakeEmail->emailFormat('text');
	                $CakeEmail->template('commande');
	                $CakeEmail->send();
					$this->Session->setFlash('Votre commande a correctement ete passee ! Un email vous a ete envoye.','flash',array('class' => 'success'));
					return $this->redirect(array('action' => 'finish'));
				}
				else
				{
					$this->Session->setFlash('Il y a eu une erreur. Veuillez reesayer plus tard.','flash',array('class' => 'danger'));
					return $this->redirect(array('controller' => 'paniers', 'action' => 'checkout'));
				}
			}
		}
	}

	public function finish(){

	}
}