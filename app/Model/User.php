<?php

App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel{


    public $name = 'User';
    
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Un nom d\'utilisateur est requis'
            ),
            'length' => array(
                'rule' => array('between', 5, 20),
                'message' => 'Votre username doit contenir entre 5 et 20 caracteres !'
            ),
            'unique' => array(
                'rule' => array('isUnique'),
                'message' => 'Votre nom d\'utilisateur est déjà pris.'
            ),
        ),
        'email' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Une adresse mail est requise'
            ),
            'isEmail' => array(
                'rule' => array('email'),
                'message' => 'Votre email est incorrect. Ex : martin@cacao.fr'
            ),
            'unique' => array(
                'rule' => array('isUnique'),
                'message' => 'L\'adresse email que vous avez fournie est déjà prise.'
            ),
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Veuillez preciser un mot de passe'
            )
        ),
    );
    
    public function beforeSave($options = array()) {
            if (!$this->id) {
                $passwordHasher = new SimplePasswordHasher();
                $this->data['User']['password'] = $passwordHasher->hash($this->data['User']['password']);
            }
            return true;
        }

    }