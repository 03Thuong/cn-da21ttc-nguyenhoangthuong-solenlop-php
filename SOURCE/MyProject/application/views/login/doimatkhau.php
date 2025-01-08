<body>
    <!-- partial:index.partial.html -->
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form class="login-change" method="post" action="<?php echo base_url('Doimatkhau/change_password'); ?>">
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" class="login__input" placeholder="Username"
                            value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" readonly>
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" name="new_password" class="login__input" placeholder="New Password"
                            id="password" required>
                         <!--<i class="login__icon fas fa-eye" id="togglePassword"></i> -->
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" name="confirm_password" class="login__input"
                            placeholder="Confirm New Password" id="password" required>
                            <!--<i class="login__icon fas fa-eye" id="togglePassword"></i> -->
                    </div>
                   
                    <button class="button login__submit">
                        <span class="button__text">Change Password </span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                </form>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>