<script setup lang="ts">
import ActionOption from '@/components/ActionOption.vue';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';
import TaskCard from '@/components/ui/card/TaskCard.vue';
import { ScrollArea } from '@/components/ui/scroll-area';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { Bookmark } from 'lucide-vue-next';
import CreateProjectDialog from '@/components/dialog/CreateProjectDialog.vue';
import EditProjectDialog from '@/components/dialog/EditProjectDialog.vue';
import { onMounted } from 'vue';

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
    from: string,
    to: string,
    status: string
}

interface Task {
    id: number,
    title: string,
    tag: string,
    status: string,
    from: string,
    to: string,
    description: string
}

interface Service {
    id: number,
    name: string
}

const frDateFormat = (date: string) => date.split('-').reverse().join('-')


const props = defineProps<{ projects: Project[], tasks: Task[], services: Service[], service_id: number }>();

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
const statusToFrench = (priority: string) => {
    switch (priority) {
        case "in_progress":
            return 'en cours'
            break;

        case "pending":
            return 'en attente'
            break;

        default:
            return "achevé"
            break;
    }
}

const priorityBadgeColor = (priority: string) => {
    switch (priority) {
        case "low":
            return {
                dot: "bg-blue-500",
                badge: "bg-blue-100",
            }
            break;

        case "medium":
            return {
                dot: "bg-orange-500",
                badge: "bg-orange-100",
            }
            break;

        default:
            return {
                dot: "bg-red-500",
                badge: "bg-red-100",
            }
            break;
    }
}

function tasksInProgress() {
    return props.tasks.filter((task) => {
        return task.status == 'in_progress'
    })
}
function tasksCompleted() {
    return props.tasks.filter((task) => {
        return task.status == 'completed'
    })
}
function tasksInPending() {
    return props.tasks.filter((task) => {
        return task.status == 'pending'
    })
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
                                        <th scope="col" class="px-2 py-3">Début</th>
                                        <th scope="col" class="px-2 py-3">Fin</th>
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
                                            <Badge class="bg-[#e6fcdc] text-black" variant="secondary">
                                                <span class="size-[5px] rounded-full bg-[#c7f17b]"></span> {{
                                                    statusToFrench(project.status) }}
                                            </Badge>
                                        </td>
                                        <td class="px-2 py-2">
                                            <Badge :class="priorityBadgeColor(project.priority).badge"
                                                class="text-black" variant="secondary">
                                                <span :class="priorityBadgeColor(project.priority).dot"
                                                    class="size-[5px] rounded-full"></span> {{
                                                        priorityToFrench(project.priority) }}
                                            </Badge>
                                        </td>
                                        <td class="px-2 py-2 text-center">
                                            <!-- TODO: Afficher le nombre de tâches contenues dans le projet -->
                                            2
                                        </td>
                                        <td class="px-2 py-2">{{ frDateFormat(project.from) }}</td>
                                        <td class="px-2 py-2">{{ frDateFormat(project.to) }}</td>
                                        <td class="px-2 py-2 text-right">
                                            <ActionOption :show-edit-link="false"
                                                :delete-link="route('projects.destroy', project.id)">
                                                <EditProjectDialog :project />
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
                    <Link :href="route('tasks.create')">
                    Nouvelle tâche
                    </Link>
                </div>
                <div
                    class="grid grid-cols-3 gap-2 overflow-x-scroll rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">

                    <!--Pending Tasks -->
                    <ScrollArea v-if="tasksInPending().length"
                        class="grid max-h-[340px] gap-2 overflow-x-scroll rounded-sm bg-zinc-100 p-2">
                        <div class="my-2 flex items-center justify-between px-0.5">
                            <p class="rounded bg-gray-300 p-1">A Faire</p>
                            <Button variant="ghost">
                                {{ tasksInPending()?.length ?? 0 }}
                                <Bookmark />
                            </Button>
                        </div>
                        <TaskCard v-for="task in tasksInPending()" :href="route('tasks.edit', { task: task.id })"
                            :key="task.id" :priority="task.title" :tag="task.tag" :title="task.title"
                            :description="task.description" image="/image/genius-3D.png" :progression="40" />

                    </ScrollArea>

                    <div v-else class="px-0.5 grid">
                        <div class="flex items-center justify-between mb-14">
                            <p class="rounded bg-gray-300 p-1">A Faire</p>
                            <Button variant="ghost">
                                0
                                <Bookmark />
                            </Button>
                        </div>
                        <div class="flex justify-center">
                            <img src="/image/task.svg" alt="task illustration">

                        </div>
                        <p class="text-center text-xs mt-4">Aucune tâche <span
                                class="text-blue-900 font-bold underline">à faire</span></p>
                    </div>

                    <!-- In progress Tasks -->
                    <ScrollArea v-if="tasksInProgress()?.length" class="grid max-h-[340px] gap-2 overflow-x-scroll rounded-sm bg-blue-100 p-2">
                        <div class="my-2 flex items-center justify-between px-0.5">
                            <p class="rounded bg-blue-300 p-1">En cours</p>
                            <Button variant="ghost">
                                {{ tasksInProgress()?.length ?? 0 }}
                                <Bookmark />
                            </Button>
                        </div>
                        <TaskCard class=" hover:cursor-[url('/image/cursor.svg')]" v-for="task in tasksInProgress()"
                            :href="route('tasks.edit', { task: task.id })" :key="task.id" :priority="task.title"
                            :tag="task.tag" :title="task.title" :description="task.description"
                            image="/image/genius-3D.png" :progression="40" />

                    </ScrollArea>

                    <div v-else class="px-0.5 grid">
                        <div class="flex items-center justify-between mb-14">
                            <p class="rounded bg-gray-300 p-1">En cours</p>
                            <Button variant="ghost">
                                {{ 0 }}
                                <Bookmark />
                            </Button>
                        </div>
                        <div class="flex justify-center">
                            <img src="/image/task-todo.svg" alt="task illustration">

                        </div>
                        <p class="text-center text-xs mt-4">Aucune tâche <span
                                class="text-blue-900 font-bold underline">en cours</span></p>
                    </div>

                    <!-- Completed Tasks -->
                    <ScrollArea v-if="tasksCompleted()?.length" class="grid max-h-[340px] gap-2 overflow-x-scroll rounded-sm bg-[#e6fcdc] p-2">
                        <div class="my-2 flex items-center justify-between px-0.5">
                            <p class="rounded bg-[#c7f17b] p-1">Terminées</p>
                            <Button variant="ghost">
                                {{ tasksCompleted()?.length ?? 0 }}
                                <Bookmark />
                            </Button>
                        </div>
                        <TaskCard v-for="task in tasksCompleted()" :key="task.id" :priority="task.title" :tag="task.tag"
                            :title="task.title" :description="task.description" image="/image/genius-3D.png"
                            :href="route('tasks.edit', { task: task.id })" :progression="40" />

                    </ScrollArea>

                    <div v-else class="px-0.5 grid">
                        <div class="flex items-center justify-between mb-14">
                            <p class="rounded bg-gray-300 p-1">Terminées</p>
                            <Button variant="ghost">
                                {{ 0 }}
                                <Bookmark />
                            </Button>
                        </div>
                        <div class="flex justify-center">
                            <img src="/image/task-completed.svg" alt="task illustration">

                        </div>
                        <p class="text-center text-xs mt-4">Aucune tâche <span
                                class="text-blue-900 font-bold underline">terminée</span></p>
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>
</template>
