<template>
    <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header">
            <div class="d-flex">
                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger shadow-none" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>
    
            <div class="d-flex align-items-center">
                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none" data-toggle="fullscreen" @click="initFullScreen">
                        <i class="bx bx-fullscreen fs-22"></i>
                    </button>
                </div>
                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class=" btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode shadow-none" @click="toggleDarkMode">
                        <i class="bx bx-moon fs-22"></i>
                    </button>
                </div>
                <div class="dropdown topbar-head-dropdown ms-1 header-item">
                <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-bell fs-22"></i>
                    <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-success">0<span class="visually-hidden">unread messages</span></span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                    <div class="dropdown-head bg-primary bg-pattern rounded-top">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 fs-16 fw-semibold text-white">
                                    Notifications
                                    </h6>
                                </div>
                                <!-- <div class="col-auto dropdown-tabs">
                                    <span class="badge badge-soft-light fs-13"> 4 New</span>
                                </div> -->
                            </div>
                        </div>
                        <div class="px-2 pt-2">
                            <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true" id="notificationItemsTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab" aria-selected="false" @click.capture.stop>
                                        Empty
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
    
                    <div class="tab-content" id="notificationItemsTabContent">
    
                    <div class="tab-pane fade py-2 ps-2 show active" id="all-noti-tab" role="tabpanel">
                        <SimpleBar data-simplebar style="max-height: 300px" class="pe-2">
                            <!-- <div class="text-reset notification-item d-block dropdown-item position-relative" v-for="(item,index) in 2" :key="index">
                                <div class="d-flex">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title bg-soft-danger text-danger rounded-circle fs-16">
                                            <i class="bx bx-message-square-dots"></i>
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <a href="#!" class="stretched-link">
                                            <h6 class="mt-0 mb-2 fs-13 lh-base">
                                                Invoice #50000{{ index+1 }}<br>Has been rejected
                                            </h6>
                                        </a>
                                        <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                            <span><i class="mdi mdi-clock-outline"></i> 2 hrs ago</span>
                                        </p>
                                    </div>
                                </div>
                            </div> -->
    
                            <div class="my-3 text-center">
                                <button type="button" class="btn btn-soft-success">
                                View All Notifications
                                <i class="ri-arrow-right-line align-middle"></i>
                                </button>
                            </div>
                        </SimpleBar>
                    </div>
    
                    <div class="tab-pane fade p-4" id="alerts-tab" role="tabpanel" aria-labelledby="alerts-tab">
                        <div class="w-25 w-sm-50 pt-3 mx-auto">
                        <img src="@/Assets/images/svg/bell.svg" class="img-fluid" alt="user-pic" />
                        </div>
                        <div class="text-center pb-5 mt-2">
                        <h6 class="fs-18 fw-semibold lh-base">
                            Hey! You have no any notifications
                        </h6>
                        </div>
                    </div>
    
                    </div>
                </div>
                </div>
    
                <div class="dropdown ms-sm-3 header-item topbar-user">
                <button type="button" class="btn shadow-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-flex align-items-center">
                    <img class="rounded-circle header-profile-user" src="@/Assets/images/users/user.png" :alt="$page.props.auth.user.name" />
                    <span class="text-start ms-xl-2">
                        <span class=" d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ $page.props.auth.user.name }}</span>
                        <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">{{ $page.props.auth.user.position_text }}</span>
                    </span>
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <h6 class="dropdown-header">Welcome {{ $page.props.auth.user.name }}!</h6>
                    <!-- <Link class="dropdown-item" :href="route('dashboard')">
                        <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                        <span class="align-middle">Profile</span>
                    </Link> -->
                    <Link class="dropdown-item" :href="route('dashboard')">
                        <i class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i>
                        <span class="align-middle">Help</span>
                    </Link>
                    <!-- <div class="dropdown-divider"></div>
                    <Link class="dropdown-item" :href="route('dashboard')">
                        <span class="badge bg-soft-success text-success mt-1 float-end">New</span>
                        <i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i>
                        <span class="align-middle">Settings</span>
                    </Link> -->
                    <Link :href="route('logout')" method="post" as="button" class="dropdown-item">
                        <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                        <span class="align-middle" data-key="t-logout">Logout</span>
                    </Link>
                </div>
                </div>
            </div>
            </div>
        </div>
    </header>
</template>
<script>
import { SimpleBar } from 'simplebar-vue3'
import { Link } from '@inertiajs/inertia-vue3'
export default{
    components: {
        Link,
        SimpleBar
    },
    mounted() {
        document.addEventListener("scroll", function () {
            var pageTopbar = document.getElementById("page-topbar");
            if (pageTopbar) {
            document.body.scrollTop >= 50 || document.documentElement.scrollTop >= 50 ? pageTopbar.classList.add(
                "topbar-shadow") : pageTopbar.classList.remove("topbar-shadow");
            }
        });
        if (document.getElementById("topnav-hamburger-icon"))
            document
            .getElementById("topnav-hamburger-icon")
            .addEventListener("click", this.toggleHamburgerMenu);
        this.initTopbarComponents();
    },
    methods: {
        toggleHamburgerMenu() {
            var windowSize = document.documentElement.clientWidth;

            if (windowSize > 767)
            document.querySelector(".hamburger-icon").classList.toggle("open");

            //For collapse horizontal menu
            if (
            document.documentElement.getAttribute("data-layout") === "horizontal"
            ) {
            document.body.classList.contains("menu") ?
                document.body.classList.remove("menu") :
                document.body.classList.add("menu");
            }

            //For collapse vertical menu
            if (document.documentElement.getAttribute("data-layout") === "vertical") {
            if (windowSize < 1025 && windowSize > 767) {
                document.body.classList.remove("vertical-sidebar-enable");
                document.documentElement.getAttribute("data-sidebar-size") == "sm" ?
                document.documentElement.setAttribute("data-sidebar-size", "") :
                document.documentElement.setAttribute("data-sidebar-size", "sm");
            } else if (windowSize > 1025) {
                document.body.classList.remove("vertical-sidebar-enable");
                document.documentElement.getAttribute("data-sidebar-size") === "lg" || document.documentElement.getAttribute("data-sidebar-size") === null ?
                document.documentElement.setAttribute("data-sidebar-size", "sm") :
                document.documentElement.setAttribute("data-sidebar-size", "lg");
            } else if (windowSize <= 767) {
                document.body.classList.add("vertical-sidebar-enable");
                document.documentElement.setAttribute("data-sidebar-size", "lg");
            }
            }

            //Two column menu
            if (document.documentElement.getAttribute("data-layout") == "twocolumn") {
            document.body.classList.contains("twocolumn-panel") ?
                document.body.classList.remove("twocolumn-panel") :
                document.body.classList.add("twocolumn-panel");
            }
        },
        toggleMenu() {
            this.$parent.toggleMenu();
        },
        toggleRightSidebar() {
            this.$parent.toggleRightSidebar();
        },
        initFullScreen() {
            document.body.classList.toggle("fullscreen-enable");
            if (
            !document.fullscreenElement &&
            /* alternative standard method */
            !document.mozFullScreenElement &&
            !document.webkitFullscreenElement
            ) {
            // current working methods
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullscreen) {
                document.documentElement.webkitRequestFullscreen(
                Element.ALLOW_KEYBOARD_INPUT
                );
            }
            } else {
            if (document.cancelFullScreen) {
                document.cancelFullScreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitCancelFullScreen) {
                document.webkitCancelFullScreen();
            }
            }
        },
        setLanguage(locale, country, flag) {
            this.lan = locale;
            this.text = country;
            this.flag = flag;
            document.getElementById("header-lang-img").setAttribute("src", flag);
            i18n.global.locale = locale;
        },
        toggleDarkMode() {
            if (document.documentElement.getAttribute("data-layout-mode") == "dark") {
            document.documentElement.setAttribute("data-layout-mode", "light");
            } else {
            document.documentElement.setAttribute("data-layout-mode", "dark");
            }
        },
        initTopbarComponents() {
            function updateCartPrice() {
            var currencySign = "$";
            var subtotal = 0;
            Array.from(document.getElementsByClassName("cart-item-price")).forEach(function (e) {
                subtotal += parseFloat(e.innerHTML);
            });
            if (document.getElementById("cart-item-total")) {
                document.getElementById("cart-item-total").innerHTML = currencySign + subtotal.toFixed(2);
            }
            }
            if (document.getElementsByClassName("dropdown-item-cart")) {
            var dropdownItemCart = document.querySelectorAll(".dropdown-item-cart").length;
            Array.from(document.querySelectorAll("#page-topbar .dropdown-menu-cart .remove-item-btn")).forEach(function (item) {
                item.addEventListener("click", function () {
                dropdownItemCart--;
                this.closest(".dropdown-item-cart").remove();
                Array.from(document.getElementsByClassName("cartitem-badge")).forEach(function (e) {
                    e.innerHTML = dropdownItemCart;
                });
                updateCartPrice();
                if (document.getElementById("empty-cart")) {
                    document.getElementById("empty-cart").style.display = dropdownItemCart == 0 ? "block" : "none";
                }
                if (document.getElementById("checkout-elem")) {
                    document.getElementById("checkout-elem").style.display = dropdownItemCart == 0 ? "none" : "block";
                }
                });
            });
            Array.from(document.getElementsByClassName("cartitem-badge")).forEach(function (e) {
                e.innerHTML = dropdownItemCart;
            });
            if (document.getElementById("empty-cart")) {
                document.getElementById("empty-cart").style.display = "none";
            }
            if (document.getElementById("checkout-elem")) {
                document.getElementById("checkout-elem").style.display = "block";
            }
            updateCartPrice();
            }

            // notification messages
            if (document.getElementsByClassName("notification-check")) {
            Array.from(document.querySelectorAll(".notification-check input")).forEach(function (element) {
                element.addEventListener("click", function (el) {
                el.target.closest(".notification-item").classList.toggle("active");
                });
            });
            }
        }
    },
}
</script>
