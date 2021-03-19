<ul class="shadowbox toggled collapse"></ul>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  {{-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
  </a>


  <hr class="sidebar-divider my-0"> --}}

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="{{url('/painel')}}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Início</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Interface e Conteúdo
  </div>
  <li class="nav-item">
    <a class="nav-link" href="{{url('paginas')}}">
      <i class="fas fa-fw fa-folder"></i>
      <span>Páginas</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('galeria')}}">
      <i class="fas fa-image"></i>
      <span>Galerias</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{url('banners')}}">
      <i class="fas fa-images"></i>
      <span>Banners</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false"
      aria-controls="collapsePages">
      <i class="fas fa-tags"></i>
      <span>Meta Tags</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{route('metas.create')}}">Cadastrar</a>
        <a class="collapse-item" href="{{route('metas.edit_metas')}}">Editar</a>
      </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{route('contatos.index')}}">
      <i class="fas fa-envelope"></i>
      <span>Contatos</span>
    </a>
  </li>
  {{-- <li class="nav-item">
    <a class="nav-link" href="{{route('categorias.index')}}">
      <i class="fas fa-list"></i>
      <span>Categorias</span>
    </a>
  </li> --}}
  <li class="nav-item">
    <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseCategoria" aria-expanded="false"
      aria-controls="collapseCategoria">
      <i class="fas fa-list"></i>
      <span>Categorias</span>
    </a>
    <div id="collapseCategoria" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{route('categorias.index')}}">Cadastrar</a>
        <a class="collapse-item" href="{{route('categorias.listar')}}">Listar</a>
      </div>
    </div>
  </li>
  <li class="nav-item">
    <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseArquivos" aria-expanded="false"
      aria-controls="collapseArquivos">
      <i class="fas fa-file-pdf"></i>
      <span>Arquivos</span>
    </a>
    <div id="collapseArquivos" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{route('arquivos.index')}}">Listar</a>
        <a class="collapse-item" href="{{route('arquivos.create')}}">Cadastrar</a>
      </div>
    </div>
  </li>
  <hr class="sidebar-divider">



  <!-- Divider -->

  <!-- Heading -->
  <div class="sidebar-heading">
    Funções
  </div>
  <li class="nav-item">
    <a class="nav-link" href="{{route('segmentos.index')}}">
      <i class="fas fa-code-branch"></i>
      <span>Segmentos</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{route('videos.index')}}">
      <i class="fab fa-youtube"></i>
      <span>Vídeos</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{route('cases.index')}}">
      <i class="fas fa-award"></i>
      <span>Cases</span>
    </a>
  </li>
  {{-- <li class="nav-item">
      <a class="nav-link" href="{{url('artlink')}}">
  <i class="fas fa-image"></i>
  <span>Artlink Eventos</span>
  </a>
  </li>
   <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>Eventos</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{url('artlink/eventos')}}">Cadastrar Eventos</a>
  <a class="collapse-item" href="{{url('/artlink/participantes')}}">Cadastrar Participantes</a>
  <a class="collapse-item" href="{{url('/artlink/categorias')}}">Cadastrar Categorias</a>
  </div>
  </div>
  </li> --}}

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->

