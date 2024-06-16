       {{-- slide --}}
       <div class="container-fluid fruite py-5 mt-5">
        <div class="container py-5">
            <div id="slide" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#slide" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#slide" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#slide" data-bs-slide-to="2" aria-label="Slide 3"></button>
                  <button type="button" data-bs-target="#slide" data-bs-slide-to="3" aria-label="Slide 4"></button>
                  <button type="button" data-bs-target="#slide" data-bs-slide-to="4" aria-label="Slide 5"></button>
                  <button type="button" data-bs-target="#slide" data-bs-slide-to="5" aria-label="Slide 6"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="{{asset('uploads/images/slides/slide-1.png')}}" class="d-block img-fluid w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{asset('uploads/images/slides/slide-2.png')}}" class="d-block img-fluid w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{asset('uploads/images/slides/slide-3.png')}}" class="d-block img-fluid w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{asset('uploads/images/slides/slide-4.png')}}" class="d-block img-fluid w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{asset('uploads/images/slides/slide-5.png')}}" class="d-block img-fluid w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="{{asset('uploads/images/slides/slide-6.png')}}" class="d-block img-fluid w-100" alt="...">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#slide" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#slide" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
        </div>
    </div>
    {{-- End slide --}}