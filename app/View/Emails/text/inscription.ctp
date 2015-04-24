Bonjour <?= $prenom ?>,

Merci pour votre inscription.

Vous pouvez activer votre comptre en vous rendant sur ce lien: 
<?= $this->Html->url(array('controller' => 'users', 'action' => 'activate', $id, $token), true);?>

Merci.