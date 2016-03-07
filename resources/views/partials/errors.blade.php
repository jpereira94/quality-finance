@if (count($errors) > 0)
    <div class="card-panel red white-text">
        <ul class="no-margin">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
