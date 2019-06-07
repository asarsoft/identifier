@extends('layouts.master')

@section('style')
    <link href="{{ asset('application_css/web/projects_customise.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container pt-5">
        <div class="my-3">
            <div class="row align-items-center text-md-left mb-5">
                <div class="col-md-6 mb-4 mb-md-0">
                    <h1 class="display-4">Hello, world!</h1>
                    <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra
                        attention to featured content or information.</p>
                    <p class="lead">
                        <a class="btn btn-primary" href="#" role="button">{{ trans('button_input.place_order') }}</a>
                        <a class="btn btn-outline-primary" href="#"
                           role="button">{{ trans('button_input.discuss_order') }}</a>
                    </p>
                </div>
                <div class="col-md-6 order-1 order-md-0">
                    <img class="img-fluid" src="https://bootstrapshuffle.com/placeholder/pictures/bg_16-9.svg" alt="">
                </div>
            </div>
        </div>

        <div class="col-md-12 p-0">
            <section class="py-5">
                <div class="container text-center"><strong>The New Internet</strong>
                    <h1 class="display-4 my-3">We've built a decentralized internet where information is totally
                        free</h1><a class="btn btn-link my-2" href="#">Read more &raquo;</a>
                </div>
            </section>
        </div>

        <div class="col-md-12 mb-4 px-0">
            <div class="nav nav-pills justify-content-center" id="nav-tab" role="tablist">

                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                   aria-controls="nav-home" aria-selected="true">{{ trans('button_input.all') }}</a>

                <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                   aria-controls="nav-home" aria-selected="true">Home</a>

                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                   aria-controls="nav-profile" aria-selected="false">Profile</a>

                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
                   aria-controls="nav-contact" aria-selected="false">Contact</a>

            </div>
        </div>

        <div class="card-columns">
            <div class="card shadow-sm border-light">
                <img src="{{ asset('application_images/welcome/port/rivalMockupGif.gif')}}" class="card-img-top"
                     alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title that wraps to a new line</h5>
                    <p class="card-text">This is a longer card with supporting text below as a natural lead-in to
                        additional content. This content is a little bit longer.</p>
                </div>
            </div>
            <div class="card p-3 shadow-sm border-light">
                <blockquote class="blockquote mb-0 card-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    <footer class="blockquote-footer">
                        <small class="text-muted">
                            Someone famous in <cite title="Source Title">Source Title</cite>
                        </small>
                    </footer>
                </blockquote>
            </div>
            <div class="card shadow-sm border-light">
                <img src="{{ asset('application_images/welcome/port/arHotelGif.gif')}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This card has supporting text below as a natural lead-in to additional
                        content.</p>
                    <p class="card-text">
                        <small class="text-muted">Last updated 3 mins ago</small>
                    </p>
                </div>
            </div>
            <div class="card bg-primary text-white text-center p-3 shadow-sm border-light">
                <blockquote class="blockquote mb-0">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat.</p>
                    <footer class="blockquote-footer text-white">
                        <small>
                            Someone famous in <cite title="Source Title">Source Title</cite>
                        </small>
                    </footer>
                </blockquote>
            </div>
            <div class="card text-center shadow-sm border-light">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This card has a regular title and short paragraphy of text below it.</p>
                    <p class="card-text">
                        <small class="text-muted">Last updated 3 mins ago</small>
                    </p>
                </div>
            </div>
            <div class="card shadow-sm border-light">
                <img src="{{ asset('application_images/welcome/port/arricieHotelGif.gif')}}" class="card-img-top"
                     alt="...">
            </div>
            <div class="card p-3 text-right shadow-sm border-light">
                <blockquote class="blockquote mb-0">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    <footer class="blockquote-footer">
                        <small class="text-muted">
                            Someone famous in <cite title="Source Title">Source Title</cite>
                        </small>
                    </footer>
                </blockquote>
            </div>
            <div class="card shadow-sm border-light">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is another card with title and supporting text below. This card has some
                        additional content to make it slightly taller overall.</p>
                    <p class="card-text">
                        <small class="text-muted">Last updated 3 mins ago</small>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <section class="py-5">
        <div class="container text-center">
            <h2 class="mb-4">PiperNet Setup</h2>
            <p class="lead mb-5">We've designed a simple, efficient process for companies migrating to PiperNet. Here's
                how it works.</p>
            <div>
                <div class="row align-items-center text-md-left mb-5">
                    <div class="col-md-6 order-1 order-md-0">
                        <img class="img-fluid" src="https://bootstrapshuffle.com/placeholder/pictures/bg_16-9.svg"
                             alt="">
                    </div>
                    <div class="col-md-6 mb-4 mb-md-0"><span class="display-3 mb-2">01</span>
                        <h3 class="mb-4">Move Data</h3>
                        <p>Using our Piper Assistant application, you can move your data to be stored our decentralized
                            network with simple drag & drop.</p>
                    </div>
                </div>
                <div class="row align-items-center text-md-right mb-5">
                    <div class="col-md-6 order-1">
                        <img class="img-fluid" src="https://bootstrapshuffle.com/placeholder/pictures/bg_16-9.svg"
                             alt="">
                    </div>
                    <div class="col-md-6 mb-4 mb-md-0 order-0"><span class="display-3 mb-2">02</span>
                        <h3 class="mb-4">Integrate Software</h3>
                        <p>We want to make sure that you can keep using the software that you use to manage your
                            business.</p>
                    </div>
                </div>
                <div class="row align-items-center text-md-left mb-5">
                    <div class="col-md-6 order-1 order-md-0">
                        <img class="img-fluid" src="https://bootstrapshuffle.com/placeholder/pictures/bg_16-9.svg"
                             alt="">
                    </div>
                    <div class="col-md-6 mb-4 mb-md-0"><span class="display-3 mb-2">03</span>
                        <h3 class="mb-4">Ongoing Support</h3>
                        <p>As with all innovative technologies, sometimes unpredictable things will happen, and you can
                            always count on our support to solve issues for you.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
