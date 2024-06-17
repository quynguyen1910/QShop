<button type="button" class="btn btn-primary"> 
    <a class="d-block text-white" href="{{$routeEdit ?? ''}}">
        <i class="fa fa-pencil" aria-hidden="true"></i>
    </a>
</button>     

@if ($isDel)
  <a href="{{$recycle ?? ''}}">
  <button type="button" class="btn btn-primary">
    <i class="fa fa-recycle" aria-hidden="true"></i>
  </button>
</a>
@else
<button data-name='{{$nameDel ?? ''}}' data-action="{{$routeDel ?? ''}}" data-bs-toggle="modal" data-bs-target="#requestModal" type="button" class="btn btn-danger">
  <i class="fa fa-trash" aria-hidden="true"></i>
</button>
@endif




{{-- <a href="{{$recycle ?? ''}}">
  <button type="button" class="btn btn-primary">
    <i class="fa fa-recycle" aria-hidden="true"></i>
  </button>
</a> --}}


{{-- <button data-name='{{$nameDel ?? ''}}' data-action="{{$routeDel ?? ''}}" data-bs-toggle="modal" data-bs-target="#requestModal" type="button" class="btn btn-danger">
  <i class="fa fa-trash" aria-hidden="true"></i>
</button> --}}







   <!-- Modal -->
   <div class="modal fade" id="requestModal" tabindex="-1" aria-labelledby="requestModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="requestModalLabel">Bạn có muốn xóa?</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Không</button>
          <a id="confirmDelete">
            <button id="confirmDelete" type="button" class="btn btn-primary">
        Đồng ý </button></a>
        </div>
      </div>
    </div>
  </div>