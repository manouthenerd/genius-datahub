<template>

    <Head title="Modification des données  " />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <Form :action="route('update-user')" method="put" class="bg-white p-4 rounded max-w-[540px]"
                v-slot="{ errors, processing }" :disable-while-processing="true" setDefaultsOnSuccess>
                <!-- Inject user ID -->
                <input type="hidden" name="user_id" :value="props.user.id">

                <!-- End ID injection -->
                <div class="grid gap-4 py-4 space-y-2">
                    <div class="grid gap-1">
                        <Label for="name">
                            Nom & prénoms
                        </Label>
                        <Input id="name" v-model="form.name" name="name" class="bg-white" />
                        <InputError :message="errors.name" />
                    </div>
                    <div class="grid gap-1">
                        <Label for="email">
                            Adresse email
                        </Label>
                        <Input id="email" type="email" :model-value="form.email" name="email" class="bg-gray-100 cursor-not-allowed" :disabled="true"/>
                        <input type="hidden" name="email" :value="form.email">
                        <InputError :message="errors.email" />
                    </div>
                    <div class="grid gap-1">
                        <Label for="type">
                            Service à intégrer
                        </Label>

                        <SelectInput v-model="form.service" name="service" placeholder="Choix du service">
                            <SelectItem v-for="service in props.services" :value="service.id" :key="service.id">
                                {{ service.name }}
                            </SelectItem>

                        </SelectInput>
                        <InputError :message="errors.service" />

                    </div>

                    <div class="grid gap-1">
                        <Label for="role">
                            Rôle utilisateur
                        </Label>

                        <SelectInput v-model="form.role" name="role"
                            placeholder="Choisir le rôle de l'utilisateur">
                            <SelectItem value="moderator">
                                Modérateur
                            </SelectItem>
                            <SelectItem value="member">
                                Membre
                            </SelectItem>
                        </SelectInput>
                        <InputError :message="errors.role" />
                    </div>
                </div>

                <Button type="submit" class=" bg-[#0168a6] hover:opacity-80 hover:bg-[#0168a6]">
                    <Loader v-if="processing" class="animate-spin w-4 h-4" />
                    Enregistrer les modifications
                </Button>

            </Form>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import { Head, Form, useForm } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import { Button } from '@/components/ui/button';
import Label from '@/components/ui/label/Label.vue';
import Input from '@/components/ui/input/Input.vue';
import InputError from '@/components/InputError.vue';
import SelectInput from '@/components/SelectInput.vue';
import SelectItem from '@/components/ui/select/SelectItem.vue';

interface User {
    id: number,
    name: string,
    email: string,
    role: string,
    service_id: number
}

const props = defineProps<{
    user: User,
    services: { id: number, name: string }[]
}>();

const form = useForm({
    name: props.user.name,
    email: props.user.email,
    role: props.user.role,
    service: props.user.service_id,
});


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Modification des données',
        href: `/users/${props.user.id}`
    },
];


</script>