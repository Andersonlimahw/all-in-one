$(document).ready(function () {
    $('select').material_select();
    $("#container-editar-perfil").hide();

    // modais
    $('.modal').modal({
        dismissible: true, // Modal can be dismissed by clicking outside of the modal
        opacity: .5, // Opacity of modal background
        inDuration: 300, // Transition in duration
        outDuration: 200, // Transition out duration
        startingTop: '4%', // Starting top style attribute
        endingTop: '10%', // Ending top style attribute
        ready: function (modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
            //   alert("Ready");
            console.log(modal, trigger);
        },
        complete: function () { } // Callback for Modal close
    }
    );

    $('#modalMaterialize').modal('open');
    $('#modalMaterialize').modal('close');

    $(".btn-abrir").click(function () {
        $("#modalAula").fadeIn('fast');
    });

    $(".btn-fechar").click(function () {
        $("#modalAula").fadeOut('fast')
    });

    //login 
    // abrir modal ao entrar na páginas
    $("#modalLogin").fadeIn('fast');

    //botões de controle
    $(".btn-login").click(function () {
        $("#modalLogin").fadeIn('fast');
    });

    $(".btn-cadastrar").click(function () {
        $("#modalLogin").fadeOut('fast');
        $("#modalCadastro").fadeIn('fast');
    });

    $(".btn-cancelar").click(function () {
        $("#modalLogin").fadeOut('fast');
        $("#modalCadastro").fadeOut('fast');
    });
    // fim botões de controle

    //perfil 
    $(".btn-toggle-perfil").click(function () {
        $("#container-visualizar-perfil").slideToggle();
        $("#container-editar-perfil").slideToggle('fast');

    });
    $(".btn-close-perfil").click(function () {
        $("#container-visualizar-perfil").slideToggle();
        $("#container-editar-perfil").slideToggle('fast');
        
    });


    

});