<?php

class AjaxController extends AppController{

    public $uses = array('Departement','Region', 'Ville');

    public function beforeFilter() 
    {
        parent::beforeFilter();
        $this->Auth->allow('getRegions', 'getDeparts', 'getVilles', 'setCP');
    }    

    public function getRegions()
    {
        $this->autoRender = false;

        if(isset($_GET['go']))
        {
            $listregions = $this->Region->find('all', array(
                'fields' => array('Region.id','Region.nom')
            ));
        }

        foreach($listregions as $donnees)
        {
            foreach($donnees as $regions)
            {
                $json[$regions['id']][] = utf8_encode($regions['nom']);
            }
        }
        echo json_encode($json);
    }

    public function getDeparts()
    {
        $this->autoRender = false;
        $json = array();
        
        if(isset($_GET['id_region']))
        {
            $id = htmlentities(intval($_GET['id_region']));
            $listdepartements = $this->Departement->find('all', array(
                'fields' => array('Departement.code_dep', 'Departement.nom'),
                'conditions' => array('id_region =' => $id)
            ));
        }
        foreach($listdepartements as $donnees)
        {
            foreach($donnees as $departements)
            {
                $json[$departements['code_dep']][] = utf8_encode($departements['nom']);
            }
        }
        echo json_encode($json);
    }

    public function getVilles()
    {
        $this->autoRender = false;
        $json = array();

        if(isset($_GET['id_depart']))
        {
            $id = htmlentities(intval($_GET['id_depart']));
            $listvilles = $this->Ville->find('all', array(
                'fields' => array('Ville.ville_id', 'Ville.ville_nom_reel', 'Ville.ville_code_postal', 'Ville.ville_nom'),
                'conditions' => array('ville_departement =' => $id)
                ));
        }
        foreach($listvilles as $donnees)
        {
            foreach($donnees as $villes)
            {
                $json[$villes['ville_nom']][] = utf8_encode($villes['ville_nom_reel']);
            } 
        }
        echo json_encode($json);
    }


    public function setCP()
    {
        $this->autoRender = false;
        $json = array();

        if(isset($_GET['nom_ville']))
        {
            $id = htmlentities($_GET['nom_ville']);
            $listcps = $this->Ville->find('all', array(
                'fields' => array('Ville.ville_id', 'Ville.ville_code_postal'),
                'conditions' => array('ville_nom =' => $id)
                ));
        }
        foreach($listcps as $donnees)
        {
            foreach($donnees as $cps)
            {
                $json[$cps['ville_code_postal']][] = $cps['ville_code_postal'];
            }

        }
        echo json_encode($json);
    }


}

?>