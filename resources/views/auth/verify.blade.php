@extends('master.page')

@section('content')
<div class="container ">
    <div class="row justify-content-center page">
        <div class="col-md-12" style="border:1px solid rgba(0,0,0,0.1); padding: 30px; border-radius: 10px; margin-top: 40px">
            <div class="card">
                <div class="card-header" style="font-weight: bold; font-size: 16px">Vérifier votre adresse email</div>

                <div class="card-body" style="margin-top: 30px">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Avant de continuer, veuillez vérifier votre e-mail pour un lien de vérification. Si vous n'avez pas reçu l'e-mail,
                        </div>
                    @endif

                    Avant de continuer, veuillez vérifier votre e-mail pour un lien de vérification.
                    <br/><br/>
                    
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-default" style="background:#EF4136; color:white; ">Si vous n'avez pas reçu l'e-mail cliquez ici pour en demander un autre</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
