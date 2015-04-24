<?php


class Fournisseur extends AppModel {

var $hasOne = array('Marque' =>
                    array('className'    => 'Marque',
                          'conditions'   => '',
                          'order'        => '',
                          'dependent'    =>  true,
                          'foreignKey'   => 'fournisseur_id'
                    )
              );

}


?>