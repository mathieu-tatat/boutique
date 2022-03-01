<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Elements/CSS/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Elements/CSS/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
    crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3987504e8f.js" crossorigin="anonymous"></script>
    <title><?= $title ?></title>
</head>
<body>

    <header class="container-fluid">

            <div class="d-flex justify-content-center" id="navibar">
                <div class="d-flex justify-content-around">
                    <div class="col-md-4" id="headerleft">
                        <h2>TRADE </h2>
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">Accueil</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Shop</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Contacts</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Link4</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <form role="form">
                            <div class="form-group" id="headersearchbar">
                                <div class="input-group input-group-sm mb-3">
                                <input type="text" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="searchbtn">
                                <button type="submit" class="btn btn-secondary btn-sm">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4" id="headerright">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link active" href="#">API</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Help</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Sign in</a>
                            </li>
                            <li class="nav-item">
                                <form role="form">
                                    <input class="btn btn-dark" type="submit" value="Sign up" id="headersignbtn"/>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-3" id="headermediaqueries">
                <div id="upperheaderwrapper">
                    <div>
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    MENU
                                </a>
                                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                                    <li><a class="dropdown-item" href="#">Accueil</a></li>
                                    <li><a class="dropdown-item" href="#">Shop</a></li>
                                    <li><a class="dropdown-item" href="#">Contacts</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="headermediablockleft">
                        <h2>TRADE </h2>
                    </div>
                    <div class="headermediablockright">
                            <form role="form">
                                <input class="btn btn-dark" type="submit" value="Sign up" id="headersignbtn"/>
                            </form>
                    </div>
                </div> <!--upperheaderwrapper -->
                    <div id="lowerheaderwrapper">
                        <div class="headermediablockcenter">
                            <form role="form">
                                <div class="form-group" id="headersearchbarquery">
                                    <div class="input-group input-group-sm mb-3">
                                        <input type="text" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" id="searchbtn" placeholder=" search for a product...">
                                        <button type="submit" class="btn btn-secondary btn-sm" id="searchsubmitheader">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div> 
                    </div>
                </div>
            </div>


    </header>
    
    <main>
        <?= $content ?>
    </main>

    <footer >
        <nav class="d-flex flex-column align-items-center myFooter">
            <div class="d-flex justify-content-around align-items-start" id="bottomLinks">
                <a href="" class="d-flex justify-content-center align-items-center mx-2 textBox"><div class="text-center footerText">Produits</div></a>
                <a href="" class="d-flex justify-content-center align-items-center mx-2 textBox"><div class="text-center footerText">Profil</div></a>
                <a href="" class="d-flex justify-content-center align-items-center mx-4 my-0 textBox"><div class="text-center" id="footerCenterText">Trade</div></a>
                <a href="" class="d-flex justify-content-center align-items-center mx-2 textBox "><div class="text-center footerText">About us</div></a>
                <a href="" class="d-flex justify-content-center align-items-center mx-2 textBox "><div class="text-center footerText">Contact</div></a>
            </div>
            <div class="border-top border-secondary line"></div>
            <div class="d-flex flex-row justify-content-center my-2">
                <div class="border border-secondary pills mx-3"></div>
                <div class="border border-secondary pills mx-2"></div>
                <div class="border border-secondary pills mx-4"></div>
                <div class="border border-secondary pills mx-2"></div>
                <div class="border border-secondary pills mx-3"></div>
            </div>
            <div class="text-center ms-1">© 2022 - MGF</div>
        </nav>
    </footer>
    
</body>
</html>