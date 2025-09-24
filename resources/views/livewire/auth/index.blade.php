<div>

    <style>
        .auth-card .auth-card__header {
            border: 0 !important;
            padding: 3rem 3rem 0 !important;
        }

        .bg-white {
            --bs-bg-opacity: 1 !important;
            background-color: rgba(var(--bs-white-rgb), var(--bs-bg-opacity)) !important;
        }

        .auth-card .text-primary {
            color: #fcb800 !important;
        }
    </style>
    <div class="ps-container">
        <div class="mt-40 mb-40">
            <div class="ps-my-account">
                <div class="container">
                    <div class="row justify-content-center py-5">
                        <div class="col-xl-6 col-lg-8">
                            <div class="auth-card card">
                                <div class="auth-card__header">
                                    <div class="d-flex flex-column flex-md-row align-items-start gap-3">
                                        <div class="auth-card__header-icon bg-white p-3 rounded"><svg class="icon text-primary svg-icon-ti-ti-lock" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z"></path>
                                                <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"></path>
                                                <path d="M8 11v-4a4 4 0 1 1 8 0v4"></path>
                                            </svg></div>
                                        <div>
                                            <h3 class="auth-card__header-title fs-4 mb-1">Login to your account</h3>
                                            <p class="auth-card__header-description text-muted">Your personal data will be used to support your experience throughout this website, to manage access to your account.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="auth-card__body">
                                    <form method="POST" action="{{ route('validatelogin') }}" accept-charset="UTF-8" id="botble-ecommerce-forms-fronts-auth-login-form" class="js-base-form ps-form--account dirty-check" icon="ti ti-lock">
                                        @csrf
                                        <div class="mb-3 position-relative"><label class="form-label" for="email"> Email / Noreg </label>
                                            <div class="position-relative"><input class="form-control ps-5" data-counter="60" placeholder="Email/Noreg" name="login" type="text" id="login" data-gtm-form-interact-field-id="0"></div>
                                        </div>

                                        <div class="mb-3 position-relative"><label class="form-label" for="password"> Password </label>
                                            <div class="position-relative">
                                                <div class="input-group"><input type="password" name="password" id="password" value="" class="form-control ps-5" data-counter="250" placeholder="Password" data-bb-password=""><span class="input-password-toggle" data-bb-toggle-password="" data-initialized="true"><svg class="icon svg-icon-ti-ti-eye" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                                                        </svg></span></div>
                                            </div>
                                        </div>
                                        <style>
                                            .input-password-toggle {
                                                position: absolute;
                                                right: 0;
                                                top: 0;
                                                cursor: pointer;
                                                padding: 10px 15px;
                                                z-index: 9;
                                            }

                                            input[data-bb-password]:valid,
                                            input[data-bb-password].is-valid {
                                                background-image: unset;
                                            }

                                            body[dir="rtl"] .input-password-toggle {
                                                right: unset;
                                                left: 0;
                                            }
                                        </style>

                                        <div class="row g-0 mb-3">
                                            <div class="col-6">
                                                <div class="ps-checkbox"><input class="form-control" type="checkbox" name="remember" id="remember-me"><label for="remember-me" class="control-label">Remember me</label></div>
                                            </div>
                                            <div class="col-6 text-end"><a href="https://martfury.botble.com/password/reset" class="text-decoration-underline">Forgot password?</a></div>
                                        </div>
                                        <div class="d-grid mb-5"><button class="ps-btn ps-btn--fullwidth" type="submit">Login<svg class="icon svg-icon-ti-ti-arrow-narrow-right" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M5 12l14 0"></path>
                                                    <path d="M15 16l4 -4"></path>
                                                    <path d="M15 8l4 4"></path>
                                                </svg></button></div>

                                        <div class="row">
                                            @if ($errors->has('login'))
                                            <div class="alert alert-danger">
                                                {{ $errors->first('login') }}
                                            </div>
                                            @endif
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>