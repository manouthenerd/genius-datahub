<script setup lang="ts">
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Form } from '@inertiajs/vue3';
import { Plus } from 'lucide-vue-next';
import AvatarGroup from '@/components/AvatarGroup.vue';
import ActionOption from '@/components/ActionOption.vue';
import Input from '@/components/ui/input/Input.vue';
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogHeader,
    DialogTrigger,
    DialogTitle,
    DialogFooter,

} from '@/components/ui/dialog';

import SelectItem from '@/components/ui/select/SelectItem.vue';
import SelectInput from '@/components/SelectInput.vue';
import Label from '@/components/ui/label/Label.vue';
import InputError from '@/components/InputError.vue';
import { Loader } from 'lucide-vue-next';
import { ScrollArea } from '@/components/ui/scroll-area';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Services et membres',
        href: '/services',
    },
];

const props = defineProps({
    users: Array,
    services: Array,
})

function getUserRole(role: string): string {

    switch (role) {

        case "admin":
            return "admin";
            break;

        case "moderator":
            return "modérateur"
            break;

        default:
            return "membre"
    }
}
</script>

<template>


    <Head title="Services et membres" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-3 rounded-xl p-4 overflow-x-auto">

            <!-- User dialog box -->
            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <p class="text-gray-400 text-xs">Membres actuels</p>
                    <Dialog>
                        <DialogTrigger>
                            <Button variant="ghost">
                                <Plus />
                                Nouveau membre
                            </Button>
                        </DialogTrigger>
                        <DialogContent>
                            <DialogHeader>
                                <DialogTitle>
                                    Nouveau membre
                                </DialogTitle>
                                <DialogDescription>
                                    Ajouter un nouveau membre à ceux déjà existant dans un service
                                </DialogDescription>
                            </DialogHeader>
                            <div class="rounded p-2 bg-zinc-100 ">
                                <!-- TODO: Alert component here -->
                                <Transition>
                                    <p v-if="false" class="p-2 rounded-sm bg-blue-100">Enregistrement effectué avec
                                        succès !</p>
                                </Transition>
                            </div>
                            <Form :action="route('create-user')" method="POST" v-slot="{ errors, processing }"
                                :reset-on-success="['name', 'email']">
                                <div class="grid gap-4 py-4">
                                    <div class="grid gap-1">
                                        <Label for="name">
                                            Nom & prénoms
                                        </Label>
                                        <Input id="name" name="name" class="bg-white" />
                                        <InputError :message="errors.name" />
                                    </div>
                                    <div class="grid gap-1">
                                        <Label for="email">
                                            Adresse email
                                        </Label>
                                        <Input id="email" name="email" class="bg-white" />
                                        <InputError :message="errors.email" />
                                    </div>
                                    <div class="grid gap-1">
                                        <Label for="type">
                                            Service à intégrer
                                        </Label>

                                        <SelectInput name="service" placeholder="Choix du service">
                                            <SelectItem v-for="service in props.services" :value="service.id"
                                                :key="service.id">
                                                {{ service.name }}
                                            </SelectItem>

                                        </SelectInput>
                                        <InputError :message="errors.service" />

                                    </div>

                                    <div class="grid gap-1">
                                        <Label for="role">
                                            Rôle utilisateur
                                        </Label>

                                        <SelectInput name="role" placeholder="Choisir le rôle de l'utilisateur">
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
                                <DialogFooter>
                                    <Button :disabled="processing" type="submit"
                                        class=" bg-[#0168a6] hover:opacity-80 hover:bg-[#0168a6]">
                                        <Loader v-if="processing" class="animate-spin w-4 h-4" />
                                        Sauvegarder
                                    </Button>
                                </DialogFooter>
                            </Form>
                        </DialogContent>
                    </Dialog>
                </div>
                <div class="rounded-xl bg-zinc-50 border border-sidebar-border/70 dark:border-sidebar-border">


                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <ScrollArea class="h-50">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Nom
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Service
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Type
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in props.users" :key="user.email"
                                        class="border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ user.name }}
                                        </th>

                                        <td class="px-6 py-4">
                                            {{ user.email }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ user.service.name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ getUserRole(user.role) }}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <ActionOption 
                                                :edit-link="`users/${user.id}`" 
                                                :delete-link="`users/${user.id}`" 
                                            />
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </ScrollArea>
                    </div>

                </div>
            </div>

            <!-- Service dialog box -->
            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <p class="text-gray-400 text-xs">Services actuels</p>
                    <Dialog>
                        <DialogTrigger>
                            <Button variant="ghost">
                                <Plus />
                                Nouveau service
                            </Button>
                        </DialogTrigger>
                        <DialogContent>
                            <DialogHeader>
                                <DialogTitle>
                                    Nouveau service
                                </DialogTitle>
                                <DialogDescription>
                                    Ajouter un nouveau service aux services existant
                                </DialogDescription>
                            </DialogHeader>
                            <Form action="/test" method="POST">
                                <div class="grid gap-4 py-4">
                                    <div class="grid">
                                        <Label for="service_name">
                                            Nom du service
                                        </Label>
                                        <Input id="service_name" name="service_name" class="bg-white" />
                                    </div>

                                    <div class="grid">
                                        <Label for="type">
                                            Modérateur du service
                                        </Label>

                                        <SelectInput name="service_name" placeholder="Choix du service">
                                            <SelectItem v-for="user in props.users" :value="user.id">
                                                {{ user.name }}
                                            </SelectItem>
                                        </SelectInput>


                                    </div>
                                </div>
                                <DialogFooter>
                                    <Button type="submit">
                                        Enregistrer
                                    </Button>
                                </DialogFooter>
                            </Form>
                        </DialogContent>
                    </Dialog>
                </div>
                <div class="rounded-xl bg-zinc-50 border border-sidebar-border/70 dark:border-sidebar-border">

                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <ScrollArea class="h-50">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Service
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Membres
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Chef de service
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Date de création
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="service in props.services" :key="service.id"
                                        class="border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ service.name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            <AvatarGroup />
                                        </td>
                                        <td class="px-6 py-4">
                                            Jhon Doe
                                        </td>
                                        <td class="px-6 py-4">
                                            10/03/2024
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <ActionOption />
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </ScrollArea>
                    </div>

                </div>
            </div>

        </div>
    </AppLayout>
</template>
