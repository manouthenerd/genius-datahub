<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="w-full flex items-center justify-between px-4 mt-4 mb-4">
            <p class="text-sm">
                <Link :href="route('tasks')" class="flex items-center transition-colors hover:text-[#0074B8]">
                <ArrowLeftIcon />
                Retour
                </Link>
            </p>
            <p>
                <Link @success="alert.turnAlertOn" as="button" :href="route('tasks.destroy', { task: task.id })"
                    method="delete"
                    class="flex items-center text-sm text-[#fc3d3c] group hover:text-[#fc3d3c] bg-transparent hover:bg-transparent cursor-pointer">
                <Trash :size="16" color="red" class="group-hover:scale-110 group-hover:rotate-6 transition-colors" />
                supprimer
                </Link>
            </p>
        </div>
        <div class="flex justify-center h-full w-full gap-4 overflow-x-auto rounded-xl p-4">
            <div class="w-xl">
                <Form @success="alert.turnAlertOn" :action="route('tasks.update', { task: task.id })" method="PUT"
                    v-slot="{ errors, processing }">
                    <div class="grid gap-4 py-2 space-y-2">
                        <div class="grid gap-1">
                            <Label for="title">Libellé de la tâche </Label>
                            <Input :model-value="task.title" required id="title"
                                placeholder="Entrer un libellé pour la tâche" name="title"
                                class="ring-transparent! h-[40px] bg-white  focus:border-slate-500!" />
                            <InputError :message="errors.title" />
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div class="grid gap-1">
                                <Label for="tag"> Tag</Label>
                                <Input :model-value="task.tag" required id="tag" name="tag" placeholder="ex: câblage"
                                    class="ring-transparent! h-[40px] bg-white  focus:border-slate-500!" />
                                <InputError :message="errors.tag" />
                            </div>

                            <div class="grid gap-1">
                                <Label for="priority">Niveau de priorité</Label>

                                <select :model-value="task.priority" required
                                    class="ring-transparent! px-3 border border-input h-[40px] bg-white rounded-md shadow-xs focus:border-slate-500"
                                    name="priority" placeholder="Choix du niveau de priorité">

                                    <option value="low">
                                        basse
                                    </option>
                                    <option value="medium">
                                        moyenne
                                    </option>
                                    <option value="high">
                                        haute
                                    </option>
                                </select>
                                <InputError :message="errors.priority" />
                            </div>

                        </div>
                        <div class="grid gap-1">
                            <Label for="projet_id">Projet associé:</Label>

                            <select :disabled="true"
                                class="ring-transparent! cursor-not-allowed px-3 border border-input h-[40px] bg-slate-100 rounded-md shadow-xs focus:border-slate-500"
                                name="project_id" v-model="selectedProject">

                                <option class="text-black" :value="project.id">
                                    {{ project.title }} ({{ project.service.name }})
                                </option>

                            </select>

                            <InputError :message="errors.project_id" />
                        </div>

                        <div class="grid gap-1">
                            <Label for="users">Les membres concernés</Label>

                            <ScrollArea class="h-[130px] bg-white shadow-inner rounded-md">
                                <div class="p-2">
                                    <ul class="flex flex-wrap gap-4 items-center">
                                        <li v-for="user in users" :key="user.id">
                                            <label :for="`user-${user.id}`">
                                                {{ user.name }}
                                                <input type="checkbox" name="users[]" :value="user.id"
                                                    :id="`user-${user.id}`" v-model="updateSelectedUsers">
                                            </label>
                                        </li>
                                    </ul>
                                </div>

                            </ScrollArea>

                            <InputError :message="errors.users" />
                        </div>

                        <div class="grid gap-2">
                            <div class="grid grid-cols-2 gap-2">
                                <div class="grid gap-1">
                                    <Label for="from">Date de début</Label>
                                    <Input :model-value="task.from" required
                                        class="ring-transparent! h-[40px] bg-white focus:border-slate-500!" type="date"
                                        name="from" />
                                </div>

                                <div class="grid gap-1">
                                    <Label for="to">Date de fin</Label>
                                    <Input :model-value="task.to" required
                                        class="ring-transparent! h-[40px] bg-white focus:border-slate-500!" type="date"
                                        name="to" />

                                </div>
                            </div>
                            <InputError :message="errors.to" />
                            <InputError :message="errors.from" />
                        </div>



                        <div class="grid gap-1">
                            <Label for="description">Description du projet</Label>

                            <Textarea :model-value="task.description" name="description"
                                class="ring-transparent! bg-white focus:border-slate-500!"
                                placeholder="Entrer la description ici." />
                            <InputError :message="errors.description" />
                        </div>
                    </div>
                    <div>
                        <Button :disabled="processing" type="submit"
                            class="bg-[#0168a6] hover:bg-[#0168a6] hover:opacity-80">
                            <Loader v-if="processing" class="h-4 w-4 animate-spin" />
                            Enregistrer
                        </Button>
                    </div>
                </Form>
            </div>
        </div>
    </AppLayout>

</template>

<script setup lang="ts">
import { Form, Link } from '@inertiajs/vue3';
import { Loader } from 'lucide-vue-next';
import Input from '@/components/ui/input/Input.vue';
import InputError from '@/components/InputError.vue';
import Label from '@/components/ui/label/Label.vue';
import { Button } from '@/components/ui/button';
import Textarea from "@/components/ui/textarea/Textarea.vue";
import { useAlertStore } from '@/stores/alert';
import { ref } from 'vue';
import { type BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import ScrollArea from '@/components/ui/scroll-area/ScrollArea.vue';
import { Trash, ArrowLeftIcon } from 'lucide-vue-next';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Modification de la tâche',
        href: `/tasks`,
    },
];

const alert = useAlertStore()

interface Project {
    id: number,
    title: string,
    service: {
        id: number,
        name: string
    }
}

interface Task {
    id: number,
    title: string,
    tag: string,
    description: string,
    from: string,
    to: string,
    priority: string
}

interface User {
    id: number,
    name: string,
    role?: string,
    email?: string
}

const props = defineProps<{ project: Project, users: User[], selectedUsers: User[], task: Task }>();

const selectedProject = ref(props.project.id);

const updateSelectedUsers = ref(props.selectedUsers.map(user => user.id));

</script>
