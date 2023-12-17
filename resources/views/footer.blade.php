<footer class="bg-dark py-4 mt-auto">
    <div class="container px-5">
        <div class="d-flex align-items-center justify-content-between flex-column flex-md-row text-lg-start text-center">
            <div class="col-auto"><div class="small m-0 text-white">Copyright &copy; BitCritic 2023</div></div>
            <div class="col-auto sm-text-center">
                {{-- <a class="link-light small" href="https://forms.gle/nEm4ERmr5WGV5uFG8" target="_blank">Recomendar Juego</a> --}}
                <a class="link-light small" href="{{ url("/Ayuda_de_la_Aplicación_BitCritic_17-12-2023.pdf") }}" target="_blank">Ayuda de la Aplicación</a>
                <span class="text-white mx-1">&middot;</span>
                <a class="link-light small" href="{{ Route('policy.show') }}" target="_blank">Política de Privacidad</a>
                <span class="text-white mx-1">&middot;</span>
                <a class="link-light small" href="{{ Route('terms.show') }}" target="_blank">Términos y Condiciones</a>
                @guest
                    
                @else
                    <span class="text-white mx-1">&middot;</span>
                    <a class="link-light small" href="{{ url("/logout")}}">Cerrar Sesión</a>
                @endguest
                
            </div>
        </div>
    </div>
</footer>