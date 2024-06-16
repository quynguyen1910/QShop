<form class="d-flex gap-3 align-items-start" method="GET" action="{{ $routeAction }}">
    <div>
        <label  class="form-label" for="records_per_page">Hiển thị:</label>
        <select id="records_per_page" name="records_per_page" method="GET" class="form-select" aria-label=".form-select-sm example">
            <option value="5" {{ $recordsPerPage == 5 ? 'selected' : '' }}>5</option>
            <option value="10" {{ $recordsPerPage == 10 ? 'selected' : '' }}>10</option>
            <option value="25" {{ $recordsPerPage == 25 ? 'selected' : '' }}>25</option>
          </select>
    </div>
      <div>
          <label class="form-label" for="">Tình trạng hoạt động</label>
          <select name="status" class="form-select" aria-label="Default select example">
            <option value="" disabled selected>chọn hoạt động</option>
              <option value='1'>Hoạt Động</option>
              <option value="0">Dừng Hoạt Động</option>
          </select>
          </div>
        <div class="align-self-end"><button class="btn btn-primary" type="submit">Lọc</button></div>
</form>