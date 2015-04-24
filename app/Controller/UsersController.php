<?php
/*
    Beaucoup de choses a voir sur les redirections,
    Ainsi que sur les messages de succes/errors.
*/

    class UsersController extends AppController{

        public function beforeFilter() 
        {
            parent::beforeFilter();
            $this->Auth->allow('register', 'logout', 'login', 'activate', 'forgot', 'password');
        }

        public function register(){
            if ($this->Session->read('Auth.User.id')){
                return $this->redirect(array('action' => 'index'));
        } // on vérifie si l'utilisateur est bien connecté, si l'utilisateur est connecté et essaie de aller sur la page inscription on le redirige sur la page users/index

        if (!empty($this->request->data)) {
            $this->User->create($this->request->data);
            if ($this->User->validates()) {

                $token = md5(uniqid(rand(), true)); //je crée un token unique pour l'utilisateur
                $user_ip = htmlspecialchars($_SERVER['REMOTE_ADDR']);//je récupére l'ip de l'utilisateur

                $this->User->create(array(
                    'username' => $this->request->data['User']['username'],
                    'email' => $this->request->data['User']['email'],
                    'password' => $this->request->data['User']['password'],
                    'nom' => $this->request->data['User']['nom'],
                    'prenom' => $this->request->data['User']['prenom'],
                    'ville' => $this->request->data['ville'],
                    'CP' => $this->request->data['CP'],
                    'adresse' => $this->request->data['User']['adresse'],
                    'sexe' => $this->request->data['sexe'],
                    'birthday' => $this->request->data['User']['birthday'],
                    'token' => $token,
                    )
                );

                $this->User->save();//je sauvegarde les donnés dans la bdd
                App::uses('CakeEmail', 'Network/Email');// email de confirmation pour l'inscription
                $CakeEmail = new CakeEmail('default');
                $CakeEmail->to($this->request->data['User']['email']);
                $CakeEmail->subject('Nouveau compte ShoesMe');
                $CakeEmail->viewVars($this->request->data['User'] + array(
                 'token' => $token,
                 'id' => $this->User->id
                 )
                );
                //j'envoie tout ce que l'utilisateur à rentrer dans le form et aussi le token et l'id de l'utilisateur
                $CakeEmail->emailFormat('text');
                $CakeEmail->template('inscription');
                $CakeEmail->send();

                $this->Session->setFlash('Merci, vous êtes inscrit. Veuillez vérifier votre boîte mail pour activer votre compte.', 'flash', array('class' => 'success'));//j'envoie un message de confirmation si tout se passe bien
            } else {
                $this->Session->setFlash('Veuillez vérifier votre formulaire.', 'flash', array('class' => 'danger'));//j'envoie un message d'erreur si y a des erreurs dans le formulaire d'inscription
            }
        }
    }

    public function activate($user_id, $token){
        $user = $this->User->find('first',array(
            'conditions' => array('id' => $user_id, 'token' => $token)
            )
        ); 
        if (empty($user)) {
            $this->Session->setFlash("Ce lien n'est pas valide", 'flash', array('class' => 'danger'));
            return $this->redirect('/');
        }
        $this->Session->setFlash('Votre compté a été activé. Veuillez vous connecter.', 'flash', array('class' => 'success'));

        $this->User->save(array(
            'id'        =>      $user['User']['id'],
            'email_confirmed'    =>      1,
            'token'     =>      ''
            )
        );
        $this->Session->setFlash("Votre compte à été activé. Veuillez vous connecter.", 'flash', array('class' => 'success'));
        return $this->redirect(array('action' => 'login'));
    }

    public function login()
    {
        if (isset($_SESSION['Auth']['User'])) {
            return $this->redirect(array('action' => 'index'));
        } // on vérifie si l'utilisateur est bien connecté, si l'utilisateur est connecté et essaie de aller sur la page login on le redirige sur la page users/index

        if($this->request->is('post'))
        {
            if($this->Auth->login()) 
            {
                if($this->Auth->user('rank') == 1)
                {
                    return $this->redirect(array('controller' => 'admins', 'action' => 'index'));
                }
                elseif($this->Auth->user('email_confirmed') == '1')
                {
                    $this->Session->setFlash('Bienvenue, vous êtes connecté.', 'flash', array('class' => 'success'));
                   return $this->redirect(array('action' => 'index'));
                }
                else
                {
                    $this->Session->setFlash('Votre compte n\'est pas active, veuillez verifier vos mails.', 'flash', array('class' => 'danger'));
                    return $this->redirect(array('action' => 'logout'));
                }
            } 
            else 
            {
                $this->Session->setFlash('Login ou mot de passe incorrects.', 'flash', array('class' => 'danger'));
                // return $this->redirect(array('action' => 'login'));
            }
        }
    }

    public function forgot(){
        if (!empty($this->request->data)) {
            $user = $this->User->findByEmail($this->request->data['User']['email'], array('id'));
            if (empty($user)) {
                $this->Session->setFlash("Cet adresse mail n'est associé à aucun compte", 'flash', array('class' => 'danger'));
            } else{
                $token = md5(uniqid(rand(), true)); //je crée un token unique pour l'utilisateur

                $this->User->id = $user['User']['id'];
                $this->User->saveField('token',$token);

                App::uses('CakeEmail', 'Network/Email');// email de confirmation pour l'inscription
                $CakeEmail = new CakeEmail('default');
                $CakeEmail->to($this->request->data['User']['email']);
                $CakeEmail->subject('Regeneration de votre mot de passe');
                $CakeEmail->viewVars(array(
                 'token' => $token,
                 'id' => $this->User->id
                 )
                );//j'envoie tout ce que l'utilisateur à rentrer dans le form et aussi le token et l'id de l'utilisateur
                $CakeEmail->emailFormat('text');
                $CakeEmail->template('password');
                $CakeEmail->send();
                
                $this->Session->setFlash("Un email vous a été envoyé. Veuillez vérifier votre boite mail pour regenerer votre mot de passe.", 'flash', array('class' => 'success'));
            }
        }
    }

    public function password($user_id, $token){
        $user = $this->User->find('first', array(
            'fields'    => array('id'),
            'conditions'    => array('id' => $user_id, 'token' => $token)
            )
        );
        if (empty($user)) {
            $this->Session->setFlash("Ce lien n'est pas valide", 'flash', array('class' => 'danger'));
            return $this->redirect(array('action' => 'forgot'));
        }
        if (!empty($this->request->data)) {
            $this->User->create($this->request->data);
            if ($this->User->validates()) {
                
                $this->User->create();

                $this->User->save(array(
                    'id'    =>  $user['User']['id'],
                    'token' =>  '',
                    // 'active'    =>      1,
                    'password' => $this->Auth->password($this->request->data['User']['password'])
                    )
                );
                $this->Session->setFlash("Votre mot de passe à été modifié avec succès.", 'flash', array('class' => 'success'));
                return $this->redirect(array('action' => 'login'));
            }
        }
    }

    public function edit()
    {
        $get_auth = $_SESSION['Auth']['User'];

        $user = $this->User->find('first', array(
            'conditions' => array('id' => $get_auth['id'])
            ));

        if($this->request->is('post'))
        {
            $this->User->id = $get_auth['id']; 
            // Je get son ID pour edit l'user, et pas en cree un autre
            $this->User->set(array(
                'id' => $get_auth['id'],
                'nom' => $this->request->data['User']['nom'],
                'prenom' => $this->request->data['User']['prenom'],
                'adresse' => $this->request->data['User']['adresse'],
                ));
            $this->User->save();

            $userid = $this->Auth->user('id');
            $this->Session->write('Auth',$this->User->read(null,$userid)); 
            // Je fais ca pour rewrite la SESSION, tres important

            $this->Session->setFlash('Données modifiées avec succès !', 'flash', array('class' => 'success'));
            return $this->redirect(array('action' => 'edit'));
        }   
    }

    public function editUsername()
    {
        $get_auth = $_SESSION['Auth']['User'];
        if($this->request->is('post'))
        {
            $username = $this->request->data['User']['username'];

            $find = $this->User->find('count', array(
                'conditions' => array('username' => $username),
                'fields'     => 'username'
                )
            );

            if($find == '0') // Username pas pris, on change donc
            {
                $this->User->id = $get_auth['id'];
                $this->User->set(array('username' => $this->request->data['User']['username']));
                $this->User->save();

                $userid = $this->Auth->user('id');
                $this->Session->write('Auth',$this->User->read(null,$userid)); 

                $this->Session->setFlash("<p style='color:green'>Votre username a correctement ete changer !</p>");
                return $this->redirect(array('action' => 'edit'));
            } 
            else // Username deja pris, on lui demande d'en prendre un autre
            {
                $this->Session->setFlash("<p style='color:red'>L'username specifie est deja pris. Veuillez en choisir un autre.</p>");
                return $this->redirect(array('action' => 'edit'));
            }
        }
    }

    public function editEmail()
    {
        $get_auth = $_SESSION['Auth']['User'];
        if($this->request->is('post'))
        {
            $email = $this->request->data['User']['email'];

            $find = $this->User->find('count', array(
                'conditions' => array('email' => $email),
                'fields'     => 'email'
                )
            );

            if($find == '0') // Email pas pris, on change donc
            {
                $this->User->id = $get_auth['id'];
                $this->User->set(array('email' => $this->request->data['User']['email']));
                $this->User->save();

                $userid = $this->Auth->user('id');
                $this->Session->write('Auth',$this->User->read(null,$userid)); 

                $this->Session->setFlash("<p style='color:green'>Votre E-Mail a correctement ete changer !</p>");
                return $this->redirect(array('action' => 'edit'));
            } 
            else // Email deja pris, on lui demande d'en prendre un autre
            {
                $this->Session->setFlash("<p style='color:red'>L'E-Mail specifie est deja pris. Veuillez en choisir un autre.</p>");
                return $this->redirect(array('action' => 'edit'));
            }
        }
    }

    public function newsLetter()
    {
        /* Alors la comment je vois les choses :
            - L'user clique sur un bouton newsletter,
            - Je recup son e-mail,
            - Je le stock dans une table(qui sappelle genre newsletter_users) (mon avis perso)
            - Qd l'admin fait une newsletter, il Mail() a toute la liste de mail en BDD.

            Ca me semble pas mal. Bon biensur, je fais des verifs :
                - Le mec est bien connecter ( sinon il voit pas le bouton )
                - Je verifie que l'E-Mail est pas deja present en BDD (ds le cas ou il s'est deja inscrit a la newsletter)
                - D'autres trucs peut etre? Auxquels je pense pas.


            A voir ensemble, donc. (par ailleurs, il faudra je pense, une action newsletter ds controller Admin)
         */
        $user_email = $_SESSION['Auth']['User']['email']; // Je recupere l'email en session de la personne
        $find = $this->User->find('count', array(
            'conditions' => array('email' => $user_email),
            'fields'     => 'email'
            )
        );
        if($find == '0')
        {
            // J'add son mail a la BDD
        }
        else
        {
            // Je lui dis qu'il est probablement deja inscrit a la newsletter
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    /* Fin des fonctions pour l'user */


    public function index(){
        /* Que mettre ici? Ca serait la page de base du site, a voir */
    }

    public function historique(){
        
    }

}