<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { Progress } from '@/components/ui/progress';
import { ArrowUpRight, Building, FolderClosedIcon, FileArchiveIcon, UsersRound } from 'lucide-vue-next';
import Folder from '@/components/ui/Folder.vue';
import { computed } from 'vue';
import ExplorerTable from '@/components/ExplorerTable.vue';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

const page = usePage();
const user =  page.props.auth.user;

const getUser = computed(() => {
    return user.role
});
</script>
<template>

    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <!-- Box 1 -->
                <div class="grid">
                    <p class="text-gray-400 text-xs">Projets</p>
                    <div
                        class="h-[100px] bg-orange-200 p-2 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                        <div class="flex justify-between items-center">
                            <p class="text-2xl">06 Projets</p>
                            <Link>
                            <ArrowUpRight color="#FF6900" />
                            </Link>
                        </div>
                        <div class="mt-4 flex justify-between items-center">
                            <Progress class="w-1/2" :model-value="20" />
                            <p class="font-bold text-xs">
                                01/06
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Box 2 -->
                <div class="grid">
                    <p class="text-gray-400 text-xs">Tâches</p>
                    <div
                        class="h-[100px] bg-blue-50 p-2 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                        <div class="flex justify-between items-center">
                            <p class="text-2xl">120 tâches</p>
                            <Link>
                            <ArrowUpRight color="#0074B8" />
                            </Link>
                        </div>
                        <div class="mt-4 flex justify-between items-center">
                            <Progress class="w-1/2" :model-value="20" />
                            <p class="font-bold text-xs">
                                40/120
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Box 3  #c3beff -->
                <div class="grid">
                    <p class="text-slate-400 text-xs">Données & services</p>
                    <div
                        class="h-[100px] bg-[#bedaff] p-2 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                        <div class="flex justify-between items-center">
                            <div class="text-2xl grid place-content-center">
                                <p class="font-bold">02</p>
                                <Building class="mt-2 hover:stroke-[#162456]" />
                            </div>
                            <div class="text-2xl grid place-content-center">
                                <p class="font-bold">02</p>
                                <UsersRound class="mt-2 hover:stroke-[#162456]" />
                            </div>
                            <div class="text-2xl grid place-content-center">
                                <p class="font-bold">10</p>
                                <FolderClosedIcon class="mt-2 hover:stroke-[#162456]" />
                            </div>
                            <div class="text-2xl grid place-content-center">
                                <p class="font-bold">250</p>
                                <FileArchiveIcon class="mt-2 hover:stroke-[#162456]" />
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <p class="text-gray-400 text-xs">Ressources partagées</p>
            <div class="flex-1 bg-white p-1">
                <div class="rounded-xl  border-sidebar-border/70 dark:border-sidebar-border">
                    <ScrollArea class="h-50 rounded">
                        <table v-if="getUser == 'admin'" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <!-- TODO Faire passer les avatars en dessous du thead -->
                            <tbody>
                                <div class="flex flex-wrap gap-2 p-2">
                                    <Link v-for="folder in 10" :key="folder" class="grid justify-items-center">
                                    <Folder />
                                    <p class="w-[130px] text-ellipsis text-nowrap overflow-hidden text-xs">Service
                                        Communication</p>
                                    </Link>
                                </div>
                            </tbody>
                        </table>

                        <ExplorerTable v-if="getUser == 'member' || getUser == 'moderator'">

                        </ExplorerTable>


                    </ScrollArea>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
