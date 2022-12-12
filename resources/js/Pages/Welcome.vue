<template>
    <Head title="Welcome" />
    <div class="auth-page-wrapper pt-5">
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 pt-4 mb-4">
                            <div class="mb-sm-5 pb-sm-4 pb-5">
                                <img src="@/Assets/images/logo-light.png" alt="" class="move-animation">
                                <p class="mt-3 fs-15 fw-medium text-white">[ RPX AP Invoice System ]</p>
                            </div>
                            <div class="mb-5" style="padding-top:15px !important">
                                <h1 class="display-2 coming-soon-text">Coming Soon</h1>
                            </div>
                            <div>
                                <div class="row justify-content-center mt-5">
                                    <div class="col-lg-8">
                                        <div id="countdown" class="countdownlist"></div>
                                    </div>
                                </div>
                                <div class="mt-5">
                                    <h4>Get notified when this system launch</h4>
                                    <p class="text-muted">For now in the development period please try :</p>
                                </div>
                                <div v-if="canLogin">
                                    <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</Link>
                                    <template v-else>
                                        <Link :href="route('login')" class="fw-semibold text-primary text-decoration-underline">Log in</Link>
                                        <!-- Or
                                        <Link v-if="canRegister" :href="route('register')" class="fw-semibold text-primary text-decoration-underline">Register</Link> -->
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">
                                RPX AP Invoice System &copy; {{ new Date().getFullYear() }} RPX. All Rights Reserved.
                                Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>
<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3'

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
})

// Set the date we're counting down to
var countDownDate = new Date("Jan 10, 2023").getTime();

// Update the count down every 1 second
var countDown = setInterval(function () {
    // Get today's date and time
    var currentTime = new Date().getTime();

    // Find the distance between currentTime and the count down date
    var distance = countDownDate - currentTime;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor(
        (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
    );
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    var countDownBlock =
        '<div class="countdownlist-item">' +
        '<div class="count-title">Days</div>' +
        '<div class="count-num">' +
        days +
        "</div>" +
        "</div>" +
        '<div class="countdownlist-item">' +
        '<div class="count-title">Hours</div>' +
        '<div class="count-num">' +
        hours +
        "</div>" +
        "</div>" +
        '<div class="countdownlist-item">' +
        '<div class="count-title">Minutes</div>' +
        '<div class="count-num">' +
        minutes +
        "</div>" +
        "</div>" +
        '<div class="countdownlist-item">' +
        '<div class="count-title">Seconds</div>' +
        '<div class="count-num">' +
        seconds +
        "</div>" +
        "</div>";

    // Output the result in an element with id="countDownBlock"
    if (document.getElementById("countdown")) {
        document.getElementById("countdown").innerHTML = countDownBlock;
    }
    // If the count down is over, write some text
    if (distance < 0) {
        clearInterval(countDown);
        document.getElementById("countdown").innerHTML = '<div class="countdown-endtxt">The countdown has ended!</div>';
    }
}, 1000);
</script>
