Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

vm = new Vue({
    el: '#app-analisis',
    data: {
        defaultFilter: [],
        filtro: {
            tipotareas: '',
            clientes: '',
            empleados: '',
            desde: '',
            hasta: ''
        },
        tareas: [],
        clientes: [],
        tiposProyecto: [],
        usuarios: []
    },

    ready: function() {
        this.cargarClientes();
        this.cargarTiposProyecto();
        this.cargarUsuarios();
    },

    methods: {
        cargarTiposProyecto: function() {
            this.$http.get('api/tiposProyecto', function(tiposProyecto) {
                this.tiposProyecto = tiposProyecto;
            });
        },
        cargarClientes: function() {
            this.$http.get('api/clientes', function(clientes) {
                this.clientes = clientes;
            });
        },
        cargarUsuarios: function() {
            this.$http.get('api/usuarios', function(usuarios) {
                this.usuarios = usuarios;
            });
        },
        obtenerResultados: function() {
            this.$http.post('/api/tareas/analisis/getAnalisis', this.filtro).then(function (procesed) {

                this.tareas = procesed.data;
            }, function() {
                console.log('Error /api/tareas/analisis/getAnalisis');
            })
        },
        descargarResultados: function() {
            this.$http.post('/api/tareas/analisis/export', this.filtro).then(function (procesed) {
                window.location = '/getExport/';
            }, function() {
                console.log('Error /api/tareas/analisis/export');
            })
        }
    },
    computed: {
        total: function(){
            return this.tareas.reduce(function(prev, tarea){
                return sum + tarea.tiempo;
            },0);
        }
    }
});




$(document).ready(function() {

    $('#fechaInicio').pickadate({
        format: 'yyyy-mm-dd 00:00:00',
        formatSubmit: 'yyyy-mm-dd 00:00:00'
    });
    $('#fechaFin').pickadate({
        format: 'yyyy-mm-dd 23:59:59',
        formatSubmit: 'yyyy-mm-dd 23:59:59'
    });

    $('#tipotareas_id').chosen().change(function(e,f) {
        vm.$data.filtro.tipotareas = $(this).val();
    });

    $('#clientes_id').chosen().change(function(e,f) {
        vm.$data.filtro.clientes = $(this).val();
    });

    $('#empleados_id').chosen().change(function(e,f) {
        vm.$data.filtro.empleados = $(this).val();
    });

    $('#empleados_id').trigger("chosen:updated");
    $('#clientes_id').trigger("chosen:updated");
    $('#tipotareas_id').trigger("chosen:updated");

});


