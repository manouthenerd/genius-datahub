<template>
    <Dialog>
        <DialogTrigger>
            <p class="text-slate-500 hover:underline transition-all text-sm">
                Nouveau membre
            </p>
        </DialogTrigger>
        <DialogContent>
            <DialogHeader>
                <DialogTitle> Nouveau membre </DialogTitle>
                <DialogDescription> Ajouter un nouveau membre au service
                </DialogDescription>
            </DialogHeader>
            <div class="rounded bg-zinc-100 p-2">
                <!-- TODO: Alert component here -->
                <Transition>
                    <p v-if="false" class="rounded-sm bg-blue-100 p-2">Enregistrement effectué avec
                        succès !</p>
                </Transition>
            </div>
            <Form :action="route('users.add')" method="POST" v-slot="{ errors, processing }"
                :reset-on-success="['name', 'email']">
                <div class="grid gap-4 py-2 mb-2">
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
                </div>

                <!-- Hidden inputs -->

                <div class="grid gap-1">
                    <input type="hidden" name="service" :value="service.id" class="bg-white" />
                </div>
                <div class="grid gap-1">
                    <input type="hidden" name="role" value="member" class="bg-white" />
                </div>

                <!--  -->
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
import Label from '@/components/ui/label/Label.vue';
import { Button } from '@/components/ui/button';
import { Loader } from 'lucide-vue-next';

interface Service {
    id: number,
    name: string
}

defineProps<{service: Service}>();
</script>