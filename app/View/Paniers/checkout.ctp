<ol class="breadcrumb">
    <li><a href="<?= Router::url('/'); ?>">Accueil</a></li>
    <li><a href="<?= Router::url('/'); ?>paniers/">Mon panier</a></li>
    <li class="active">Checkout</li>
</ol>
<h2 class='text-center'>Checkout du panier</h2>
<br>
<div class="form-register text-center">
    <?php 
        if($this->Session->check('Auth.User'))
        { 
            $user = $this->Session->read('Auth.User');
            echo "Merci pour votre fidelitee, ". $user['prenom'] . '! <br>';
            echo "N'oubliez pas de vous rendre sur votre page de <a href='".Router::url('/')."users'>Profil</a> si vos coordonees ont changees recemment ! :-)"
         ?>
            <div class="well well-sm title_form">Adresse de livraison</div>
            <?= $this->Form->create('Commande', array('action' => 'commander')); ?>        
            <?= $this->Form->input('prenom', array('default' => $user['prenom'] , 'placeholder' => 'Votre prenom', 'label' => 'Prenom' , 'class' => 'form-control')) ?>
            <?= $this->Form->input('nom', array('default' => $user['nom'], 'placeholder' => 'Votre nom', 'label' => 'Nom' , 'class' => 'form-control')) ?>
            <?= $this->Form->input('adresse', array('default' => $user['adresse'], 'placeholder' => 'Adresse', 'label' => 'Adresse' , 'class' => 'form-control')) ?>
            <select class="form-control" id="villes" name="ville">
                <option value="<?php echo $user['ville']; ?>"> <?php echo $user['ville']; ?> </option>
            </select>
            <select  class="form-control" id="cpostal" name="CP">
                <option value="<?php echo $user['CP']; ?>"> <?php echo $user['CP']; ?> </option>
            </select>
    
    <?php } else { ?>
    <?php echo "Si vous possedez un compte sur notre site, n'hesitez pas a vous 
                <a href='".Router::url('/')."users/login'>connecter</a> pour profiter de vos avantages ! ;) <br>" ?>

    <?php echo "Sinon, n'hesitez pas a vous en <a href='".Router::url('/')."users/register'>creer</a> un ! Ca prend deux minutes ! ;) " ?>
    <?= $this->Form->create('Commande', array('action' => 'commander')); ?>

    <div class="well well-sm title_form">Adresse de livraison</div>

    <?= $this->Form->input('prenom', array('placeholder' => 'Votre prenom', 'label' => false , 'class' => 'form-control')) ?>
    <?= $this->Form->input('nom', array('placeholder' => 'Votre nom', 'label' => false , 'class' => 'form-control')) ?>
    <?= $this->Form->input('adresse', array('placeholder' => 'Adresse', 'label' => false , 'class' => 'form-control')) ?>    
    <?= $this->Form->input('email', array('placeholder' => 'E-Mail', 'label' => false , 'class' => 'form-control')) ?>
    <select class="form-control" id="villes" name="ville">
        <option value=""> Votre ville </option>
    </select>

    <select  class="form-control" id="cpostal" name="CP">
        <option value=""> Votre code postal </option>
    </select>
    <?php } ?>
</div>

<br>
<hr>
<div class="your_order">
    <h3>Votre commande</h3>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>Produits</th>
                <th>Quantité</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($products as $product) { ?>
            <tr>
                <td><?php echo $product['nom'] . '(' . $product['pointure'] . ')' ; ?></td>
                <td><?php echo $product['quantity']; ?></td>
                <td><span><?php echo $product['prix'] * $product['quantity']; ?> €</span></td>
            </tr>
            <?php } ?>
            <tr class="subtotal">
                <td></td>
                <td><b>Livraison</b></td>
                <td>Livraison gratuite</td>
            </tr>
            <tr class="subtotal">
                <td></td>
                <td><b>Total de la commande</b></td>
                <td><?php echo $total; ?> €</td>
            </tr>
        </tbody>                            
    </table>

    <hr>
    <br>

    <h3>Mode de paiement</h3>
    <br>
    
    <div class="checkbox"><label>
        <input type="radio" name="optionsPayment" value="Visa" checked="">
        Visa
    </label></div>


    <div class="checkbox"><label>
        <input type="radio" name="optionsPayment" value="PayPal" checked="">
        PayPal <img alt="paypal" src=""> <!-- trouver une image paypal -->
    </label></div>

    <br>
        <!-- -->
        <?php if($this->Session->check('Auth.User')) { ?>
            <?php echo $this->Form->submit('Valider ma commande', array(
                'class' => 'btn btn-primary',
                )
            );
            echo $this->Form->end(); ?> 
        <?php } else { ?>
        

        <!-- Bouton sumbit si User connecter -->
        <?php   echo $this->Form->submit('Valider ma commande', array(
            'class' => 'btn btn-primary',
        )
    );
        echo $this->Form->end(); }?>
</div>

<br>


<ol class="breadcrumb">
    <li><a href="<?= Router::url('/'); ?>">Accueil</a></li>
    <li><a href="<?= Router::url('/'); ?>paniers/">Mon panier</a></li>
    <li class="active">Checkout</li>
</ol>