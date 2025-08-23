<script setup lang="ts">
import { Button } from '@/components/ui/button';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { Award, Plus } from 'lucide-vue-next';
import AvatarGroup from '@/components/AvatarGroup.vue';
import ActionOption from '@/components/ActionOption.vue';
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Services',
        href: '/services',
    },
];
</script>

<template>

    <Head title="Services" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4 overflow-x-auto">
            <div class="grid auto-rows-min">

                <div class="p-1 space-y-2 border border-slate-200 text-xs rounded shadow bg-[#c6e4fe] text-black/90">
                    <p class="flex items-center uppercase font-bold">
                        <Award :size="18" />
                        Important
                    </p>
                    <p class="ml-1 text-[#000000e3]">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas nemo, impedit debitis quaerat ipsa
                        architecto repellendus aliquam quibusdam laudantium iste laborum odio ut. Alias expedita minus
                        nulla veniam voluptate sed, magni dolorum consequatur magnam explicabo, delectus cupiditate
                        dicta illo iure quaerat qui ratione debitis blanditiis asperiores optio quod quas nemo.
                    </p>
                </div>

            </div>
            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <p class="text-gray-400 text-xs">Services actuels</p>
                    <Button variant="ghost">
                        <Plus />
                        Nouveau service
                    </Button>
                </div>
                <div class="rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">


                    <div class="relative overflow-x-auto shadow-sm sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nom
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
                                <tr class="border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Service Technique
                                    </th>
                                    <td class="px-6 py-4">
                                        <AvatarGroup/>
                                    </td>
                                    <td class="px-6 py-4">
                                        Jhon Doe
                                    </td>
                                    <td class="px-6 py-4">
                                        10/03/2024
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <ActionOption/>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <p class="text-gray-400 text-xs">Services actuels</p>
                    <Button variant="ghost">
                        <Plus />
                        Nouveau service
                    </Button>
                </div>
                <div class="rounded-xl bg-zinc-50 border border-sidebar-border/70 dark:border-sidebar-border">


                    <div class="relative overflow-x-auto sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Nom
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
                                <tr class="border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        Service Technique
                                    </th>
                                    <td class="px-6 py-4">
                                        <AvatarGroup/>
                                    </td>
                                    <td class="px-6 py-4">
                                        Jhon Doe
                                    </td>
                                    <td class="px-6 py-4">
                                        10/03/2024
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <ActionOption/>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </AppLayout>
</template>
