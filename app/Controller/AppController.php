<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');



/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package     app.Controller
 * @link        http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

public $uses = array('Chaussure','Stock','Souscategorie','User','Marque');

    public function beforeFilter()
    {

        $souscategories = $this->Souscategorie->find('all');
        $this->set('souscategories', $souscategories);
     
        if($this->Session->check('User.Panier'))
        {
            $panier = $this->Session->read('User.Panier');
            $prixtotal = 0;
            $nbr_article = 0;
            foreach($panier as $product) // Calcul du nombre d'arcticle ainsi que du prix total
            {
                $prixtotal += $product['prix']*$product['quantity'];
                $nbr_article += $product['quantity'];
            }
            $this->set('total', $prixtotal);
            $this->set('nbr_article', $nbr_article);
            $this->set('products', $panier);
            $this->set('products', $this->Session->read('User.Panier'));
        }
        parent::beforeFilter();
        $this->Auth->allow('register','search'); // Laissons les users d'enregistrer eux-memes
    }


    public function search()
    {
        if($this->request->is('post')) {

            $search = $this->request->data['Chaussure']['nom'];;

            $this->set('result_search', $this->Chaussure->find('all', array(
                'conditions' => array('Chaussure.nom LIKE' => '%'.$search.'%'),
                'recursive' => -1
            )));

        }
    }

    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect'  => array('controller' => 'users', 'action' => 'register'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
            'authenticate' => array(
                'Form' => array(
                    'fields' => array(
                        'username' => 'email'
                    ),
                ),
            )
        )
    );
}
