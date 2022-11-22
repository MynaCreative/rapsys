<template>
    <div class="container-fluid">
        <div id="two-column-menu"></div>
        <ul class="navbar-nav h-100" id="navbar-nav">
            <li class="menu-title">
                <span data-key="t-menu">Menu</span>
            </li>
            <li class="nav-item">
                <Link href="/dashboard" :class="['nav-link menu-link',{ active: route().current('dashboard') }]">
                <i class="ri-home-3-line"></i>
                    <span>Dashboard</span>
                </Link>
            </li>
            <li class="nav-item">
                <Link class="nav-link menu-link" href="/dashboard">
                    <i class="ri-pencil-ruler-2-line"></i>
                    <span>Approval</span>
                    <span class="badge badge-pill bg-danger" data-key="t-new">2</span>
                </Link>
            </li>
            <li class="menu-title">
                <i class="ri-more-fill"></i>
                <span data-key="t-pages">Transactions</span>
            </li>
            <li class="nav-item">
                <Link class="nav-link menu-link" href="/dashboard">
                    <i class="ri-newspaper-line"></i>
                    <span>Invoice</span>
                </Link>
            </li>
            <li class="nav-item">
                <Link class="nav-link menu-link" href="/dashboard">
                    <i class="ri-file-list-3-line"></i>
                    <span>Reports</span>
                </Link>
            </li>
            <li class="menu-title">
                <i class="ri-more-fill"></i>
                <span data-key="t-pages">Masters</span>
            </li>
            <li class="nav-item">
                <Link :class="['nav-link menu-link', {active: route().current('master.item-expenses.index')}]" :href="route('master.item-expenses.index')">
                    <i class="ri-honour-line"></i>
                    <span>Item Expenses</span>
                </Link>
            </li>
            <li class="nav-item">
                <Link class="nav-link menu-link" href="/masters/area">
                    <i class=" ri-map-pin-5-line"></i>
                    <span>Area</span>
                </Link>
            </li>
            <li class="nav-item">
                <Link class="nav-link menu-link" href="/masters/product">
                    <i class="ri-apps-line"></i>
                    <span>Product / Project</span>
                </Link>
            </li>
            <li class="nav-item">
                <Link class="nav-link menu-link" href="/masters/department">
                    <i class="ri-building-2-line"></i>
                    <span>Department</span>
                </Link>
            </li>
            <li class="nav-item">
                <Link class="nav-link menu-link" href="/masters/vendor">
                    <i class="ri-building-4-line"></i>
                    <span>Vendor</span>
                </Link>
            </li>
            <li class="nav-item">
                <Link class="nav-link menu-link" href="/masters/invoice-type">
                    <i class="ri-notification-badge-line"></i>
                    <span>Invoice Type</span>
                </Link>
            </li>
            <li class="nav-item">
                <Link class="nav-link menu-link" href="/masters/item-line-type">
                    <i class="ri-list-check-2"></i>
                    <span>Item Line Type</span>
                </Link>
            </li>
            <li class="nav-item">
                <Link class="nav-link menu-link" href="/masters/currency">
                    <i class="ri-copper-coin-line"></i>
                    <span>Currency</span>
                </Link>
            </li>
            <li class="nav-item">
                <Link class="nav-link menu-link" href="/masters/term">
                    <i class="ri-alarm-warning-line"></i>
                    <span>Term</span>
                </Link>
            </li>
            <li class="nav-item">
                <Link class="nav-link menu-link" href="/masters/tax">
                    <i class=" ri-money-dollar-circle-line"></i>
                    <span>Tax</span>
                </Link>
            </li>
            <li class="nav-item">
                <Link class="nav-link menu-link" href="/masters/sales-channel">
                    <i class="ri-shopping-bag-2-line"></i>
                    <span>Sales Channel</span>
                </Link>
            </li>
            <li class="menu-title">
                <i class="ri-more-fill"></i>
                <span data-key="t-components">Settings</span>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="#sub-administrator" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sub-administrator">
                    <i class="ri-account-circle-line"></i>
                    <span data-key="t-authentication">Administrator</span>
                </a>
                <div class="collapse menu-dropdown" id="sub-administrator">
                <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                        <Link href="/dashboard" class="nav-link">User</Link>
                        <Link href="/dashboard" class="nav-link">Role</Link>
                        <Link href="/dashboard" class="nav-link">Permission</Link>
                        <Link :href="route('master.permission-groups.index')" class="nav-link">Permission Group</Link>
                        <Link href="/dashboard" class="nav-link">Approval Matrix</Link>
                    </li>
                </ul>
                </div>
            </li>
            <li class="nav-item">
                <Link class="nav-link menu-link" href="/dashboard">
                    <i class="ri-settings-line"></i>
                    <span>Configuration</span>
                </Link>
            </li>
            <li class="menu-title">
                <i class="ri-more-fill"></i>
                <span data-key="t-components">Helps</span>
            </li>
            <li class="nav-item">
                <Link class="nav-link menu-link" href="/dashboard">
                    <i class="ri-book-3-line"></i>
                    <span>Dictionary</span>
                </Link>
            </li>
            <li class="nav-item">
                <Link class="nav-link menu-link" href="/dashboard">
                    <i class="ri-book-open-line"></i>
                    <span>User Manual</span>
                </Link>
            </li>
        </ul>
    </div>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3'
export default {
    components: {
        Link
    },
    mounted() {
        if (document.querySelectorAll(".navbar-nav .collapse")) {
            let collapses = document.querySelectorAll(".navbar-nav .collapse");
            collapses.forEach((collapse) => {
                // Hide sibling collapses on `show.bs.collapse`
                collapse.addEventListener("show.bs.collapse", (e) => {
                e.stopPropagation();
                let closestCollapse = collapse.parentElement.closest(".collapse");
                if (closestCollapse) {
                    let siblingCollapses =
                    closestCollapse.querySelectorAll(".collapse");
                    siblingCollapses.forEach((siblingCollapse) => {
                    if (siblingCollapse.classList.contains("show")) {
                        siblingCollapse.classList.remove("show");
                    }
                    });
                } else {
                    let getSiblings = (elem) => {
                    // Setup siblings array and get the first sibling
                    let siblings = [];
                    let sibling = elem.parentNode.firstChild;
                    // Loop through each sibling and push to the array
                    while (sibling) {
                        if (sibling.nodeType === 1 && sibling !== elem) {
                        siblings.push(sibling);
                        }
                        sibling = sibling.nextSibling;
                    }
                    return siblings;
                    };
                    let siblings = getSiblings(collapse.parentElement);
                    siblings.forEach((item) => {
                    if (item.childNodes.length > 2)
                        item.firstElementChild.setAttribute("aria-expanded", "false");
                    let ids = item.querySelectorAll("*[id]");
                    ids.forEach((item1) => {
                        item1.classList.remove("show");
                        if (item1.childNodes.length > 2) {
                        let val = item1.querySelectorAll("ul li a");

                        val.forEach((subitem) => {
                            if (subitem.hasAttribute("aria-expanded"))
                            subitem.setAttribute("aria-expanded", "false");
                        });
                        }
                    });
                    });
                }
                });

                // Hide nested collapses on `hide.bs.collapse`
                collapse.addEventListener("hide.bs.collapse", (e) => {
                e.stopPropagation();
                let childCollapses = collapse.querySelectorAll(".collapse");
                childCollapses.forEach((childCollapse) => {
                    let childCollapseInstance = childCollapse;
                    childCollapseInstance.hide();
                });
                });
            });
        }
    },
}
</script>