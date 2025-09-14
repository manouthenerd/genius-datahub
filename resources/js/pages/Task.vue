<script setup lang="ts">
import ActionOption from '@/components/ActionOption.vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import TaskCard from '@/components/ui/card/TaskCard.vue';
import { ScrollArea } from '@/components/ui/scroll-area';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Bookmark, Plus } from 'lucide-vue-next';
import { dateFormat } from '@/composables/useDateFormat';
import CreateProjectDialog from '@/components/dialog/CreateProjectDialog.vue';
// import EditProjectDialog from '@/components/dialog/EditProjectDialog.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Tâches',
        href: '/tasks',
    },
];


interface Project {
    id: number,
    title: string,
    tag: string,
    priority: string,
    description: string,
    created_at: Date
}

interface Service {
    id: number,
    name: string
}


defineProps<{ projects: Project[], services: Service[], service_id: number }>();

const priorityToFrench = (priority: string) => {
    switch (priority) {
        case "low":
            return 'faible'
            break;

        case "medium":
            return 'moyenne'
            break;
    
        default:
            return "haute"
            break;
    }
}

</script>

<template>

    <Head title="Tâches" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="flex-1">
                <div class="flex items-center justify-between">
                    <p class="text-xs text-gray-400">Projets en cours</p>
                    <p>
                        <CreateProjectDialog :services :service_id />
                    </p>
                </div>
                <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <div class="relative overflow-x-auto bg-white sm:rounded-lg">
                        <ScrollArea class="h-50">
                            <table class="w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400">
                                <thead
                                    class="sticky-top sticky top-0 bg-blue-950 text-xs text-white uppercase dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-2 py-3">Libellé</th>
                                        <th scope="col" class="px-2 py-3">Tag</th>
                                        <th scope="col" class="px-2 py-3">Statut</th>
                                        <th scope="col" class="px-2 py-3">Priorité</th>
                                        <th scope="col" class="px-2 py-3">Tâches</th>
                                        <th scope="col" class="px-2 py-3">Date</th>
                                        <th scope="col" class="px-2 py-3"></th>
                                    </tr>
                                </thead>
                                <tbody v-if="projects.length">
                                    <tr v-for="project in projects" :key="project?.id"
                                        class="cursor-pointer border-y border-gray-200 transition-all hover:bg-slate-200 dark:border-gray-700 dark:bg-gray-800">
                                        <th scope="row"
                                            class="px-2 py-2 font-medium whitespace-nowrap text-gray-900 dark:text-white">
                                            {{ project.title }}</th>
                                        <td class="px-2 py-2">
                                            <Badge> {{ project.tag }} </Badge>
                                        </td>
                                        <td class="px-2 py-2">
                                            <Badge class="bg-green-50 text-black" variant="secondary">
                                                <span class="size-[5px] rounded-full bg-green-500"></span> En cours
                                            </Badge>
                                        </td>
                                        <td class="px-2 py-2">{{ priorityToFrench(project.priority) }}</td>
                                        <td class="px-2 py-2">2</td>
                                        <td class="px-2 py-2">{{ dateFormat(String(project.created_at)) }}</td>
                                        <td class="px-2 py-2 text-right">
                                            <ActionOption :show-edit-link="false">
                                                <!-- <EditProjectDialog :project/> -->
                                            </ActionOption>
                                        </td>
                                    </tr>
                                </tbody>

                                <tbody v-else class="w-full space-y-2">
                                    <tr>
                                        <th colspan="5" class="text-center flex justify-center">
                                        </th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-center">
                                            <p class="mt-4 w-full p-2 text-center text-sm text-black underline">
                                                Pas de projet disponible...
                                            </p>
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </ScrollArea>
                    </div>
                </div>
            </div>
            <div class="flex-1">
                <div class="flex items-center justify-between">
                    <p class="text-xs text-gray-400">Aperçu des tâches</p>
                    <Button variant="ghost">
                        <Plus />
                        Nouvelle tâche
                    </Button>
                </div>
                <div
                    class="grid grid-cols-3 gap-2 overflow-x-scroll rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <ScrollArea class="grid max-h-[340px] gap-2 overflow-x-scroll rounded-sm bg-zinc-100 p-2">
                        <div class="my-2 flex items-center justify-between px-0.5">
                            <p class="rounded bg-gray-300 p-1">A Faire</p>
                            <Button variant="ghost">
                                10
                                <Bookmark />
                            </Button>
                        </div>
                        <TaskCard priority="Normal" tag="Programming" title="Laravel Framework"
                            description="About The Best PHP Framework Ever."
                            image="https://webandcrafts.com/_next/image?url=https%3A%2F%2Fadmin.wac.co%2Fuploads%2F10_Great_Sites_Built_with_Laravel_Framework_0e893c2354.jpg&w=4500&q=90"
                            :progression="40" />
                        <TaskCard priority="Normal" tag="Programming" title="Laravel Framework"
                            description="About The Best PHP Framework Ever."
                            image="https://webandcrafts.com/_next/image?url=https%3A%2F%2Fadmin.wac.co%2Fuploads%2F10_Great_Sites_Built_with_Laravel_Framework_0e893c2354.jpg&w=4500&q=90"
                            :progression="40" />
                        <TaskCard priority="Normal" tag="Programming" title="Laravel Framework"
                            description="About The Best PHP Framework Ever."
                            image="https://webandcrafts.com/_next/image?url=https%3A%2F%2Fadmin.wac.co%2Fuploads%2F10_Great_Sites_Built_with_Laravel_Framework_0e893c2354.jpg&w=4500&q=90"
                            :progression="40" />
                    </ScrollArea>

                    <ScrollArea class="grid max-h-[340px] gap-2 overflow-x-scroll rounded-sm bg-blue-50 p-2">
                        <div class="my-2 flex items-center justify-between px-0.5">
                            <p class="rounded bg-blue-300 p-1">En cours</p>
                            <div class="flex">
                                <Button variant="link">
                                    <Plus />
                                </Button>
                                <ActionOption />
                            </div>
                        </div>
                        <TaskCard priority="Hight" tag="Learning" title="Learning LLMs"
                            description="How building LLMs from Scratch"
                            image="https://simseo.fr/wp-content/uploads/2024/05/1715818927_Lavancee-des-LLM-les-performances-et-les-defauts-qui.jpeg"
                            :progression="50" />
                        <TaskCard priority="Hight" tag="Learning" title="Learning LLMs"
                            description="How building LLMs from Scratch"
                            image="https://simseo.fr/wp-content/uploads/2024/05/1715818927_Lavancee-des-LLM-les-performances-et-les-defauts-qui.jpeg"
                            :progression="50" />
                        <TaskCard priority="Hight" tag="Learning" title="Learning LLMs"
                            description="How building LLMs from Scratch"
                            image="https://simseo.fr/wp-content/uploads/2024/05/1715818927_Lavancee-des-LLM-les-performances-et-les-defauts-qui.jpeg"
                            :progression="50" />
                    </ScrollArea>

                    <ScrollArea class="grid max-h-[340px] gap-2 overflow-x-scroll rounded-sm bg-green-50 p-2">
                        <div class="my-2 flex items-center justify-between px-0.5">
                            <p class="rounded bg-green-300 p-1">Terminées</p>
                            <div class="flex">
                                <Button variant="link">
                                    <Plus />
                                </Button>
                                <ActionOption />
                            </div>
                        </div>
                        <TaskCard priority="Low" tag="Mission" title="Vidéosurveillance"
                            description="Comment installer une caméra"
                            image="https://ticou.net/site/assets/images/videosurveillance.jpg" :progression="50" />
                    </ScrollArea>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.cls-3 {
    fill: #db5669
}

.cls-4 {
    fill: #f26674
}

.cls-5 {
    fill: #919191
}
</style>