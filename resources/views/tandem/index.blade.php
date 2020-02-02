@extends('tandem.layouts.layout')

@section('page')
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>ISC Tandem Database</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-11 col-sm-9 col-md-8 mx-auto">
                    <p>
                        Tandem is a way of mutual learning and teaching languages. You will find someone who would
                        teach you a foreign language and you would teach him yours in return
                    </p>
                    <p>
                        The main advantage of Tandem is that it will be just you two, who will set the time and
                        the intensity of the courses! You can form as many couples as you wish.
                    </p>
                    <p>
                        If you join the ISC Tandem Database, you will get the access to the list of students
                        looking for a Tandem partner and other students will be able to find you.
                    </p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-auto mx-auto">
                    <div class="form-group">
                        <p class="text-uppercase">Already registered?</p>
                        <a class="btn btn-primary" href="{{ route('tandem.login') }}">
                            <span class="fas fa-sign-in-alt"></span> Log in
                        </a>
                    </div>
                    <div class="form-group">
                        <p class="text-uppercase">Are you new here</p>
                        <a class="btn btn-primary" href="{{ route('tandem.register') }}">
                            <span class="fas fa-user-plus"></span> Register
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-auto mx-auto">
                    <p>Any questions or problems? Contact us!</p>
                    <p>
                        E-mail: <a href="mailto:languages@isc.cvut.cz">languages@isc.cvut.cz</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
