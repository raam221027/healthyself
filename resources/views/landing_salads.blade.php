<div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
        <div class="row">
          @isset($salad)
          @foreach ($salad as $s)
          <div class="col-md-4">
            <div class="card salad mb-3 wow fadeInUp" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" data-salad-id="{{ $s->id }}" style="width: 18rem; margin-left: 100px; height: 40vh; border-radius: 15px;">
              <div class="d-flex flex-column bg-image hover-overlay hover-zoom hover-shadow ripple">
                <img src="{{ asset('storage/' . $s->photo) }}" class="card-img-top mx-auto" alt="..." style="height: 25vh; border-radius: 15px;">
                <div class="bg-success rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">New</div>
                <div class="card-body">
                  <h5 class="card-title text-center">{{ $s->name }}</h5>
                  <p class="card-text text-center text-success"></p>
                </div>
                <div class="mask" style="background-color: hsla(195, 83%, 58%, 0.2)"></div>
              </div>
            </div>
          </div>
          @endforeach
          @endisset
        </div>
      </div>
    </div>