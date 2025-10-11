<template>
    <Dialog>
        <DialogTrigger>
            <Button variant="ghost">
                Modifier
            </Button>
        </DialogTrigger>
        <DialogContent>
            <DialogHeader>
                <DialogTitle>Nouveau projet </DialogTitle>
                <DialogDescription>Modifier les informations du projet
                </DialogDescription>
            </DialogHeader>
            <Form 
                @success="alert.turnAlertOn"
                :action="route('projects.update', { project: project.id })" method="POST"
                v-slot="{ errors, processing }">
                <div class="grid gap-4 py-2">
                    <div class="grid gap-1">
                        <Label for="title">Libellé du projet </Label>
                        <Input id="title" class="ring-transparent!  focus:border-slate-500!"
                            :model-value="project.title" placeholder="Entrer un libellé pour votre projet"
                            name="title" />
                        <InputError :message="errors.title" />
                    </div>
                    <div class="grid gap-1">
                        <Label for="tag"> Tag du projet</Label>
                        <Input id="tag" :model-value="project.tag" name="tag"
                            class="ring-transparent!  focus:border-slate-500!" placeholder="ex: vidéosurveillance" />
                        <InputError :message="errors.tag" />
                    </div>
                    <div class="grid gap-1">
                        <Label for="priority">Niveau de priorité</Label>

                        <SelectInput :defaultValue="project.priority" name="priority"
                            placeholder="Choix du niveau de priorité">
                            <SelectItem value="low">
                                faible
                            </SelectItem>
                            <SelectItem value="medium">
                                moyenne
                            </SelectItem>
                            <SelectItem value="high">
                                élévé
                            </SelectItem>
                        </SelectInput>
                        <InputError :message="errors.priority" />
                    </div>

                    <div class="grid grid-cols-2 gap-2">
                        <div class="grid gap-1">
                            <Label for="starting_date">Date de début du projet</Label>
                            <Input name="from" :model-value="project.from" required
                                class="ring-transparent!  focus:border-slate-500!" type="date"/>
                            <InputError :message="errors.from" />
                        </div>

                        <div class="grid gap-1">
                            <Label for="ending_date">Date de fin du projet</Label>
                            <Input name="to" :model-value="project.to" required
                                class="ring-transparent!  focus:border-slate-500!" type="date"/>
                            <InputError :message="errors.to" />
                        </div>
                    </div>

                    <div class="grid gap-1">
                        <Label for="description">Description du projet</Label>

                        <Textarea name="description" class="ring-transparent!  focus:border-slate-500!" :model-value="project.description"
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
import { Form } from '@inertiajs/vue3';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import Input from '@/components/ui/input/Input.vue';
import InputError from '@/components/InputError.vue';
import SelectInput from '@/components/SelectInput.vue';
import Label from '@/components/ui/label/Label.vue';
import SelectItem from '@/components/ui/select/SelectItem.vue';
import { Button } from '@/components/ui/button';
import Textarea from "@/components/ui/textarea/Textarea.vue";
import { useAlertStore } from '@/stores/alert';
import { Loader } from 'lucide-vue-next';


interface Project {
    id: number,
    title: string,
    tag: string,
    priority: string,
    description: string,
    from: string,
    to: string
}

defineProps<{ project: Project }>();

const alert = useAlertStore();
</script>