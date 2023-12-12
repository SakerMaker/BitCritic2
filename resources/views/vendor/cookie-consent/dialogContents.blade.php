<div class="fixed-bottom w-75 mx-auto bg-primary m-2 rounded-3 px-4 py-3 cookies-modal shadow">
    <div class="js-cookie-consent cookie-consent">
        <div class="mx-auto">
            <div class="p-2">
                <div class="d-flex text-center justify-content-around flex-wrap">
                    <div class="text-center">
                        <p class="ml-3 text-light cookie-consent__message">
                            {!! trans('cookie-consent::texts.message') !!}
                        </p>
                    </div>
                    <div class="mt-1 w-full d-block ms-auto">
                        <button class="js-cookie-consent-agree cookie-consent__agree cursor-pointer btn btn-light">
                            {{ trans('cookie-consent::texts.agree') }}
                        </button>
                    </div>
                </div>
                <a href="/politica-de-cookies" class="text-white-50 d-block pt-2">Ver Política de Cookies</a>
            </div>
        </div>
    </div>
</div>