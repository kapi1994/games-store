<main class="container">
    <div class="row mt-5">
        <div class="col-lg-4 col-10 mx-auto">
            <form action="#">
                <div class="mb-3">
                    <label for="email-login" class="mb-2">Email</label>
                    <input type="text" name="-login" id="email-login" class="form-control">
                    <em id="email-login-error"></em>
                </div>
                <div class="mb-3">
                    <label for="password-login" class="mb-2">Password</label>
                    <input type="password" name="password-login" id="password-login" class="form-control">
                    <em id="password-login-error"></em>
                </div>
                <div class="d-grid"><button class="btn btn-primary" type="button" id="btnLogin">Login</button></div>
                <div class="d-flex justify-content-center mt-2">
                    <span class="me-2">Don't have an account?</span>
                    <a href="index.php?page=register">Register</a>
                </div>
            </form>
        </div>
    </div>
</main>