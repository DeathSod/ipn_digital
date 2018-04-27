<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('title')
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <body>
        <div class="bg-init">
            <header>
                <nav class="navbar navbar-dark bg-dark fixed-top justify-content-between">
                    <a class="navbar-brand" href="#">IPN Digital</a>
                    <div class="form-box">
                        <ul class="login-register row">
                            <form class="form-inline" action="./includes/login.php" method="POST" accept-charset="utf-8">
                                @csrf
                                <li><div class="form-check">
                                    <label class="form-check-label mr-2" for="rememberMe" style="color:#fff;font-family: 'GO'">Remember Me?</label>
                                    <input class="form-check-input" type="checkbox" id="rememberMe" value="1">
                                </div></li>
                                <li><input class="form-control form-control-sm" type="text" name="user" placeholder="Enter Email" required="true"></li>
                                <li><input class="form-control form-control-sm" type="password" name="password" placeholder=" Enter Password" required="true"></li>
                                <li><button class="btn btn-outline-light" type="submit" name="login">Log In</button></li>
                            </form>
                            <li><a href="/register"><button class="btn btn-outline-light">Register Now</button></a></li>
                        </ul>
                    </div>
                </nav>
            </header>
        </div>
        @yield('content')
        <footer>
            <div class="footer-info">
                <div class="footer-div row text-center">
                    <div class="links-container col-md-4 offset-md-1 row">
                        <div class="links-section col-md-4" id="items-1st">
                            <p>Section 1</p>
                            <hr class="footer-hr">
                            <ul>
                                <a href="#"><li>Link 1</li></a>
                                <a href="#"><li>Link 2</li></a>
                                <a href="#"><li>Link 3</li></a>
                                <a href="#"><li>Link 4</li></a>
                            </ul>
                        </div>
                        <div class="links-section col-md-4">
                            <p>Section 2</p>
                            <hr class="footer-hr">
                            <ul>
                                <a href="#"><li>Link 1</li></a>
                                <a href="#"><li>Link 2</li></a>
                                <a href="#"><li>Link 3</li></a>
                                <a href="#"><li>Link 4</li></a>
                            </ul>
                        </div>
                        <div class="links-section col-md-4" id="items-last">
                            <p>Section 3</p>
                            <hr class="footer-hr">
                            <ul>
                                <a href="#"><li>Link 1</li></a>
                                <a href="#"><li>Link 2</li></a>
                                <a href="#"><li>Link 3</li></a>
                                <a href="#"><li>Link 4</li></a>
                            </ul>
                        </div>
                    </div>
                    <div class="offset-md-2 col-md-4">
                        <div class="sn-container">
                            <h4 class="sn-info">You can find us here</h4>
                            <button class=""><i class="icon fab fa-facebook-f"></i></button>
                            <button><i class="icon fab fa-instagram"></i></button>
                            <button><i class="icon fab fa-twitter"></i></button>
                            <button ><i class="icon fab fa-linkedin-in"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom text-center">
                <p>Here goes the &copy; 2018 - IPN Digital</p>
            </div>
        </footer>
        <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>