<template>
    <Dialog>
        <DialogTrigger>
            <Button variant="ghost">
                <Plus />
                Nouveau projet
            </Button>
        </DialogTrigger>
        <DialogContent>
            <DialogHeader>
                <DialogTitle>Nouveau projet </DialogTitle>
                <DialogDescription> Ajouter un nouveau projet à votre liste de projets
                </DialogDescription>
            </DialogHeader>
            <Form @success="alert.turnAlertOn" :action="route('projects.create')" method="POST"
                v-slot="{ errors, processing }"
                :reset-on-success="['title', 'email', 'tag', 'from', 'to', 'description']">
                <div class="grid gap-4 py-2">
                    <div class="grid gap-1">
                        <Label for="title">Libellé du projet </Label>
                        <Input required id="title" placeholder="Entrer un libellé pour votre projet" name="title"
                            class="ring-transparent!  focus:border-slate-500!" />
                        <InputError :message="errors.title" />
                    </div>
                    <div class="grid gap-1">
                        <Label for="tag"> Tag du projet</Label>
                        <Input required id="tag" name="tag" placeholder="ex: vidéosurveillance"
                            class="ring-transparent!  focus:border-slate-500!" />
                        <InputError :message="errors.tag" />
                    </div>
                    <div v-if="userHasRole('admin')" class="grid gap-1">
                        <Label for="service_id">Attribuer au service</Label>
                        <SelectInput :required="userHasRole('admin')" name="service_id" v-model="selectedService" placeholder="Choix du service">
                            <SelectItem v-for="service in services" :value="service.id" :key="service.id">
                               {{ service.name }}
                            </SelectItem>
                        </SelectInput>
                        <InputError :message="errors.service_id" />
                    </div>
                    <input v-else type="hidden" name="service_id" :value="service_id">
                    <div class="grid gap-1">
                        <Label for="priority">Niveau de priorité</Label>

                        <SelectInput required name="priority" placeholder="Choix du niveau de priorité">
                            <SelectItem value="low">
                                basse
                            </SelectItem>
                            <SelectItem value="medium">
                                moyenne
                            </SelectItem>
                            <SelectItem value="high">
                                haute
                            </SelectItem>
                        </SelectInput>
                        <InputError :message="errors.priority" />
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div class="grid gap-1">
                            <Label for="from">Date de début du projet</Label>
                            <Input required class="ring-transparent!  focus:border-slate-500!" type="date"
                                name="from" />
                            <InputError :message="errors.from" />
                        </div>

                        <div class="grid gap-1">
                            <Label for="to">Date de fin du projet</Label>
                            <Input required class="ring-transparent!  focus:border-slate-500!" type="date" name="to" />
                            <InputError :message="errors.to" />
                        </div>
                    </div>

                    <div class="grid gap-1">
                        <Label for="description">Description du projet</Label>

                        <Textarea name="description" class="ring-transparent! focus:border-slate-500!"
                            placeholder="Entrer la description ici." />
                        <InputError :message="errors.description" />
                    </div>
                </div>
                <DialogFooter>
                    <Button :disabled="processing" type="submit"
                        class="bg-[#0168a6] hover:bg-[#0168a6] hover:opacity-80">
                        <Loader v-if="processing" class="h-4 w-4 animate-spin" />
                        Enregistrer
                    </Button>
                </DialogFooter>
            </Form>
        </DialogContent>
    </Dialog>
</template>

<script setup lang="ts">
import { Form, usePage } from '@inertiajs/vue3';
import { Plus, Loader } from 'lucide-vue-next';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import Input from '@/components/ui/input/Input.vue';
import InputError from '@/components/InputError.vue';
import SelectInput from '@/components/SelectInput.vue';
import Label from '@/components/ui/label/Label.vue';
import SelectItem from '@/components/ui/select/SelectItem.vue';
import { Button } from '@/components/ui/button';
import Textarea from "@/components/ui/textarea/Textarea.vue";
import { useAlertStore } from '@/stores/alert';
import { ref } from 'vue';

const alert = useAlertStore()

const selectedService = ref('');
const user: User = usePage().props.auth.user;

interface Service {
    id: number,
    name: string
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

defineProps<{services: Service[], service_id: number}>();

</script>