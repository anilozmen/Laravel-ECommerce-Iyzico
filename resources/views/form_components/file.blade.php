<div class="form-group {{ $errors->has($name) ? ' has-error' : '' }}">
    {{ Form::label($name, $label_name, ['class' => 'control-label']) }}
    {{ Form::file($name, ['multiple' => true]) }}
    @if($errors->has($name))
        <span class="help-block">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
        @endif
</div>