/**
 * Created by miguel on 1/06/16.
 */


$(document).ready(function() {

    var url = $('#getFecha').attr('href');

    var $inicio = $('#fechaInicio').pickadate({
        format: 'yyyy-mm-dd 00:00:00',
        formatSubmit: 'yyyy-mm-dd 00:00:00'
    });

    var $fin = $('#fechaFin').pickadate({
        format: 'yyyy-mm-dd 23:59:59',
        formatSubmit: 'yyyy-mm-dd 23:59:59'
    });


    var pInicio = $inicio.pickadate('picker');
    var ano = '';
    var mes = '';

    pInicio.on({
        set: function(thingSet) {
            ano = pInicio.get('select','yyyy');
            mes = pInicio.get('select','mm');
            $('#getFecha').attr('href', url + '/' + mes + '/' + ano + '/');
        }
    });


    


});
