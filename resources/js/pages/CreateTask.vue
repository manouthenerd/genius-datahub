<template>
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex justify-center h-full w-full gap-4 overflow-x-auto rounded-xl p-4">
            <div class="w-xl">
                <Form @success="alert.turnAlertOn" :action="route('projects.create')" method="POST"
                    v-slot="{ errors, processing }"
                    :reset-on-success="['title', 'email', 'tag', 'from', 'to', 'description']">
                    <div class="grid gap-4 py-2 space-y-2">
                        <div class="grid gap-1">
                            <Label for="title">Libellé de la tâche </Label>
                            <Input required id="title" placeholder="Entrer un libellé pour votre projet" name="title"
                                class="ring-transparent! h-[40px] bg-white  focus:border-slate-500!" />
                            <InputError :message="errors.title" />
                        </div>
                        <div class="grid gap-1">
                            <Label for="tag"> Tag</Label>
                            <Input required id="tag" name="tag" placeholder="ex: vidéosurveillance"
                                class="ring-transparent! h-[40px] bg-white  focus:border-slate-500!" />
                            <InputError :message="errors.tag" />
                        </div>
                        <div class="grid gap-1">
                            <Label for="image_path">Image d'illustration <Tag>(facultatif)</Tag></Label>
                            <Input type="file" id="image_path" name="image_path"
                                class="ring-transparent! pt-[8px] h-[40px] bg-white  focus:border-slate-500!" />
                            <InputError :message="errors.image_path" />
                        </div>
                        <div v-if="userHasRole('admin')" class="grid gap-1">
                            <Label for="service_id">Projet associé à la tâche</Label>
                            <SelectInput class="bg-white" :required="userHasRole('admin')" name="service_id" v-model="selectedProject"
                                placeholder="Choix du service">
                                <SelectItem v-for="project in projects" :value="project.id" :key="project.id">
                                    {{ project.title }}
                                </SelectItem>
                            </SelectInput>
                            <InputError :message="errors.service_id" />
                        </div>
                        <input v-else type="hidden" name="service_id" :value="service_id">
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
import { Form, usePage } from '@inertiajs/vue3';
import { Loader } from 'lucide-vue-next';
import Input from '@/components/ui/input/Input.vue';
import InputError from '@/components/InputError.vue';
import SelectInput from '@/components/SelectInput.vue';
import Label from '@/components/ui/label/Label.vue';
import SelectItem from '@/components/ui/select/SelectItem.vue';
import { Button } from '@/components/ui/button';
import Textarea from "@/components/ui/textarea/Textarea.vue";
import { useAlertStore } from '@/stores/alert';
import { ref } from 'vue';
import { type BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';



const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Création de tâches',
        href: `/tasks`,
    },
];


const alert = useAlertStore()

const selectedProject = ref('');
const user: User = usePage().props.auth.user;


interface Project {
    id: number,
    title: string,
    tag: string,
    priority: string,
    description: string,
    from: string,
    to: string
}

interface User {
    id: number,
    name: string,
    role?: string,
    email?: string
}

function userHasRole(role: string): boolean {
    return user.role == role;
}

defineProps<{ projects: Project[], users: User[], service_id: number }>();

</script>

<style scoped>
.data-[placeholder]:text-muted-foreground {
    background-color: white !important;
}
</style>