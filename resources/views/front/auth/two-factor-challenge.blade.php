<x-front-layout title="2FA Challange">

    <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" action="{{ route('two-factor.login') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="title">
                                <h3>2FA Challange</h3>
                                <p>You Must Enter 2FA Code</p>
                            </div>
                            <div class="alt-option">
                                @if ($errors->has('code'))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('code') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group input-group">
                                <label for="reg-fn">2FA Code</label>
                                <input class="form-control" type="text" name="code" id="reg-email" >
                            </div>
                            <div class="form-group input-group">
                                <label for="reg-fn">Recovery Code</label>
                                <input class="form-control" type="text" name="recovery_code" id="reg-recovery_code" >
                            </div>

                        </div>
                        <div class="button">
                            <button class="btn" type="submit">Submit</button>
                        </div>

                        </p>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- End Account Login Area -->
</x-front-layout>
