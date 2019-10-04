@if ($errors->any())
<div class="alert alert-danger">
    <ul>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ul>
</div>
@endif
<form method="POST" action="/profile" enctype="multipart/form-data" >
    {{ csrf_field() }}
    <input type="file" name="photo">
    <input type="submit">
</form>
