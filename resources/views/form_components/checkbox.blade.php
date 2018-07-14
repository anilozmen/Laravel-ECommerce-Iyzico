<div class="form-group">{{$errors->has($name) ? ' has-error' : ''}}
    {{ Form::label($name, $label_name, ['class' => 'control-label']) }}

    @foreach($values as $value)
        <label class="checkbox-inline">
            <input type="checkbox" name="{{$name}}[]" value="{{$value["value"]}}" {{$value["is_checked"] ? "checked" : null}}>{{$value["text"]}}
        </label>
    @endforeach


    @if($errors->has($name))
        <span class="help-block">
            <strong>{{$errors->first($name)}}</strong>
        </span>
    @endif

</div>