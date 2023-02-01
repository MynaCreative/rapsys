<template>
    <div class="container-fluid">
        <div id="two-column-menu"></div>
        <ul class="navbar-nav h-100" id="navbar-nav">
            <li class="menu-title">
                <span data-key="t-menu">General</span>
            </li>
            <MenuItem route-name="dashboard" name="Dashboard" icon="ri-home-3-line"/>
            <!-- <MenuItem route-name="dashboard" name="Approval" icon="ri-mail-line" :permission="$page.props.auth.permissions.includes('approval')"/> -->
            <li class="nav-item" v-if="$page.props.auth.roles.includes('Administrator') || $page.props.auth.permissions.includes('approval')">
                <Link class="nav-link menu-link" href="/">
                    <i class="ri-mail-line"></i>
                    <span>Approval</span>
                    <span class="badge badge-pill bg-success">0</span>
                </Link>
            </li>
            <li class="menu-title" v-if="hasAnyPermission([
                'invoice',
                'report',
            ])">
                <i class="ri-more-fill"></i>
                <span data-key="t-pages">Transaction</span>
            </li>
            <MenuItem route-name="transaction.invoices.index" name="Invoice" icon="ri-newspaper-line" :permission="$page.props.auth.permissions.includes('invoice')"/>
            <MenuItem route-name="transaction.report.index" name="Report" icon="ri-file-list-3-line" :permission="$page.props.auth.permissions.includes('report')"/>
            <li class="menu-title" v-if="hasAnyPermission([
                'expense',
                'area',
                'product',
                'department',
                'sales-channel',
                'vendor',
                'invoice-type',
                'line-type',
                'currency',
                'term',
                'tax',
                'withholding',
                'sbu',
                'interco',
                'ops-plan',
            ])">
                <i class="ri-more-fill"></i>
                <span data-key="t-pages">Master</span>
            </li>
            <MenuItem route-name="master.expenses.index" name="Expense" icon="ri-honour-line" :permission="$page.props.auth.permissions.includes('expense')"/>
            <MenuItem route-name="master.areas.index" name="Area" icon="ri-map-pin-5-line" :permission="$page.props.auth.permissions.includes('area')"/>
            <MenuItem route-name="master.products.index" name="Product / Project" icon="ri-apps-line" :permission="$page.props.auth.permissions.includes('product')"/>
            <MenuItem route-name="master.departments.index" name="Department" icon="ri-building-2-line" :permission="$page.props.auth.permissions.includes('department')"/>
            <MenuItem route-name="master.sales-channels.index" name="Sales Channel" icon="ri-shopping-bag-2-line" :permission="$page.props.auth.permissions.includes('sales-channel')"/>
            <MenuItem route-name="master.vendors.index" name="Vendor" icon="ri-building-4-line" :permission="$page.props.auth.permissions.includes('vendor')"/>
            <MenuItem route-name="master.invoice-types.index" name="Invoice Type" icon="ri-notification-badge-line" :permission="$page.props.auth.permissions.includes('invoice-type')"/>
            <MenuItem route-name="master.line-types.index" name="Line Type" icon="ri-list-check-2" :permission="$page.props.auth.permissions.includes('line-type')"/>
            <MenuItem route-name="master.currencies.index" name="Currency" icon="ri-copper-coin-line" :permission="$page.props.auth.permissions.includes('currency')"/>
            <MenuItem route-name="master.terms.index" name="Term" icon="ri-alarm-warning-line" :permission="$page.props.auth.permissions.includes('term')"/>
            <MenuItem route-name="master.taxes.index" name="Tax" icon="ri-money-dollar-circle-line" :permission="$page.props.auth.permissions.includes('tax')"/>
            <MenuItem route-name="master.withholdings.index" name="Withholding" icon="ri-money-dollar-box-line" :permission="$page.props.auth.permissions.includes('withholding')"/>
            <MenuItem route-name="master.sbus.index" name="Sbu" icon="ri-store-3-line" :permission="$page.props.auth.permissions.includes('sbu')"/>
            <MenuItem route-name="master.intercos.index" name="Interco" icon="ri-luggage-deposit-line" :permission="$page.props.auth.permissions.includes('interco')"/>
            <MenuItem route-name="master.ops-plans.index" name="Ops Plan" icon="ri-store-3-line" :permission="$page.props.auth.permissions.includes('ops-plan')"/>
            <li class="menu-title" v-if="hasAnyPermission([
                'user',
                'role',
                'permission',
                'permission-group',
                'workflow',
            ])">
                <i class="ri-more-fill"></i>
                <span data-key="t-components">Setting</span>
            </li>
            <li class="nav-item" v-if="hasAnyPermission([
                'user',
                'role',
                'permission',
                'permission-group',
            ])">
                <a :class="['nav-link menu-link', {active: route().current().startsWith('setting.administrator')}]"
                :aria-expanded="route().current().startsWith('setting.administrator')"
                href="#setting-administrator" data-bs-toggle="collapse" role="button" aria-controls="setting-administrator">
                    <i class="ri-account-circle-line"></i>
                    <span data-key="t-authentication">Administrator</span>
                </a>
                <div :class="['collapse menu-dropdown', {show: route().current().startsWith('setting.administrator')}]" id="setting-administrator">
                    <ul class="nav nav-sm flex-column">
                        <MenuItem route-name="setting.administrator.users.index" name="User" :permission="$page.props.auth.permissions.includes('user')"/>
                        <MenuItem route-name="setting.administrator.roles.index" name="Role" :permission="$page.props.auth.permissions.includes('role')"/>
                        <MenuItem route-name="setting.administrator.permissions.index" name="Permission" :permission="$page.props.auth.permissions.includes('permission')"/>
                        <MenuItem route-name="setting.administrator.permission-groups.index" name="Permission Group" :permission="$page.props.auth.permissions.includes('permission-group')"/>
                    </ul>
                </div>
            </li>
            <li class="nav-item" v-if="hasAnyPermission([
                'delta',
            ])">
                <a :class="['nav-link menu-link', {active: route().current().startsWith('setting.delta')}]"
                :aria-expanded="route().current().startsWith('setting.delta')"
                href="#setting-delta" data-bs-toggle="collapse" role="button" aria-controls="setting-delta">
                    <i class="ri-settings-line"></i>
                    <span data-key="t-authentication">Delta Testing</span>
                </a>
                <div :class="['collapse menu-dropdown', {show: route().current().startsWith('setting.delta')}]" id="setting-delta">
                    <ul class="nav nav-sm flex-column">
                        <MenuItem route-name="setting.delta.smu" name="SMU" :permission="$page.props.auth.permissions.includes('delta')"/>
                        <MenuItem route-name="setting.delta.awb" name="AWB" :permission="$page.props.auth.permissions.includes('delta')"/>
                        <MenuItem route-name="setting.delta.awb-detail" name="AWB Detail" :permission="$page.props.auth.permissions.includes('delta')"/>
                        <MenuItem route-name="setting.delta.awb-batch" name="AWB Batch" :permission="$page.props.auth.permissions.includes('delta')"/>
                    </ul>
                </div>
            </li>
            <li class="nav-item" v-if="hasAnyPermission([
                'workflow',
            ])">
                <a :class="['nav-link menu-link', {active: route().current().startsWith('setting.configuration')}]"
                :aria-expanded="route().current().startsWith('setting.configuration')"
                href="#setting-configuration" data-bs-toggle="collapse" role="button" aria-controls="setting-configuration">
                    <i class="ri-settings-3-line"></i>
                    <span data-key="t-authentication">Configuration</span>
                </a>
                <div :class="['collapse menu-dropdown', {show: route().current().startsWith('setting.configuration')}]" id="setting-configuration">
                    <ul class="nav nav-sm flex-column">
                        <MenuItem route-name="setting.configuration.workflows.index" name="Workflow" :permission="$page.props.auth.permissions.includes('workflow')"/>
                    </ul>
                </div>
            </li>
            <li class="menu-title">
                <i class="ri-more-fill"></i>
                <span data-key="t-components">Helps</span>
            </li>
            <li class="nav-item">
                <Link class="nav-link menu-link" href="/">
                    <i class="ri-book-3-line"></i>
                    <span>Dictionary</span>
                </Link>
            </li>
            <li class="nav-item">
                <Link class="nav-link menu-link" href="/">
                    <i class="ri-book-open-line"></i>
                    <span>User Manual</span>
                </Link>
            </li>
        </ul>
    </div>
</template>
<script>
import { Link } from '@inertiajs/vue3'
import MenuItem from './MenuItem.vue'
export default {
    components: {
        Link,
        MenuItem
    },
    mounted() {
        if (document.querySelectorAll(".navbar-nav .collapse")) {
            let collapses = document.querySelectorAll(".navbar-nav .collapse")
            collapses.forEach((collapse) => {
                // Hide sibling collapses on `show.bs.collapse`
                collapse.addEventListener("show.bs.collapse", (e) => {
                    e.stopPropagation()
                    let closestCollapse = collapse.parentElement.closest(".collapse")
                    if (closestCollapse) {
                        let siblingCollapses = closestCollapse.querySelectorAll(".collapse")
                        siblingCollapses.forEach((siblingCollapse) => {
                            if (siblingCollapse.classList.contains("show")) {
                                siblingCollapse.classList.remove("show")
                            }
                        })
                    } else {
                        let getSiblings = (elem) => {
                            // Setup siblings array and get the first sibling
                            let siblings = []
                            let sibling = elem.parentNode.firstChild
                            // Loop through each sibling and push to the array
                            while (sibling) {
                                if (sibling.nodeType === 1 && sibling !== elem) {
                                    siblings.push(sibling)
                                }
                                sibling = sibling.nextSibling
                            }
                            return siblings
                        }
                        let siblings = getSiblings(collapse.parentElement)
                        siblings.forEach((item) => {
                            if (item.childNodes.length > 2)
                                item.firstElementChild.setAttribute("aria-expanded", "false")
                            let ids = item.querySelectorAll("*[id]")
                            ids.forEach((item1) => {
                                item1.classList.remove("show")
                                if (item1.childNodes.length > 2) {
                                    let val = item1.querySelectorAll("ul li a")

                                    val.forEach((subitem) => {
                                        if (subitem.hasAttribute("aria-expanded"))
                                        subitem.setAttribute("aria-expanded", "false")
                                    })
                                }
                            })
                        })
                    }
                })

                // Hide nested collapses on `hide.bs.collapse`
                collapse.addEventListener("hide.bs.collapse", (e) => {
                    e.stopPropagation()
                    let childCollapses = collapse.querySelectorAll(".collapse")
                    childCollapses.forEach((childCollapse) => {
                        let childCollapseInstance = childCollapse
                        childCollapseInstance.hide()
                    })
                })
            })
        }
    },
    methods:{
        hasAnyPermission(permissions) {
            let hasAdministrator = this.$page.props.auth.roles.includes('Administrator')
            let allPermissions = this.$page.props.auth.permissions
            let hasPermission = false
            for (const item of permissions) {  
                if (allPermissions.includes(item) || hasAdministrator){
                    hasPermission = true
                    break
                }
            }
            return hasPermission
        }
    }
}
</script>
