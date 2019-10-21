@extends('layouts.app')

@section('content')
<div class="container">
  @if (session('message'))
      <div class="alert alert-success">
          {{ session('message') }}
      </div>
  @endif
    <section id="katalog-action">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2 col-12 menu-katalog text-white bg">
          <h2>Каталог</h2>
          <div class="list d-flex flex-column">
            <div class="btn-group dropright w-100">
              <button type="button" class="btn btn-secondary dropdown-toggle w-100" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Автозапчасти
              </button>
              <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">Топливная система</a>
                  <a class="dropdown-item" href="#">Свечи</a>
                  <a class="dropdown-item" href="#">Датчики</a>
                </div>
            </div>
            <div class="btn-group dropright w-100">
                <button type="button" class="btn btn-secondary dropdown-toggle w-100" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Кузовные запчасти
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="#">Крыша</a>
                  <a class="dropdown-item" href="#">Кабина</a>
                  <a class="dropdown-item" href="#">Двери</a>
                </div>
            </div>
            <div class="btn-group dropright w-100 all">
                <button type="button" class="btn btn-secondary dropdown-toggle w-100" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Все категории
                </button>
            </div>
          </div>
        </div>
        <div class="col-md-10 action d-none d-md-block">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              </ol>
              <div class="container carousel-inner">
                @foreach($actions as $index=>$action)
                  <div class="row carousel-item {{ ($index == 0 ? 'active' : '') }}">
                    <div class="col-12 d-flex">
                      <img src="{{$action->img}}" class="ml-5 mt-2 mb-2 d-block action-img" alt="">
                      <div class="detail">
                        <h5 class="text-center">{{$action->description}}</h5>
                          <button type="button" class="btn  btn-danger mt-4">Подробнее</button>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
    
  <section id="banner">
    <div class="container-fluid mt-4">
      <h3 class="text-center mb-4">ПОИСК АВТОЗАПЧАСТЕЙ</h3>
      <div class="row justify-content-center">
        <div class="col-md-4 col-12">
          <div class="position">
            <div class="description">
              <h4>По VIN коду</h4>
              <button type="button" class="btn btn-danger mt-4">Подробнее</button>
            </div>
            <div class="block-2 clip-path">     
            </div>
          </div>
        </div>
        <div class="col-md-4 col-12 mb-4">
          <div class="position">
            <div class="description">
              <h4>По категориям</h4>
              <button type="button" class="btn btn-danger mt-4">Подробнее</button>
            </div>
            <div class="block-3 clip-path">     
            </div>
          </div>
        </div>
        <div class="col-md-4 col-12">
          <div class="position">
            <div class="description">
              <h4>Товары для ТО</h4>
              <button type="button" class="btn btn-danger mt-4">Подробнее</button>
            </div>
            <div class="block-4 clip-path">     
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="call">
    <div class="container-fluid mt-4">
      <div class="row">
        <div class="bg reklame">
          <div class="content">
            <h3>Нет времени искать необходимую деталь
            <br>
            Звоните нам!
            <br>
            (096) 35 60 509</h3>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="popular">
    <div class="container my-4">
      <h3 class="text-center mb-4">РЕКОМЕНДУЕМЫЕ ЗАПЧАСТИ</h3>
      <div class="row justify-content-center">
        <div class="col-12 col-md-3 mb-4">
          <div class="position text-center">
            <img src="images/popular-1.jpg" alt="">
            <div class="name-product"><h5>Антифриз Motul Inugel Expert 5L</h5></div>
            <div class="description-product"><p>
              Охлаждающая жидкость 
              <br>
              Для всех охлаждающих систем 
              <br>
              Объем 5 литров
            </p></div>
            <div class="price">1000 грн</div>
            <div class="choice">
              <button type="button" class="btn btn-danger mt-4 mr-2">Купить</button>
              <button type="button" class="btn btn-light mt-4">Детали</button>
            </div>  
          </div>
        </div>
        <div class="col-12 col-md-3 mb-4">
          <div class="position text-center">
            <img src="images/popular-2.jpg" alt="">
            <div class="name-product"><h5>Тормозная жидкость Motul DOT 5.1 BRAKE FLUID 1L</h5></div>
            <div class="description-product"><p>
              100% синтетика
              <br>
              Без силикона 
              <br>
              Объем 1 литр
            </p></div>
            <div class="price">500 грн</div>
            <div class="choice">
              <button type="button" class="btn btn-danger mt-4 mr-2">Купить</button>
              <button type="button" class="btn btn-light mt-4">Детали</button>
            </div>  
          </div>
        </div>
        <div class="col-12 col-md-3 mb-4">
          <div class="position text-center">
            <img src="images/popular-3.jpg" alt="">
            <div class="name-product"><h5>Тормозная жидкость RP Moto DOT 4 Brake Fluid 0.5 L</h5></div>
            <div class="description-product"><p>
              100% синтетическая жидкость  
              <br>
              Объем 500 миллилитров 
            </p></div>
            <div class="price">700 грн</div>
            <div class="choice">
              <button type="button" class="btn btn-danger mt-4 mr-2">Купить</button>
              <button type="button" class="btn btn-light mt-4">Детали</button>
            </div>  
          </div>
        </div>
        <div class="col-12 col-md-3">
          <div class="position text-center">
            <img src="images/popular-4.jpg" alt="">
            <div class="name-product"><h5>Концентрат Motul Inugel Optimal Ultra 5L</h5></div> 
            <div class="description-product"><p>
                          Концентрат охлаждающей жидкости
                          <br>
                          Для всех охлаждающих систем 
                          <br>
                          Объем 5 литров
                        </p></div>
            <div class="price">1500 грн</div>
            <div class="choice">
              <button type="button" class="btn btn-danger mt-4 mr-2">Купить</button>
              <button type="button" class="btn btn-light mt-4">Детали</button>
            </div>  
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="owl-carousel">
    @foreach($recommendedProducts as $product)
    <div class="product p-2">{{--p-2 это Padding--}}
      <a href="/product/{{$product->slug}}">
          <img src="{{$product->img}}" alt="">
          <h5 class="text-center">{{$product->name}}</h5>
      </a>
      <div class="price text-center text-danger">{{$product->price}}</div>

    </div>
    @endforeach
  </div>
</div>
@endsection

@section('js')
<script>
    (function($){
        $(document).ready(function(){
        $(".owl-carousel").owlCarousel();
    });
    })(jQuery);
    
</script>
@endsection