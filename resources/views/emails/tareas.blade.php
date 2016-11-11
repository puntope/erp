
<div style="max-width: 768px;">
    <header style="background: #333;color: #eee;padding: .5em 1em;">
        <h3>{{$user->name}} {{$user->apellidos}} <span style="margin-left:15px;">{{\Carbon\Carbon::today()->format('d-m-Y')}}</span></h3>
        <h5>Tiempo total: {{date('H:i', mktime(0,$tareas->sum('tiempo'))) }}</h5>

    </header>

    <div style="margin: 1em 0 2em;background: #fff;border-radius: 3px;">
        <h4 style="padding: 1em;color: #fff;margin: 1em 0;border-radius: 3px;background: #bfeab9;">Completadas</h4>
        @foreach($tareas as $tarea)
            @if ($tarea->tiempo)
                <div style="background: #eee;padding: .5em;margin: 0 0 1em;border-radius: 3px;">
                    <p>
                        <strong>{{$tarea->titulo}}</strong><br />
                        {{$tarea->descripcion}}
                    </p>
                    <p>
                        <strong style="margin-right: 10px;">{{$tarea->cliente->nombre}}</strong>
                        <span style="margin-right: 10px;">{{$tarea->tipoTarea->nombre}}</span>
                        <strong style="margin-right: 10px;">{{$tarea->tiempo}} minutos</strong>
                    </p>
                </div>
            @endif
        @endforeach
    </div>

    <div style="margin: 1em 0 2em;background: #fff;border-radius: 3px;">
        <h4 style="padding: 1em;color: #fff;margin: 1em 0;border-radius: 3px;background: #efd6b1;">Pendientes</h4>
        @foreach($tareas as $tarea)
            @if (!$tarea->tiempo)
                <div style="background: #eee;padding: .5em 1em;margin: 0 0 1em;border-radius: 3px;">
                    <p>
                        <strong>{{$tarea->titulo}}</strong><br />
                        {{$tarea->descripcion}}
                    </p>
                    <p>
                        <strong style="margin-right: 10px;">{{$tarea->cliente->nombre}}</strong>
                        <span style="margin-right: 10px;">{{$tarea->tipoTarea->nombre}}</span>
                        <span style="margin-right: 10px;">{{$tarea->created_at}}</span>
                    </p>

                    </p>
                </div>
            @endif
        @endforeach
    </div>
</div>






