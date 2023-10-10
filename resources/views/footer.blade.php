<footer class="bg-dark py-4 mt-auto">
    <div class="container px-5">
        <div class="row align-items-center justify-content-between flex-column flex-sm-row">
            <div class="col-auto"><div class="small m-0 text-white">Copyright &copy; BitCritic 2023</div></div>
            <div class="col-auto">
                <a class="link-light small" href="https://forms.gle/nEm4ERmr5WGV5uFG8" target="_blank">Recomendar Juego</a>
                @guest
                    
                @else
                    <span class="text-white mx-1">&middot;</span>
                    <a class="link-light small" href="{{ url("/logout")}}">Cerrar Sesión</a>
                @endguest
                
            </div>
        </div>
    </div>
</footer>