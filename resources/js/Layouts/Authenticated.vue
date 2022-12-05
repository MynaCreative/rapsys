<template>
    <div id="layout-wrapper">
        <NavBar />
        <div>
            <div class="app-menu navbar-menu">
                <div class="navbar-brand-box">
                    <Link href="/" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="@/Assets/images/logo-sm.png" alt="" height="22" />
                        </span>
                        <span class="logo-lg">
                            <img src="@/Assets/images/logo-dark.png" alt="" height="38" />
                        </span>
                    </Link>
                    <Link href="/" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="@/Assets/images/logo-sm.png" alt="" height="22" />
                        </span>
                        <span class="logo-lg">
                            <img src="@/Assets/images/logo-light.png" alt="" height="38" />
                        </span>
                    </Link>
                    <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover" @click="initActiveMenu">
                        <i class="ri-record-circle-line"></i>
                    </button>
                </div>
                <SimpleBar id="scrollbar" class="h-100" ref="scrollbar">
                    <Menu></Menu>
                </SimpleBar>
                <div class="sidebar-background"></div>
            </div>
            <div class="vertical-overlay" id="overlay"></div>
        </div>    
        <div class="main-content">
            <div class="page-content">
                <b-container :toast="{root: true}" fluid>
                    <slot />
                </b-container>
            </div>
            <Footer />
        </div>
    </div>
</template>
<script setup>
import { Link, usePage } from '@inertiajs/inertia-vue3'
import { SimpleBar } from 'simplebar-vue3'
import Swal from 'sweetalert2'
import { watch } from 'vue'

import NavBar from '@/Components/NavBar.vue'
import Footer from '@/Components/Footer.vue'
import Menu from '@/Components/Menu.vue'

const props = usePage().props

watch(props, (prop) => {
    if(prop.flash.success){
        Swal.fire('Success!',prop.flash.success, 'success')
    }
})
</script>
