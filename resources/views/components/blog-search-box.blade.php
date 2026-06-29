<div class="widget search-box">
  <h3 class="sidebar-title">Search</h3>
  <div class="s-border"></div>
  <div class="m-border"></div>
  <form action="{{ route("search") }}" method="GET">
    @csrf
    <div class="input-group">
      <input type="text" class="form-control" name="query" id="textsearch2" placeholder="Search">
      <button type="submit" class="btn-5 pull-right">Search <i class="fa fa-search"></i></button>
    </div>
  </form>
</div>
