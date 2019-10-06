@extends('layout.form')
@section('content')
<div class="col-md-8 offset-md-1">
  <span class="anchor" id="formComplex"></span>
  @if(isset($error))
  <div class="alert alert-danger" role="alert">
  {{$error}}
  </div>
  @endif
  <hr class="my-5">
  <p>Por favor complete los datos de acceso</p>
  <form id="mtt-checkout-form" action="/agencias-login" method='POST' accept-charset="UTF-8">
  <input type="hidden" name="_token" value="{{session_id()}}"  />
  <input type="hidden" name="agencyContext" value="true"  />

  <div class="form-row mt-4">
    <div class="col-sm-6 pb-3">
      <label for="username" class="d-none">Username</label>
      <input type="text" class="form-control" id="username" placeholder="Nombre de usuario *" name="username"  required>
    </div>
    <div class="col-sm-6 pb-3">
      <label for="password" class="d-none">Password</label>
      <input type="text" class="form-control" id="password" placeholder="Password*" name="password"  required>
    </div>

    <div class="form-row my-4 mx-auto">
      <button id="mtt-book-my-trip" class="btn btn-dark btn-mtt-checkout" type="submit"  name="book">Login</button>
    </div>

  </div>
  </form>
</div>
@endsection