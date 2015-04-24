Bonjour,

Vous avez demandé à regenerer votre mot de passe.

Suivez ce lien pour avoir un nouveau mot de passe :
<?= $this->Html->url(array('controller' => 'users', 'action' => 'password', $id, $token), true);?>

Merci.