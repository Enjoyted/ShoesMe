<?php


class Chaussure extends AppModel {

		public $name = 	'Chaussure';

	     public $validate = array(
        'ref' => array(
            'required' => array(
                'rule' => array('isUnique'),
                'message' => 'Votre ref est déjà utilisé'
            )
        ));
    

var $hasOne = array(
	'Stock' =>
	array('className'    => 'Stock',
		'conditions'   => '',
		'order'        => '',
		'dependent'    =>  true,
		'foreignKey'   => 'chaussure_id'
		)
	);




}


?>