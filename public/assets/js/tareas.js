/**
 * Created by miguel on 17/01/16.
 */



Object.defineProperty(Date.prototype, 'YYYYMMDDHHMMSS', {
   value: function() {
      function pad2(n) {  // always returns a string
         return (n < 10 ? '0' : '') + n;
      }

      return this.getFullYear() + '-' +
          pad2(this.getMonth() + 1) + '-' +
          pad2(this.getDate()) + ' ' +
          pad2(this.getHours()) + ':' +
          pad2(this.getMinutes()) + ':' +
          pad2(this.getSeconds());
   }
});



Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
vm = new Vue({
   el: '#misTareas',
   data: {
      tareas: [],
      nuevaTarea: {
         id: '',
         created_at: new Date().getFullYear() + '-' + new Date().getMonth()+1 + '-' + new Date().getDate() + ' ' + new Date().toLocaleTimeString(),
         titulo: '',
         descripcion: '',
         tiempo: 0,
         desarrollo_id: null,
         tipo_proyecto_id: 1,
         cliente_id: 1,
         user_id: 1
      },
      search: '',
      order: '',
      reverse: -1,
      completedTarea: [],
      clientes: [],
      desarrollos: [],
      tiposProyecto: [],
      usuarios: []
   },

   ready: function() {
      this.cargarTareas();
      this.cargarClientes();
      this.cargarTiposProyecto();
      this.cargarUsuarios();
   },

   methods: {

      cargarTareas: function() {
         this.$http.get('api/tareas', function(tareas) {
            this.tareas = tareas;
         });
      },
      borrarTarea: function(id) {
         this.tareas.forEach(function(tarea, index) {
            if(id === tarea.id) {
               borrar = tarea;
            }
         });
         this.$http.delete('/tareas/' + id);
         this.tareas.$remove(borrar);
      },
      cargarTiposProyecto: function() {
         this.$http.get('api/tiposProyecto', function(tiposProyecto) {
            this.tiposProyecto = tiposProyecto;
         });
      },
      cargarDesarrollos: function() {
         this.$http.get('api/desarrollos/' + this.nuevaTarea.cliente_id + '/' + this.nuevaTarea.tipo_proyecto_id, function(desarrollos) {
            this.desarrollos = desarrollos;
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
      crearTarea: function(e) {
         e.preventDefault();
         tarea = this.nuevaTarea;
         $('#desarrollo_id').val(null).trigger("chosen:updated");
         $('#tipo_proyecto_id').val(1).trigger("chosen:updated");
         $('#cliente_id').val(1).trigger("chosen:updated");
         this.nuevaTarea = {
            created_at: new Date().getFullYear() + '-' + new Date().getMonth()+1 + '-' + new Date().getDate() + ' ' + new Date().toLocaleTimeString(),
            titulo: '',
            descripcion: '',
            tiempo: 0,
            desarrollo_id: null,
            tipo_proyecto_id: 1,
            cliente_id: 1,
            user_id: tarea.user_id
         };

        this.$http.post('/api/tareas', tarea).then(function (response) {
           tarea.id = response.data;
           this.tareas.push(tarea);
        })
      },
      completingTarea: function(tarea) {
         this.completedTarea = tarea;

      },
      doneTarea: function(tarea) {
         if (!this.completedTarea) {
            return;
         }

         this.$http.post('/api/tareas/edit', tarea);
         this.completedTarea = null;
      }
   },
   directives: {
      'tarea-focus': function (value) {
         if (!value) {
            return;
         }
         var el = this.el;
         Vue.nextTick(function () {
            el.focus();
         });
      }
   }

});

$('#tipo_proyecto_id').chosen().change(function(e,f) {
   vm.$data.nuevaTarea.tipo_proyecto_id = $(this).val();
   vm.cargarDesarrollos();
});

$('#desarrollo_id').chosen().change(function(e,f) {
   vm.$data.nuevaTarea.desarrollo_id = $(this).val();
});

$('#cliente_id').chosen().change(function(e,f) {
   vm.$data.nuevaTarea.cliente_id = $(this).val();
});

$('#tipo_proyecto_id').trigger("chosen:updated");
$('#cliente_id').trigger("chosen:updated");
$('#desarrollo_id').trigger("chosen:updated");