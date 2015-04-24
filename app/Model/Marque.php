<?php


class Marque extends AppModel {

var $hasMany = array('Fournisseur' =>
                    array('className'    => 'Fournisseur',
                          'conditions'   => '',
                          'order'        => '',
                          'dependent'    =>  true,
                          'foreignKey'   => 'marque_id'
                    ),
                    'Chaussure' =>
                    array('className'    => 'Chaussure',
                          'conditions'   => '',
                          'order'        => '',
                          'dependent'    =>  true,
                          'foreignKey'   => 'marque_id'
                    )
              );


}


?>