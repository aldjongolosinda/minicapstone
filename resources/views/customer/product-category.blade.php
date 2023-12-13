@extends('landing')
@section('content')

        <header class="jumbotron bg-dark" id="heading">
            <h1 class="display-4 text-white">Welcome to our Instrument Shop!</h1>
            <p class="lead text-white">Find the perfect instrument to make your music come alive.</p>
        </header>

        {{-- <div class="d-flex justify-content-center">
            <div class="row col-10">
                @foreach ($categories as $category )
                    <div class="card col-lg-6 col-md-6">
                        <a href="{{url('/category/' . $category->id)}}" class="card m-3" style="max-height: 40rem; text-decoration: none;" id="category-card">
                            <img class="card-img-top p-2" src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="position: relative; height:37rem;">
                            <div class="card-body">
                                <h5 class="card-title text-white fw-bold">{{ $category->name }}</h5>
                                <p class="card-text text-white">{{ $category->description }}</p>
                            </div>
                        </a>
                    </div>

                @endforeach

            </div>
        </div> --}}
        <div class="container">
            <div class="row">
                @foreach ($categories as $category)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-6 mb-3 mt-3">
                        <a class="card" href="{{url('/category/' . $category->id)}}" style="width: 100%; text-decoration: none;">
                            <img class="card-img-top p-2" src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="position: relative; height:37rem;">
                            <div class="card-body">
                                <h5 class="card-title text-white fw-bold">{{ $category->name }}</h5>
                                <p class="card-text text-white">{{ $category->description }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>


    <style>
        @keyframes fadeInAnimation {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
        .jumbotron {
            /* background-color: rgba(10, 10, 10, 0.5); */
            backdrop-filter: blur(5px);
            padding: 100px 0;
            text-align: center;
            /* animation: fadeInAnimation 2s ease-in-out; */
        }
        .card {
            background: transparent;
            backdrop-filter: blur(2px);
            transition: all .5s ease;
            border: 0;
        }
        #heading, #category-card {
            animation: fadeInAnimation 0.8s ease-in-out;
        }
        .card:hover{
            transform: translate3D(0,-1px,0) scale(1.03);
            transition: all .4s ease;
        }
    </style>
@endsection
