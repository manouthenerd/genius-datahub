<script setup lang="ts">
import { ref } from 'vue';
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

const pluralOrSingular = (count: number, word: string) => {

    return count > 1 ? `${word}s` : word
}

const prefixDigits = (digit: number) => {
    return digit >= 0 && digit < 10 ? `0${digit}` : digit
}

defineProps<{ 
    member_count: number, 
    service_count: number, 
    folder_count: number, 
    file_count: number, 
    project_count: number, 
    completed_project_count: number, 
    task_count: number,
    completed_task_count: number,
  }>();


const progressbarPercentage = (completed: number, total: number) => {
    const a = (100/total)

    // Résoudre le cas où total > 100

    const progress = ref(a * completed)

    return progress.value

}

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
                            <p class="text-2xl"> {{ prefixDigits(project_count) }} {{pluralOrSingular(project_count, 'Projet')}}</p>
                            <Link :href="route('tasks')">
                                <ArrowUpRight color="#020201FF" />
                            </Link>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <Progress class="w-1/2" :model-value="progressbarPercentage(completed_project_count, project_count)" />
                            <p class="text-xs font-bold">{{prefixDigits(completed_project_count)}}/{{prefixDigits(project_count)}}</p>
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
                            <p class="text-2xl">{{prefixDigits(task_count)}} {{ pluralOrSingular(task_count, 'Tâche') }}</p>
                            <Link :href="route('tasks')">
                                <ArrowUpRight color="#0074B8" />
                            </Link>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <Progress class="w-1/2" :model-value="progressbarPercentage(completed_task_count, task_count)" />
                            <p class="text-xs font-bold">{{ prefixDigits(completed_task_count) }}/{{prefixDigits(task_count)}}</p>
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
                                <p class="font-bold">{{ prefixDigits(service_count) }}</p>
                                <Building class="mt-2 hover:stroke-[#162456]" />
                            </div>
                            <div class="grid place-content-center text-2xl">
                                <p class="font-bold">{{ prefixDigits(member_count) }}</p>
                                <UsersRound class="mt-2 hover:stroke-[#162456]" />
                            </div>
                            <div class="grid place-content-center text-2xl">
                                <p class="font-bold">{{prefixDigits(folder_count)}}</p>
                                <FolderClosedIcon class="mt-2 hover:stroke-[#162456]" />
                            </div>
                            <div class="grid place-content-center text-2xl">
                                <p class="font-bold">{{prefixDigits(file_count)}}</p>
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
