<?php
  error_reporting(0);
session_start();
if(!$_SESSION['username']) {
    
  } else {
    header('Location: /home.php');
  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["user"];
    $password = $_POST["pass"];

    $users = file("doc/users.txt", FILE_IGNORE_NEW_LINES);

    foreach ($users as $user) {
        $userData = explode(" | ", $user);
        if (count($userData) >= 3) {
            $storedId = $userData[0];
            $storedUsername = $userData[1];
            $storedHashedPassword = $userData[2];
            $rank = $userData[4];

            if ($username === $storedUsername && password_verify($password, $storedHashedPassword)) {
                $_SESSION['id'] = $storedId;
                $_SESSION['username'] = $username;
                $_SESSION['rank'] = $rank;
                $expire = time() + (365 * 24 * 60 * 60);
                setcookie(session_name(), session_id(), $expire, "/");
                header("Location: /home.php?u=". $username);
                exit;
            }
        }
    }

    echo "Incorrect username/password";
}
?>

<!DOCTYPE html>
<html>
    <title>EPIK17</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,requiresActiveX=true">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="EPIK17 Corporation">
    <meta name="description" content="EPIK17 is powered by a growing community of over 300,000 creators who produce an infinite variety of highly immersive experiences. These experiences range from 3D multiplayer games and competitions, to interactive adventures where friends can take on new personas imagining what it would be like to be a dinosaur, a miner in a quarry or an astronaut on a space exploration.">
    <meta name="keywords" content="free games, online games, building games, virtual worlds, free mmo, gaming cloud, physics engine">
    <meta name="apple-itunes-app" content="app-id=431946152">
    <meta name="google-site-verification" content="KjufnQUaDv5nXJogvDMey4G-Kb7ceUVxTdzcMaP9pCY">

    <link href="https://favicon-generator.org/favicon-generator/htdocs/favicons/2024-02-09/fb00deb4b8dd45936cd508808bc5c047.ico.png" rel="icon">
        <link href="http://web.archive.org/web/20160326041110cs_/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,500,600,700" rel="stylesheet" type="text/css">

        <link rel="canonical" href="http://web.archive.org/web/20160326041110/https://www.roblox.com/upgrades/robux">
    
    
<link rel="stylesheet" href="/content/css/loggedout.css">

<link onerror="Roblox.BundleDetector &amp;&amp; Roblox.BundleDetector.reportBundleError(this)" rel="stylesheet" href="https://web.archive.org/web/20181117191546cs_/https://static.rbxcdn.com/css/page___5d305651f254e21058914b7b9b0083ff_m.css/fetch">
    
    
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        




    
    
    

    
            



        

    

    



</head>
<body id="rbx-body" class="" data-performance-relative-value="0.5" data-internal-page-name="Robux" data-send-event-percentage="0">





     
    <div id="roblox-linkify" data-enabled="true" data-regex="(https?\:\/\/)?(?:www\.)?([a-z0-9\-]{2,}\.)*(((m|de|www|web|api|blog|wiki|help|corp|polls|bloxcon|developer|devforum|forum)\.roblox\.com|robloxlabs\.com)|(www\.shoproblox\.com))((\/[A-Za-z0-9-+&amp;@#\/%?=~_|!:,.;]*)|(\b|\s))" data-regex-flags="gm"></div>

<div id="image-retry-data" data-image-retry-max-times="10" data-image-retry-timer="1500">
</div>
    
    


<div id="fb-root"></div>

<div id="wrap" class="wrap no-gutter-ads logged-out" data-gutter-ads-enabled="false">


<div class="modalPopup unifiedModal smallModal shop-modal shop-modal-item" data-modal-handle="shop-confirmation" style="display: none;">
    <div class="shop-modal-item-right">

    </div>
    <div class="shop-modal-item-left">
        <h2>
            You are about to visit<br>our shopping site
        </h2>
        <div class="body-text">
            You will be redirected to the shopping<br>site. Please note that you must be 18<br> or over to buy online.
        </div>
        <div class="controls">
            <a id="rbx-shopping-close-btn" class="text-link btn-shopping-close">Close</a>
            <div id="rbx-continue-shopping-btn" class="btn btn-medium btn-neutral btn-secondary-xs btn-more btn-continue-shopping">Continue to Shop</div>
        </div>
        <div class="text-date-hint fine-print">
            The shop is not part of ROBLOX.com and is governed by a separate <a class="text-link" href="http://web.archive.org/web/20160326041110/http://www.myplay.com/direct/cookie-policy?origin=desktop&amp;permalink=shoproblox" target="_blank">privacy policy</a>.
        </div>
    </div>
</div>

<div id="header" class="navbar-fixed-top rbx-header" role="navigation">
    <div class="container-fluid">
        <div class="rbx-navbar-header">
            <div data-behavior="nav-notification" class="rbx-nav-collapse">

                <div class="rbx-nav-notification hide xsmall" title="0">
                    
                </div>

            </div>
            <div class="navbar-header">
                <a class="navbar-brand" href=""><span class="logo logo-transitional"></span></a>
            </div>
        </div>
        <ul class="nav rbx-navbar hidden-xs hidden-sm col-md-4 col-lg-3">
            <li>
                <a href="/games">Games</a>
            </li>
            <li>
                <a href="/Catalog">Catalog</a>
            </li>
            <li>
                <a href="">Develop</a>
            </li>
            <li>
                <a class="buy-robux" href="/epikbux.php">EPIKBUX</a>
            </li>
        </ul><!--rbx-navbar-->
    


    <div id="navbar-universal-search" class="navbar-left rbx-navbar-search col-xs-5 col-sm-6 col-md-3" data-behavior="univeral-search" role="search">
            <div class="input-group rbx-input-group">

                <input id="navbar-search-input" class="form-control input-field" type="text" placeholder="Search" maxlength="120">
                <div class="input-group-btn rbx-input-group-btn">
                    <button id="navbar-search-btn" class="rbx-input-addon-btn" type="submit">
                        <span class="icon-nav-search"></span>
                    </button>
                </div>
            </div>
            <ul data-toggle="dropdown-menu" class="rbx-dropdown-menu" role="menu">
                <li class="rbx-navbar-search-option selected" data-searchurl="http://www.roblox.com/search/users?keyword=">
                    <span class="rbx-navbar-search-text">Search <span class="rbx-navbar-search-string"></span> in People</span>
                </li>
                        <li class="rbx-navbar-search-option" data-searchurl="https://www.roblox.com/games/?Keyword=">
                            <span class="rbx-navbar-search-text">Search <span class="rbx-navbar-search-string"></span> in Games</span>
                        </li>
                        <li class="rbx-navbar-search-option" data-searchurl="http://www.roblox.com/catalog/browse.aspx?CatalogContext=1&amp;Keyword=">
                            <span class="rbx-navbar-search-text">Search <span class="rbx-navbar-search-string"></span> in Catalog</span>
                        </li>
                        <li class="rbx-navbar-search-option" data-searchurl="http://www.roblox.com/groups/search.aspx?val=">
                            <span class="rbx-navbar-search-text">Search <span class="rbx-navbar-search-string"></span> in Groups</span>
                        </li>
                        <li class="rbx-navbar-search-option" data-searchurl="http://www.roblox.com/develop/library?CatalogContext=2&amp;Category=6&amp;Keyword=">
                            <span class="rbx-navbar-search-text">Search <span class="rbx-navbar-search-string"></span> in Library</span>
                        </li>
            </ul>
        </div><!--rbx-navbar-search-->
        <div class="navbar-right rbx-navbar-right col-xs-4 col-sm-3">
                <ul class="nav navbar-right rbx-navbar-right-nav" data-display-opened="False">
                        <li>
                        <a id="header-login" href="/login.php" class="rbx-navbar-login" data-behavior="login" data-toggle="popover" data-bind="popover-login" data-viewport="#header">Log In</a>
                    </li>
                    <div id="iFrameLogin" class="rbx-popover-content" data-toggle="popover-login" role="menu">
                        <iframe id="iframe-login" name="iframe-nav-login" class="rbx-navbar-login-iframe" src="https://ep7.ct8.pl/login.php" scrolling="no" frameborder="0" width="320" data-ruffle-polyfilled=""></iframe>
                    </div>
                    <li>
                        <a class="rbx-navbar-signup" href="/register.php">Sign Up</a>
                    </li>
                    <li class="rbx-navbar-right-search" data-toggle="toggle-search">
                        <a class="rbx-menu-icon">
                            <span class="icon-nav-search-white"></span>
                        </a>
                    </li>
                </ul>
        </div><!-- navbar right-->
        <ul class="nav rbx-navbar hidden-md hidden-lg col-xs-12">
            <li>
                <a href="/games">Games</a>
            </li>
            <li>
                <a href="/Catalog/">Catalog</a>
            </li>
            <li>
                <a href="/">Develop</a>
            </li>
            <li>
                <a class="buy-robux" href="/Upgrades/robux?ctx=nav">Upgrades</a>
            </li>
        </ul><!--rbx-navbar-->
    </div>
</div>
    
  <div class="container-main content ">

                                        <script src="https://web.archive.org/web/20181117191546js_/https://www.google.com/recaptcha/api.js?render=explicit" async="" defer=""></script>
<script type="text/javascript">
    var Roblox = Roblox || {};
    $(function () {
        var captcha = Roblox.Captcha;
        //set captcha values
        captcha.setInvisibleMode("true" === "true" ? true : false);
        captcha.setSiteKey("6LcpwSQUAAAAAPN5nICO6tHekrkrSIYvsl9jAPW4");
        var types = ["Login"];
        captcha.setMultipleEndpoints(types, "https://web.archive.org/web/20181117191546/https://api.roblox.com/captcha/validate/login");
        //for truly invisible
        var trulyInvisibleEnabled = "false" === "true";
        if (trulyInvisibleEnabled) {
            var trulyInvisibleCaptchaContainer = "truly-invisible-captcha";
            var elem = $("#" + trulyInvisibleCaptchaContainer);
            if (elem.length) {
                Roblox.Captcha.renderTrulyInvisible(trulyInvisibleCaptchaContainer, types[0]);
            }
        }
    });
</script>
<div id="login-container" class="login-container ng-scope">
    <login-page params="{&quot;Context&quot;:&quot;loginPage&quot;,&quot;CaptchaId&quot;:null,&quot;IsFacebookSignInEnabled&quot;:true,&quot;UseFacebookRedirect&quot;:false,&quot;RedirectToHomePostLogin&quot;:true,&quot;CaptchaApiUrl&quot;:&quot;https://api.roblox.com/captcha/validate/login&quot;,&quot;ReturnUrl&quot;:&quot;https://www.roblox.com/gamecard/Default.aspx&quot;,&quot;SamlRequest&quot;:null,&quot;SamlRelayState&quot;:null,&quot;Username&quot;:null,&quot;CType&quot;:null,&quot;ErrorCode&quot;:null,&quot;RedirectToLoginPageOnError&quot;:false,&quot;RedirectToLoginPageWhenUsernameIsRequired&quot;:false,&quot;IncludeMessageBanner&quot;:true}" class="ng-isolate-scope">
        <div class="section-content login-section">
            <h2 class="login-header ng-binding" ng-bind="'Heading.LoginRoblox'|translate">Login to EPIK17</h2>
            <login-form params="$ctrl.params" class="ng-isolate-scope">
               
                <div class="login-form-container">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="form-group username-form-group"><input id="login-username" name="user" type="text" class="form-control input-field ng-pristine ng-untouched ng-valid ng-empty" placeholder="Username/Email/Phone" ng-model="$ctrl.credentialValue" ng-keypress="$ctrl.clearError()" rbx-form-interaction=""></div>
                        <div class="form-group password-form-group"><input id="login-password" name="pass" type="password" class="form-control input-field ng-pristine ng-untouched ng-valid ng-empty" placeholder="Password" ng-model="$ctrl.password" key-press-enter="$ctrl.submit(true)" ng-keypress="$ctrl.clearError()" rbx-form-interaction="">
                            <p class="form-control-label xsmall text-error login-error ng-binding" ng-bind="$ctrl.error"></p>
                        </div>
                        <div toggle-loading="" is-loading="$ctrl.isProcessing"><button id="login-button" class="btn-full-width login-button ng-binding btn-secondary-md" ng-class="$ctrl.usePrimaryButtonClass?'btn-primary-md':'btn-secondary-md'" ng-bind="'Action.LogInCapitalized'|translate" ng-click="$ctrl.submit(true)">Log In</button></div>
                        <div class="spinner spinner-sm spinner-no-margin spinner-block" style="display: none;"></div>
                        <div class="text-center forgot-credentials-link"><a id="forgot-credentials-link" class="text-link ng-binding" href="" ng-bind="'Action.ForgotPasswordOrUsernameQuestionCapitalized'|translate">Forgot Password or Username?</a></div>
                    </form><!-- ngIf: $ctrl.params.IsFacebookSignInEnabled -->
                    <div ng-if="$ctrl.params.IsFacebookSignInEnabled" class="ng-scope">
                        <div class="fb-divider-container">
                            <div class="rbx-divider fb-divider"></div>
                            <div class="divider-text-container"><span class="divider-text xsmall ng-binding" ng-bind="'Label.LoginWithYour'|translate">login with your</span></div>
                        </div><!-- ngIf: !$ctrl.params.UseFacebookRedirect --><button id="facebook-login-button" ng-if="!$ctrl.params.UseFacebookRedirect" class="btn-full-width btn-control-md fb-button social-login ng-scope" data-rbx-provider="facebook"><span class="fb-icon"></span> <span ng-bind="'Action.Facebook'|translate" class="ng-binding">Facebook</span></button><!-- end ngIf: !$ctrl.params.UseFacebookRedirect -->
                        <!-- ngIf: $ctrl.params.UseFacebookRedirect -->
                    </div><!-- end ngIf: $ctrl.params.IsFacebookSignInEnabled -->
                </div>
                <div captcha="" captcha-model="$ctrl.captchaSetting" captcha-type="$ctrl.captchaSetting.captchaType" on-captcha-success="$ctrl.captchaSetting.successCB" on-captcha-error="$ctrl.captchaSetting.errorCB">
                    <div id="login-captcha" ng-show="captchaElem.isVisible" class="ng-hide"></div>
                </div><!-- ngIf: $ctrl.params.SamlRequest -->
            </login-form>
        </div>
        <div class="text-center">
            <div class="signup-option"><span class="no-account-text ng-binding" ng-bind="'Label.NoAccount'|translate">Don't have an account?</span> <a id="sign-up-link" class="text-link signup-link ng-binding" href="https://web.archive.org/web/20181117191546/https://www.roblox.com/account/signupredir?returnUrl=https%3A%2F%2Fwww.roblox.com%2Fgamecard%2FDefault.aspx" ng-bind="'Action.SignUpCapitalized'|translate">Sign Up</a></div>
        </div>
    </login-page>
</div>



<script>
    var Roblox = Roblox || {};
    Roblox.LoginMeta = {
        signupUrl: "https://web.archive.org/web/20181117191546/https://www.roblox.com/account/signupredir",
        forgotCredentialsUrl: "https://web.archive.org/web/20181117191546/https://www.roblox.com/login/forgot-password-or-username",
        homeUrl: "https://web.archive.org/web/20181117191546/https://www.roblox.com/home",
        securityNotificationUrl: "https://web.archive.org/web/20181117191546/https://www.roblox.com/login/securitynotification",
        apiProxyUrl: "https://web.archive.org/web/20181117191546/https://api.roblox.com",
        fbSignInUrl: "https://web.archive.org/web/20181117191546/https://www.roblox.com/social/redirect-to-facebook",
        loginPageUrl: "https://web.archive.org/web/20181117191546/https://www.roblox.com/newlogin",
        isLoginWithEmailEnabled: true,
        isLoginWithPhoneEnabled: true,
        isPromptUnverifiedEmailsEnabled: true
    };
</script>

        <script type="text/javascript" src="https://web.archive.org/web/20181117191546js_/https://cdns.gigya.com/js/gigya.js?apiKey=3_OsvmtBbTg6S_EUbwTPtbbmoihFY5ON6v6hbVrTbuqpBs7SyF_LQaJwtwKJ60sY1p" async="" defer="">
            {
                bypassCookiePolicy: 'never'
            }
        </script>


<div id="SocialIdentitiesInformation" data-rbx-login-redirect-url="/social/postlogin" data-context="loginPage">
</div>
            
        </div>

    </div>
  </div>
</div>


<script type="text/javascript" src="https://js.rbxcdn.com/e2cb6070c58f829226a04307a3f3e28a.js.gzip"></script>



<script type="text/javascript">
    var Roblox = Roblox || {};
    Roblox.jsConsoleEnabled = false;
</script>


    <script type="text/javascript">
        $(function () {
            Roblox.CookieUpgrader.domain = 'roblox.com';
            Roblox.CookieUpgrader.upgrade("GuestData", { expires: Roblox.CookieUpgrader.thirtyYearsFromNow });
            Roblox.CookieUpgrader.upgrade("RBXSource", { expires: function (cookie) { return Roblox.CookieUpgrader.getExpirationFromCookieValue("rbx_acquisition_time", cookie); } });
            Roblox.CookieUpgrader.upgrade("RBXViralAcquisition", { expires: function (cookie) { return Roblox.CookieUpgrader.getExpirationFromCookieValue("time", cookie); } });

                Roblox.CookieUpgrader.upgrade("RBXMarketing", { expires: Roblox.CookieUpgrader.thirtyYearsFromNow });


                Roblox.CookieUpgrader.upgrade("RBXSessionTracker", { expires: Roblox.CookieUpgrader.fourHoursFromNow });


                Roblox.CookieUpgrader.upgrade("RBXEventTrackerV2", {expires: Roblox.CookieUpgrader.thirtyYearsFromNow});

        });
    </script>



    <script type="text/javascript" src="https://js.rbxcdn.com/d849afd828ec9246ad457b640dbb54b3.js.gzip"></script>



<script type="text/javascript" src="https://js.rbxcdn.com/d03710605a8eb25ee026670046b51a9a.js.gzip"></script>
        <div ng-modules="templateApp" class="ng-scope">
            <!-- Template bundle: base -->
<script type="text/javascript">
"use strict"; angular.module("templateApp", []).run(['$templateCache', function($templateCache) {

 }]);
</script>

            <!-- Template bundle: page -->
<script type="text/javascript">
"use strict"; angular.module("templateApp", []).run(['$templateCache', function($templateCache) {

 }]);
</script>

        </div>
    <script type="text/javascript" src="https://js.rbxcdn.com/8ac2a4e48584e739bed7e94652afbf52.js.gzip"></script>
        <script type="text/javascript" src="https://js.rbxcdn.com/3da61c013993a1c4a66392c7e2b11b22.js.gzip"></script>



    <script type="text/javascript">Roblox.config.externalResources = [];Roblox.config.paths['Pages.Catalog'] = 'https://js.rbxcdn.com/f27ab562314284f6db31a6b309af5085.js.gzip';Roblox.config.paths['Pages.CatalogShared'] = 'https://js.rbxcdn.com/3c98e9fd0b1301c457d4dab1df00b796.js.gzip';Roblox.config.paths['Widgets.AvatarImage'] = 'https://js.rbxcdn.com/823c7d686e6b3d8321275740fe498f9d.js.gzip';Roblox.config.paths['Widgets.DropdownMenu'] = 'https://js.rbxcdn.com/5cf0eb71249768c86649bbf0c98591b0.js.gzip';Roblox.config.paths['Widgets.GroupImage'] = 'https://js.rbxcdn.com/556af22c86bce192fb12defcd4d2121c.js.gzip';Roblox.config.paths['Widgets.HierarchicalDropdown'] = 'https://js.rbxcdn.com/7689b2fd3f7467640cda2d19e5968409.js.gzip';Roblox.config.paths['Widgets.ItemImage'] = 'https://js.rbxcdn.com/c2aa2fcc2b1e8ec82e1bacfdb9dfffea.js.gzip';Roblox.config.paths['Widgets.PlaceImage'] = 'https://js.rbxcdn.com/52ff803e77bb661839e8b2c93bb5ba27.js.gzip';Roblox.config.paths['Widgets.SurveyModal'] = 'https://js.rbxcdn.com/56ad7af86ee4f8bc82af94269ed50148.js.gzip';</script>


    <script>
        Roblox.XsrfToken.setToken('q/ZM1ETKuCQ4');
    </script>

        <script>
            $(function () {
                Roblox.DeveloperConsoleWarning.showWarning();
            });
        </script>
    <script type="text/javascript">
    $(function () {
        Roblox.JSErrorTracker.initialize({ 'suppressConsoleError': true});
    });
</script>

<script type="text/javascript">
    $(function(){
        function trackReturns() {
            function dayDiff(d1, d2) {
                return Math.floor((d1-d2)/86400000);
            }
            if (!localStorage) {
                return false;
            }

            var cookieName = 'RBXReturn';
            var cookieOptions = {expires:9001};
            var cookieStr = localStorage.getItem(cookieName) || "";
            var cookie = {};

            try {
                cookie = JSON.parse(cookieStr);
            } catch (ex) {
                // busted cookie string from old previous version of the code
            }

            try {
                if (typeof cookie.ts === "undefined" || isNaN(new Date(cookie.ts))) {
                    localStorage.setItem(cookieName, JSON.stringify({ ts: new Date().toDateString() }));
                    return false;
                }
            } catch (ex) {
                return false;
            }

            var daysSinceFirstVisit = dayDiff(new Date(), new Date(cookie.ts));
            if (daysSinceFirstVisit == 1 && typeof cookie.odr === "undefined") {
                RobloxEventManager.triggerEvent('rbx_evt_odr', {});
                cookie.odr = 1;
            }
            if (daysSinceFirstVisit >= 1 && daysSinceFirstVisit <= 7 && typeof cookie.sdr === "undefined") {
                RobloxEventManager.triggerEvent('rbx_evt_sdr', {});
                cookie.sdr = 1;
            }
            try {
                localStorage.setItem(cookieName, JSON.stringify(cookie));
            } catch (ex) {
                return false;
            }
        }

        GoogleListener.init();



        RobloxEventManager.initialize(true);
        RobloxEventManager.triggerEvent('rbx_evt_pageview');
        trackReturns();



        RobloxEventManager._idleInterval = 450000;
        RobloxEventManager.registerCookieStoreEvent('rbx_evt_initial_install_start');
        RobloxEventManager.registerCookieStoreEvent('rbx_evt_ftp');
        RobloxEventManager.registerCookieStoreEvent('rbx_evt_initial_install_success');
        RobloxEventManager.registerCookieStoreEvent('rbx_evt_fmp');
        RobloxEventManager.startMonitor();


    });

</script>





<script type="text/javascript">
    var Roblox = Roblox || {};
    Roblox.UpsellAdModal = Roblox.UpsellAdModal || {};

    Roblox.UpsellAdModal.Resources = {
        //<sl:translate>
        title: "Remove Ads Like This",
        body: "Builders Club members do not see external ads like these.",
        accept: "Upgrade Now",
        decline: "No, thanks"
        //</sl:translate>
    };
</script>


    <script type="text/javascript" src="https://js.rbxcdn.com/083bdeec0fffe305fb4684b7ecb55299.js.gzip"></script>


<script type="text/javascript" src="https://js.rbxcdn.com/5926309ff55b06c732ffe910f2100b1e.js.gzip"></script>

<script type="text/javascript" src="https://js.rbxcdn.com/b1a389c995e5a832c76249e69701d023.js.gzip"></script>

<div id="push-notification-registrar-settings" data-notificationshost="https://notifications.roblox.com" data-reregistrationinterval="0" data-registrationpath="register-chrome" data-shoulddeliveryendpointbesentduringregistration="False" data-platformtype="ChromeOnDesktop">
</div>
<div id="push-notification-registration-ui-settings" data-noncontextualpromptallowed="true" data-promptonfriendrequestsentenabled="true" data-promptonprivatemessagesentenabled="false" data-promptintervals="[604800000,1209600000,2419200000]" data-notificationsdomain="https://notifications.roblox.com" data-userid="168914479">
</div>

<script type="text/template" id="push-notifications-initial-global-prompt-template">
    <div class="push-notifications-global-prompt">
        <div class="alert-info push-notifications-global-prompt-site-wide-body">
            <div class="push-notifications-prompt-content">
                <h5>
                    <span class="push-notifications-prompt-text">
                        Can we send you notifications on this computer?
                    </span>
                </h5>
            </div>
            <div class="push-notifications-prompt-actions">
                <button type="button" class="btn-fixed-width btn-control-xs push-notifications-prompt-accept">Notify Me</button>
                <span class="icon-close-white push-notifications-dismiss-prompt"></span>
            </div>
        </div>
    </div>
</script>
<script type="text/template" id="push-notifications-permissions-prompt-template">
    <div class="modal fade" id="push-notifications-permissions-prompt-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog rbx-modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">
                            <span class="icon-close"></span>
                        </span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h5>Enable Desktop Push Notifications</h5>
                </div>
                <div class="modal-body">
                        <div>
                            Now just click <strong>Allow</strong> in your browser, and we'll start sending you push notifications!
                        </div>
                        <div class="push-notifications-permissions-prompt-instructional-image">
                                <img width="380" height="250" src="https://static.rbxcdn.com/images/Notifications/push-permission-prompt-chrome-windows-20160701.png" />
                        </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</script>
<script type="text/template" id="push-notifications-permissions-disabled-instruction-template">
    <div class="modal fade" id="push-notifications-permissions-disabled-instruction-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog rbx-modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">
                            <span class="icon-close"></span>
                        </span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h5>Turn Push Notifications Back On</h5>
                </div>
                <div class="instructions-body">
                    <div class="reenable-step reenable-step1-of3">
                        <h1>1</h1>
                            <p class="larger-font-size push-notifications-modal-step-instruction">Click the green lock next to the URL bar to open up your site permissions.</p>
                            <img width="270" height="139" src="https://static.rbxcdn.com/images/Notifications/push-permission-unblock-step1-chrome-20160701.png">
                    </div>
                    <div class="reenable-step reenable-step2-of3">
                        <h1>2</h1>
                            <p class="larger-font-size push-notifications-modal-step-instruction">Click the drop-down arrow next to Notifications in the <strong>Permissions</strong> tab.</p>
                            <img width="270" height="229" src="https://static.rbxcdn.com/images/Notifications/push-permission-unblock-step2-chrome-20160701.png">
                    </div>
                    <div class="reenable-step reenable-step3-of3">
                        <h1>3</h1>
                            <p class="larger-font-size push-notifications-modal-step-instruction">Select <strong>Always allow on this site</strong> to turn notifications back on.</p>
                            <img width="270" height="229" src="https://static.rbxcdn.com/images/Notifications/push-permission-unblock-step3-chrome-20160701.png">
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</script>
<script type="text/template" id="push-notifications-successfully-enabled-template">
    <div class="push-notifications-global-prompt">
        <div class="alert-system-feedback">
            <div class="alert alert-success">
                Push notifications have been enabled!
            </div>
        </div>
    </div>
</script>
<script type="text/template" id="push-notifications-successfully-disabled-template">
    <div class="push-notifications-global-prompt">
        <div class="alert-system-feedback">
            <div class="alert alert-success">
                Push notifications have been disabled.
            </div>
        </div>
    </div>
</script>
        <script>
        var _comscore = _comscore || [];
        _comscore.push({ c1: "2", c2: "6035605", c3: "", c4: "", c15: "Over13" });

        (function() {
            var s = document.createElement("script"), el = document.getElementsByTagName("script")[0];
            s.async = true;
            s.src = (document.location.protocol == "https:" ? "https://sb" : "http://b") + ".scorecardresearch.com/beacon.js";
            el.parentNode.insertBefore(s, el);
        })();
    </script>
    <noscript>
        <img src="http://b.scorecardresearch.com/p?c1=2&amp;c2=&amp;c3=&amp;c4=&amp;c5=&amp;c6=&amp;c15=&amp;cv=2.0&amp;cj=1"/&gt;
    </noscript>

</body></html>
  
  
