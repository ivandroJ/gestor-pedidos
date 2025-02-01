@if (count(session('error_msgs', [])) > 0)

    @foreach (session('error_msgs', []) as $error)
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {!! $error !!}
        </div>
    @endforeach
@endif



@if (session('error_msg', $error_msg ?? ''))
    <div class="alert alert-danger alert-dismissible" style="font-size: large">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i></h5>
        {!! session('error_msg', $error_msg ?? '') !!}
    </div>
@endif

@if (session('warning_msg', $warning_msg ?? ''))
    <br>
    <div class="alert alert-warning alert-dismissible" style="font-size: large">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-exclamation-triangle"></i></h5>
        {!! session('warning_msg', $warning_msg ?? '') !!}
    </div>
@endif

@if (session('info_msg', $info_msg ?? ''))
    <br>
    <div class="alert alert-info alert-dismissible" style="font-size: large">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-exclamation-circle"></i></h5>
        {!! session('info_msg', $info_msg ?? '') !!}
    </div>
@endif

@if (session('success_msg', $success_msg ?? ''))
    <div class="alert alert-success alert-dismissible text-white" style="font-size: large">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i></h5>
        {!! session('success_msg', $success_msg ?? '') !!}
    </div>
@endif

@if (session('notificacoes_sistema') && session('see_notificacao', false))
    @foreach (session('notificacoes_sistema', []) as $key => $value)
        <div class="alert alert-{{ $key }} alert-dismissible" style="font-size: large">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i
                    class="icon fas fa-{{ $key == 'success' ? 'check' : ($key == 'danger' ? 'times' : ($key == 'warning' ? 'exclamation-triangle' : 'exclamation-circle')) }}"></i>
            </h5>
            {!! $value !!}
        </div>
    @endforeach
@endif
