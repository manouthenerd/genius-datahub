<script setup lang="ts">
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { BriefcaseBusiness, Building, LayoutGrid } from 'lucide-vue-next';

const user = usePage().props.auth.user;

const mainNavItems: NavItem[] = user.role == "member" ? [

    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'Tâches et projets ',
        href: '/tasks',
        icon: BriefcaseBusiness,
    },

] : [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'Services et membres',
        href: '/services',
        icon: Building,
    },
    {
        title: 'Tâches et projets ',
        href: '/tasks',
        icon: BriefcaseBusiness,
    },
];
</script>

<template>
    <Sidebar class="bg-[#0074B8]" collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                        <div>
                            <img class="w-[150px]" src="/image/logo-genius.png" alt="Logo de l'entreprise" />
                        </div>
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
