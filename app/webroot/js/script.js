jQuery(document).ready(function($) {

    $(document).on('click', '.yamm .dropdown-menu', function(e) {
        e.stopPropagation()
    }); //dropdow menu navbar

    $("#zoom_mw").elevateZoom({scrollZoom : true});//image chaussure zoom

    $('#myTab a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    }); //tab pour la page chaussure

    $('.js-activated').dropdownHover().dropdown();//dropdown nav

    $(".date").datepicker({ 
        format: "dd/mm/yyyy",
        startDate: "01/01/1910",
        endDate: "31/12/1996",
    autoclose: true });// datepicker pour la date de naissance de l'utilisateur

    var $regions = $('#regions');
    var $departements = $('#departements');
    var $villes = $("#villes");
    var $cpostal = $("#cpostal");

    // chargement des régions
    $.ajax({
        url: '../ajax/getRegions',
        data: 'go', // on envoie $_GET['go']
        dataType: 'json', // on veut un retour JSON
        success: function(json) {
            $.each(json, function(index, value) { // pour chaque noeud JSON
                // on ajoute l option dans la liste
                $regions.append('<option value="'+ index +'">'+ value +'</option>');
            });
        }
    });

    // à la sélection d une région dans la liste
    $regions.on('change', function() {
        var val = $(this).val(); // on récupère la valeur de la région

        if(val != '') {
            $departements.empty(); // on vide la liste des départements

            $.ajax({
                url: '../ajax/getDeparts',
                data: 'id_region='+ val, // on envoie $_GET['id_region']
                dataType: 'json',
                success: function(json) {
                    $.each(json, function(index, value) {
                        $departements.append('<option value="'+ index +'">'+ value +'</option>');
                    });
                }
            });
        }
    });

    // a la selection dun departement dans la liste
    $departements.on('change', function(){
        var val = $(this).val(); // je recup la value

        if(val != ''){
            $villes.empty();

            $.ajax({
                url: '../ajax/getVilles',
                data: 'id_depart=' + val, // je lenvoi en get encore une fois
                dataType: 'json',
                success: function(json) {
                    $.each(json, function(index, value){
                        $villes.append('<option value="'+ index +'">'+ value +'</option>');
                    });
                }
            });
        }
    });

    $villes.on('change', function(){
        var val = $(this).val();

        if(val != ''){
            $cpostal.empty();

            $.ajax({
                url: '../ajax/setCP',
                data: 'nom_ville=' + val,
                dataType: 'json',
                success: function(json) {
                    $.each(json, function(index, value) {
                        $cpostal.append('<option value="'+ index +'">' + value + '</option>');
                    })
                }
            })        
        }   
    })
});

