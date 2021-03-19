<!DOCTYPE html>
<html lang="en">

<head>
    
    @component('base.site.componentes.meta', ['metas' => $metas])
    @endcomponent

    @component('base.site.componentes.header')
    @endcomponent

</head>

<body>

    <div class="preloader-cover">
		<div id="cube-loader">
			<div class="caption">
				<div class="cube-loader">
					<div class="cube loader-1"></div>
					<div class="cube loader-2"></div>
					<div class="cube loader-4"></div>
					<div class="cube loader-3"></div>
				</div>
			</div>
		</div>
	</div>

    @yield('content')

    @component('base.site.componentes.footer', ["rodape" => $rodape, "contato" => $contato])
    @endcomponent

    {{--  @component('base.site.componentes.modal', ["modal" => $modal])
    @endcomponent  --}}

    @component('base.site.componentes.scripts')
    @endcomponent

</body>

</html>