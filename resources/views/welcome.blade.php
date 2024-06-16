<form enctype="multipart/form-data" method="POST" action="{{ route('test') }}">
  @csrf
  <div class="mb-3">
      <label for="formFile" class="form-label">Upload ảnh</label>
      <input name="anh_sp[]" accept="images/*" class="form-control" type="file" id="formFile" multiple>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
