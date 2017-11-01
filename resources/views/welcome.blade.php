@extends('layouts.app')

@section('title', 'Главная страница')


@section('content')


        <!-- Header -->
        <header class="intro-header">
            <div class="container">
                <div class="intro-message">
                    <h1>Живое общение</h1>
                    <hr class="intro-divider">
                    @if (Route::has('login'))
                        <div class="top-right links">
                            @auth
                                <h3><a href="{{ url('/home') }}">Зайти в чат</a></h3>
                            @else
                                <h3><a href="{{ route('login') }}">Авторизация</a></h3>
                                <h3><a href="{{ route('register') }}">Регистрация</a></h3>
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <section class="content-section-a">

            <div class="container">
                <div class="row">
                    <div class="col-lg-5 ml-auto">
                        <hr class="section-heading-spacer">
                        <div class="clearfix"></div>
                        <h2 align="center" class="section-heading">Наслаждайтесь общением в режиме On-line!<br></h2>
                        <p align="justify" class="lead">
                            С помощью данного чата Вы сможете создавать приватные беседы и мгновенно
                            откликаться на новопришедшие сообщения, а также планировать и обсуждать текущие проекты.
                            </p>
                    </div>
                    <div class="col-lg-5 mr-auto">
                        <img class="img-fluid" src="img/ipad.png" alt="">
                    </div>
                </div>

            </div>
            <!-- /.container -->
        </section>
@endsection
