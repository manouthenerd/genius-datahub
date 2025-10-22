<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex justify-center h-full w-full gap-4 overflow-x-auto rounded-xl p-4">
            <div class="w-xl">
                <Form @success="alert.turnAlertOn" :action="route('tasks')" method="POST"
                    v-slot="{ errors, processing }"
                    :reset-on-success="['title', 'tag', 'from', 'to', 'description']">
                    <div class="grid gap-4 py-2 space-y-2">
                        <div class="grid gap-1">
                            <Label for="title">Libellé de la tâche </Label>
                            <Input required id="title" placeholder="Entrer un libellé pour la tâche" name="title"
                                class="ring-transparent! h-[40px] bg-white  focus:border-slate-500!" />
                            <InputError :message="errors.title" />
                        </div>
                        <div class="grid gap-1">
                            <Label for="tag"> Tag</Label>
                            <Input required id="tag" name="tag" placeholder="ex: câblage"
                                class="ring-transparent! h-[40px] bg-white  focus:border-slate-500!" />
                            <InputError :message="errors.tag" />
                        </div>

                        <div class="grid gap-1">
                            <Label for="priority">Niveau de priorité</Label>

                            <select required class="ring-transparent! px-3 border border-input h-[40px] bg-white rounded-md shadow-xs focus:border-slate-500" name="priority" placeholder="Choix du niveau de priorité">
                                
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

                        <div class="grid gap-1">
                            <Label for="projet_id">Ajouter au projet:</Label>

                            <select @change="updateUsersAndCurrentProjectService(currentProjectService()?.service.id)" required class="ring-transparent! px-3 border border-input h-[40px] bg-white rounded-md shadow-xs focus:border-slate-500" name="project_id" v-model="selectedProject">
                                
                                <option class="text-black" v-for="project in projects" :key="project.id" :value="project.id">
                                   {{ project.title }} ({{ project.service.name }})
                                </option>
                               
                            </select>

                            <input type="hidden" name="service_id" :value="currentProjectService()?.service.id">
                            
                            <InputError :message="errors.project_id" />
                        </div>

                        <div class="grid gap-1">
                            <Label for="projet_id">Déléguer la tâche à:</Label>

                            <div class="flex flex-wrap w-full p-2 gap-4 border-slate-100 min-h-[100px] inset-1  shadow-inner rounded bg-white focus:outline-0">
                                <label v-for="user in users" :key="user.id" :for="`user${user.id}`">
                                    <input name="users[]" v-model="selectedUsers" :value="user.id" type="checkbox" :id="`user${user.id}`"> {{ user.name }}
                                </label>
                                
                            </div>
                            
                            <InputError :message="errors.users" />
                        </div>

                        <div class="grid grid-cols-2 gap-2">
                            <div class="grid gap-1">
                                <Label for="from">Date de début</Label>
                                <Input required class="ring-transparent! h-[40px] bg-white focus:border-slate-500!" type="date"
                                    name="from" />
                                <InputError :message="errors.from" />
                            </div>

                            <div class="grid gap-1">
                                <Label for="to">Date de fin</Label>
                                <Input required class="ring-transparent! h-[40px] bg-white focus:border-slate-500!" type="date"
                                    name="to" />
                                <InputError :message="errors.to" />
                            </div>
                        </div>

                        <div class="grid gap-1">
                            <Label for="description">Description du projet</Label>

                            <Textarea name="description" class="ring-transparent! bg-white focus:border-slate-500!"
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
import { Form } from '@inertiajs/vue3';
import { Loader } from 'lucide-vue-next';
import Input from '@/components/ui/input/Input.vue';
import InputError from '@/components/InputError.vue';
import Label from '@/components/ui/label/Label.vue';
import { Button } from '@/components/ui/button';
import Textarea from "@/components/ui/textarea/Textarea.vue";
import { useAlertStore } from '@/stores/alert';
import { onMounted, ref } from 'vue';
import { type BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import { useFetch } from '@vueuse/core';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Création de tâches',
        href: `/tasks`,
    },
];

const alert = useAlertStore()

interface Project {
    id: number,
    title: string,
    service: {
        id: number,
        name:string
    }
}

const users = ref([])

const selectedUsers = ref([])

const props = defineProps<{ projects: Project[]}>();

const selectedProject = ref(props.projects.length ? props.projects[0].id : "");

const currentProjectService = () => props.projects.find(project => project.id == selectedProject.value)

onMounted(() =>  {
    getUsers(currentProjectService()?.service.id);
})

function getUsers(id: any) {
    useFetch(route('task-users', {service: id}))
    .then(response => users.value = response.data)
    .then((data) => users.value = JSON.parse(data.value))
}

const updateUsersAndCurrentProjectService = (id: number) => {
    currentProjectService()
    getUsers(id)
    selectedUsers.value.length = 0
}
</script>
