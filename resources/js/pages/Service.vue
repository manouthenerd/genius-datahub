<script setup lang="ts">
import ActionOption from '@/components/ActionOption.vue';
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogDescription, DialogFooter, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import Input from '@/components/ui/input/Input.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Form, Head } from '@inertiajs/vue3';
import { Plus } from 'lucide-vue-next';

import InputError from '@/components/InputError.vue';
import SelectInput from '@/components/SelectInput.vue';
import Badge from '@/components/ui/badge/Badge.vue';
import Label from '@/components/ui/label/Label.vue';
import { ScrollArea } from '@/components/ui/scroll-area';
import SelectItem from '@/components/ui/select/SelectItem.vue';
import { dateFormat } from '@/composables/useDateFormat';
import { Loader } from 'lucide-vue-next';
import Checkbox from '@/components/ui/checkbox/Checkbox.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Services et membres',
        href: '/services',
    },
];

interface Services {
    id: number,
    name: string,
    created_at: string,
    moderator: string,
    counts: number
}

interface User {
    id: number,
    name: string,
    email: string,
    role: string,
    service_id: number,
    service: {
        id: number,
        name: string
    }
}

// const props = defineProps({
//     users: Array,
//     services: Array,
// });

defineProps<{ users: User[], services: Services[] }>();

function getUserRole(role: string): string {
    switch (role) {
        case 'admin':
            return 'admin';

        case 'moderator':
            return 'modérateur';

        default:
            return 'membre';
    }
}
</script>

<template>

    <Head title="Services et membres" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-3 overflow-x-auto rounded-xl p-4">
            <!-- User dialog box -->
            <div class="flex-1">
                <div class="flex items-center justify-between">
                    <p class="text-xs text-gray-400">Membres actuels</p>
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
                            <div class="rounded bg-zinc-100 p-2">
                                <!-- TODO: Alert component here -->
                                <Transition>
                                    <p v-if="false" class="rounded-sm bg-blue-100 p-2">Enregistrement effectué avec
                                        succès !</p>
                                </Transition>
                            </div>
                            <Form :action="route('users.create')" method="POST" v-slot="{ errors, processing }"
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

                                        <SelectInput name="service" placeholder="Choix du service">
                                            <SelectItem v-for="service in services" :value="service.id"
                                                :key="service.id">
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
                </div>
                <div class="rounded-xl border border-sidebar-border/70 bg-white dark:border-sidebar-border">
                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <ScrollArea class="h-50">
                            <table class="w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400">
                                <thead
                                    class="sticky-top sticky top-0 bg-blue-950 text-xs text-white uppercase dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Nom</th>
                                        <th scope="col" class="px-6 py-3">Email</th>
                                        <th scope="col" class="px-6 py-3">Service</th>
                                        <th scope="col" class="px-6 py-3">Type</th>
                                        <th scope="col" class="px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in users" :key="user.email"
                                        class="border-y border-gray-200 transition-all hover:bg-slate-200 dark:border-gray-700 dark:bg-gray-800">
                                        <th scope="row"
                                            class="px-6 py-2 font-medium whitespace-nowrap text-gray-900 dark:text-white">
                                            {{ user.name }}
                                        </th>

                                        <td class="px-6 py-2">
                                            {{ user.email }}
                                        </td>
                                        <td class="px-6 py-2">
                                            {{ user.service.name }}
                                        </td>
                                        <td class="px-6 py-2">
                                            {{ getUserRole(user.role) }}
                                        </td>
                                        <td class="px-6 py-2 text-right">
                                            <ActionOption :edit-link="route('users.edit', user.id)"
                                                :delete-link="route('users.destroy', user.id)" />
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
                <div class="flex items-center justify-between">
                    <p class="text-xs text-gray-400">Services actuels</p>
                    <Dialog>
                        <DialogTrigger>
                            <Button variant="ghost">
                                <Plus />
                                Nouveau service
                            </Button>
                        </DialogTrigger>
                        <DialogContent>
                            <DialogHeader>
                                <DialogTitle> Nouveau service </DialogTitle>
                                <DialogDescription> Ajouter un nouveau service aux existants </DialogDescription>
                            </DialogHeader>
                            <Form :action="route('services.store')" method="POST" :reset-on-success="['service_name']"
                                v-slot="{ errors, processing }">
                                <div class="grid gap-4 py-2">
                                    <div class="grid space-y-2">
                                        <Label for="service_name"> Nom du service </Label>
                                        <Input id="service_name" name="service_name" class="bg-white" required />
                                        <InputError :message="errors.service_name" />
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
                </div>
                <div class="rounded-xl border border-sidebar-border/70 bg-white dark:border-sidebar-border">
                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <ScrollArea class="h-50">
                            <table class="w-full text-left text-sm text-gray-500 rtl:text-right dark:text-gray-400">
                                <!-- TODO Faire passer les avatars en dessous du thead -->
                                <thead
                                    class="sticky-top sticky top-0 bg-blue-950 text-xs text-white uppercase dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Service</th>
                                        <th scope="col" class="px-6 py-3">Membres</th>
                                        <th scope="col" class="px-6 py-3">Modérateur</th>
                                        <th scope="col" class="px-6 py-3">Date de création</th>
                                        <th scope="col" class="px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="service in services" :key="service.id"
                                        class="border-y border-gray-200 transition-all hover:bg-slate-200 dark:border-gray-700 dark:bg-gray-800">
                                        <th scope="row"
                                            class="px-6 py-2 font-medium whitespace-nowrap text-gray-900 dark:text-white">
                                            {{ service.name }}
                                        </th>
                                        <td class="px-6 py-2">
                                            <Badge variant="secondary" class="bg-orange-400">{{ service.counts }}
                                            </Badge>
                                        </td>
                                        <td class="px-6 py-2">
                                            {{ service.moderator }}
                                        </td>
                                        <td class="px-6 py-2">
                                            {{ dateFormat(service.created_at) }}
                                        </td>
                                        <td class="px-6 py-2 text-right">
                                            <ActionOption :show-edit-link="false"
                                                :delete-link="route('services.destroy', { service: service.id })">
                                                <Dialog>
                                                    <DialogTrigger>
                                                        <Button variant="ghost">
                                                            Modifier
                                                        </Button>
                                                    </DialogTrigger>
                                                    <DialogContent>
                                                        <DialogHeader>
                                                            <DialogTitle>Modification: {{ service.name }} </DialogTitle>
                                                            <DialogDescription>Modifier les informations du service
                                                            </DialogDescription>
                                                        </DialogHeader>
                                                        <div class="rounded bg-zinc-100 p-2">
                                                            <!-- TODO: Alert component here -->
                                                            <Transition>
                                                                <p v-if="false" class="rounded-sm bg-blue-100 p-2">
                                                                    Enregistrement effectué avec succès !</p>
                                                            </Transition>
                                                        </div>
                                                        <Form :action="route('services.update', { service: 1 })"
                                                            method="PUT" v-slot="{ errors, processing }"
                                                            :reset-on-success="['name', 'email']">
                                                            <div class="grid gap-4 py-2">
                                                                <div class="grid gap-1">
                                                                    <Label for="name"> Nom du service </Label>
                                                                    <Input id="name" :modelValue="service.name"
                                                                        name="name" class="bg-white" />
                                                                    <InputError :message="errors.name" />
                                                                </div>

                                                                <div class="grid gap-1">
                                                                    <Label for="moderator">Modérateur du service
                                                                    </Label>

                                                                    <SelectInput :defaultValue="service.moderator"
                                                                        name="moderator"
                                                                        placeholder="Choisir un nouveau modérateur">
                                                                        <SelectItem selected
                                                                            :modelValue="service.moderator"
                                                                            :value="service.moderator"> {{
                                                                                service.moderator }}
                                                                        </SelectItem>
                                                                        <SelectItem value="member"> Membre </SelectItem>
                                                                    </SelectInput>
                                                                    <InputError :message="errors.moderator" />
                                                                </div>

                                                                <div class="grid gap-1">
                                                                    <Label for="members">Membres du service</Label>

                                                                    <ScrollArea>
                                                                        <ul class="h-[100px] space-y-2 p-2">
                                                                            <li v-for="value in 10" :key="value"
                                                                                class="border-b-1">
                                                                                <Checkbox :id="`user-${value}`" />
                                                                                <label :for="`user-${value}`" 
                                                                                    class="text-sm font-medium mb-0.5">
                                                                                    Checkbox {{ value }}
                                                                                </label>
                                                                            </li>
                                                                        </ul>
                                                                    </ScrollArea>
                                                                    <InputError :message="errors.members" />
                                                                </div>
                                                            </div>
                                                            <DialogFooter class="mt-2">
                                                                <Button :disabled="processing" type="submit"
                                                                    class="bg-[#0168a6] hover:bg-[#0168a6] hover:opacity-80">
                                                                    <Loader v-if="processing"
                                                                        class="h-4 w-4 animate-spin" />
                                                                    Enregistrer les modifications
                                                                </Button>
                                                            </DialogFooter>
                                                        </Form>
                                                    </DialogContent>
                                                </Dialog>
                                            </ActionOption>
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
