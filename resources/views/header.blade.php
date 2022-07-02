<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Backend test</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link {{request()->path()=='soal1'?'active':''}}" href="/soal1">Soal 1</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{request()->path()=='soal2'?'active':''}}" href="/soal2">Soal 2</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{request()->path()=='soal3'?'active':''}}" href="/soal3">Soal 3</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
