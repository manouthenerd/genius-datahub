<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { Progress } from '@/components/ui/progress';
import { BarChart } from "@/components/ui/chart-bar"
import { ArrowUpRight, Building, FolderClosedIcon, FileArchiveIcon } from 'lucide-vue-next';

const data = [
    { name: "Jan", total: Math.floor(Math.random() * 2000) + 500, predicted: Math.floor(Math.random() * 2000) + 500 },
    { name: "Feb", total: Math.floor(Math.random() * 2000) + 500, predicted: Math.floor(Math.random() * 2000) + 500 },
    { name: "Mar", total: Math.floor(Math.random() * 2000) + 500, predicted: Math.floor(Math.random() * 2000) + 500 },
    { name: "Apr", total: Math.floor(Math.random() * 2000) + 500, predicted: Math.floor(Math.random() * 2000) + 500 },
    { name: "May", total: Math.floor(Math.random() * 2000) + 500, predicted: Math.floor(Math.random() * 2000) + 500 },
    { name: "Jun", total: Math.floor(Math.random() * 2000) + 500, predicted: Math.floor(Math.random() * 2000) + 500 },
    { name: "Jul", total: Math.floor(Math.random() * 2000) + 500, predicted: Math.floor(Math.random() * 2000) + 500 },
]
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
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <!-- Box 1 -->
                <div class="grid">
                    <p class="text-gray-400 text-xs">Projets</p>
                    <div class="h-[100px] bg-orange-200 p-2 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
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
                    <div class="h-[100px] bg-blue-50 p-2 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
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

                <!-- Box 3 -->
                <div class="grid">
                    <p class="text-slate-400 text-xs">Données & services</p>
                    <div class="h-[100px] bg-blue-200 p-2 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                        <div class="flex justify-between items-center">
                            <div class="text-2xl grid place-content-center">
                                <p>02</p>
                                <Building class="mt-2" />
                            </div>
                            <div class="text-2xl grid place-content-center">
                                <p>10</p>
                                <FolderClosedIcon class="mt-2" />
                            </div>
                            <div class="text-2xl grid place-content-center">
                                <p>250</p>
                                <FileArchiveIcon class="mt-2" />
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-1 bg-white">
                <p class="text-gray-400 text-xs">Stats générales</p>
                <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <BarChart :colors="['black', '#0074B8']" :data="data" index="name"
                        :categories="['total', 'predicted']" :y-formatter="(tick, i) => {
                            return typeof tick === 'number'
                                ? `$ ${new Intl.NumberFormat('us').format(tick).toString()}`
                                : ''
                        }" :rounded-corners="4" />
                </div>
            </div>

        </div>
    </AppLayout>
</template>
