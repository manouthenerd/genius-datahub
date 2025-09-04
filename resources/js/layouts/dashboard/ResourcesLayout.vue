<script setup lang="ts">
import { Progress } from '@/components/ui/progress';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { ArrowUpRight, Building, FileArchiveIcon, FolderClosedIcon, UsersRound } from 'lucide-vue-next';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];
</script>
<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <!-- Box 1 -->
                <div class="grid">
                    <p class="text-xs text-gray-400">Projets</p>
                    <div
                        style="box-shadow: 1px 1px 1px #9c9595"
                        class="h-[100px] rounded-xl border border-sidebar-border/70 bg-[#f0d792] p-2 dark:border-sidebar-border"
                    >
                        <div class="flex items-center justify-between">
                            <p class="text-2xl">06 Projets</p>
                            <Link>
                                <ArrowUpRight color="#020201FF" />
                            </Link>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <Progress class="w-1/2" :model-value="20" />
                            <p class="text-xs font-bold">01/06</p>
                        </div>
                    </div>
                </div>

                <!-- Box 2 -->
                <div class="grid">
                    <p class="text-xs text-gray-400">Tâches</p>
                    <div
                        style="box-shadow: 1px 1px 1px #9c9595"
                        class="h-[100px] rounded-xl border border-sidebar-border/70 bg-blue-50 p-2 dark:border-sidebar-border"
                    >
                        <div class="flex items-center justify-between">
                            <p class="text-2xl">120 tâches</p>
                            <Link>
                                <ArrowUpRight color="#0074B8" />
                            </Link>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <Progress class="w-1/2" :model-value="20" />
                            <p class="text-xs font-bold">40/120</p>
                        </div>
                    </div>
                </div>

                <!-- Box 3  #c3beff -->
                <div class="grid">
                    <p class="text-xs text-slate-400">Données & services</p>
                    <div
                        style="box-shadow: 1px 1px 1px #9c9595"
                        class="h-[100px] rounded-xl border border-sidebar-border/70 bg-[#bedaff] p-2 dark:border-sidebar-border"
                    >
                        <div class="flex items-center justify-between">
                            <div class="grid place-content-center text-2xl">
                                <p class="font-bold">02</p>
                                <Building class="mt-2 hover:stroke-[#162456]" />
                            </div>
                            <div class="grid place-content-center text-2xl">
                                <p class="font-bold">02</p>
                                <UsersRound class="mt-2 hover:stroke-[#162456]" />
                            </div>
                            <div class="grid place-content-center text-2xl">
                                <p class="font-bold">10</p>
                                <FolderClosedIcon class="mt-2 hover:stroke-[#162456]" />
                            </div>
                            <div class="grid place-content-center text-2xl">
                                <p class="font-bold">250</p>
                                <FileArchiveIcon class="mt-2 hover:stroke-[#162456]" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <p class="text-xs text-gray-400">Ressources partagées</p>
            <div class="flex-1 bg-white p-1">
                <div class="rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                    <ScrollArea class="h-50 rounded">
                        <slot />
                    </ScrollArea>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
