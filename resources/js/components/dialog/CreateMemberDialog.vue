<template>
    <Dialog>
        <DialogTrigger>
            <Button variant="ghost">
                <Plus />
                Nouveau membre
            </Button>
        </DialogTrigger>
        <DialogContent>
            <DialogHeader>
                <DialogTitle> Nouveau membre </DialogTitle>
                <DialogDescription> Ajouter un nouveau membre à ceux déjà existant dans un service
                </DialogDescription>
            </DialogHeader>
            <Form 
                @success="alert.turnAlertOn"
                :action="route('users.create')" method="POST" 
                v-slot="{ errors, processing }"
                :reset-on-success="['name', 'email']">
                <div class="grid gap-4 py-2">
                    <div class="grid gap-1">
                        <Label for="name"> Nom & prénoms </Label>
                        <Input id="name" name="name" class="bg-white" />
                        <InputError :message="errors.name" />
                    </div>
                    <div class="grid gap-1">
                        <Label for="email"> Adresse email </Label>
                        <Input id="email" name="email" class="bg-white" />
                        <InputError :message="errors.email" />
                    </div>
                    <div class="grid gap-1">
                        <Label for="type"> Service à intégrer </Label>

                        <SelectInput v-model="selectedService" name="service" placeholder="Choix du service">
                            <SelectItem v-for="service in services" :value="service.id" :key="service.id">
                                {{ service.name }}
                            </SelectItem>
                        </SelectInput>
                        <InputError :message="errors.service" />
                    </div>

                    <div class="grid gap-1">
                        <Label for="role"> Rôle utilisateur </Label>

                        <SelectInput name="role" placeholder="Choisir le rôle de l'utilisateur">
                            <SelectItem value="moderator"> Modérateur </SelectItem>
                            <SelectItem value="member"> Membre </SelectItem>
                        </SelectInput>
                        <InputError :message="errors.role" />
                    </div>
                </div>
                <DialogFooter>
                    <Button :disabled="processing" type="submit"
                        class="bg-[#0168a6] hover:bg-[#0168a6] hover:opacity-80">
                        <Loader v-if="processing" class="h-4 w-4 animate-spin" />
                        Sauvegarder
                    </Button>
                </DialogFooter>
            </Form>
        </DialogContent>
    </Dialog>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { Form } from '@inertiajs/vue3';
import { Plus, Loader } from 'lucide-vue-next';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import Input from '@/components/ui/input/Input.vue';
import InputError from '@/components/InputError.vue';
import SelectInput from '@/components/SelectInput.vue';
import Label from '@/components/ui/label/Label.vue';
import SelectItem from '@/components/ui/select/SelectItem.vue';
import { Button } from '@/components/ui/button';
import { useAlertStore } from '@/stores/alert';


interface Services {
    id: number,
    name: string,
    created_at: string,
    moderator: {
        id: number,
        name: string,
        role: string
    },
    counts: number,
    members: {
        id: number,
        name: string
    }[]
}

defineProps<{services: Services[] }>();

const selectedService = ref<number | null>(null);

const alert = useAlertStore();

alert.message = 'Membre créé avec succès !';
</script>